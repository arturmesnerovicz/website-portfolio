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
        $settings = SiteSetting::all()->pluck('value', 'key');
        $socialLinks = SocialLink::query()->where('is_active', true)->orderBy('sort_order')->get();
        $projects = Project::query()->orderBy('sort_order')->get();

        return view('pages.projects', [
            'settings' => $settings,
            'socialLinks' => $socialLinks,
            'projects' => $projects,
        ]);
    }
}
