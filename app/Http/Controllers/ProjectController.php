<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display the all projects page matching Penpot design.
     */
    public function index(Request $request): View
    {
        $settings = SiteSetting::getFormattedSettings();
        $socialLinks = SocialLink::query()->where('is_active', true)->orderBy('sort_order')->get();
        $projects = Project::query()->where('is_active', true)->orderBy('sort_order')->get();

        return view('pages.projects', [
            'settings' => $settings,
            'socialLinks' => $socialLinks,
            'projects' => $projects,
        ]);
    }

    /**
     * Display a specific project presentation or redirect if external.
     */
    public function show(Request $request, string $slug): mixed
    {
        if (in_array(strtolower($slug), ['mup3', 'mup-3'], true)) {
            $mup3Project = Project::query()->where('slug', 'mup3')->first();
            if ($mup3Project && ! $mup3Project->is_active && ! auth()->check()) {
                return redirect()->route(app()->getLocale() === 'en' ? 'en.projects.index' : 'projects.index');
            }

            return app(Mup3Controller::class)->index($request);
        }

        $project = Project::query()->where('slug', $slug)->where('is_active', true)->firstOrFail();

        if (! empty($project->link_url) && $project->link_url !== '#') {
            return redirect()->away($project->link_url);
        }

        return redirect()->route(app()->getLocale() === 'en' ? 'en.projects.index' : 'projects.index');
    }
}
