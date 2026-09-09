<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\HeroSlide;
use App\Models\JourneyStep;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * Display the main landing page.
     */
    public function index(Request $request): View
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        $heroSlides = HeroSlide::query()->where('is_active', true)->orderBy('order')->get();
        $services = Service::query()->where('is_active', true)->orderBy('sort_order')->get();
        $projects = Project::query()->where('is_featured', true)->orderBy('sort_order')->get();
        $allProjects = Project::query()->orderBy('sort_order')->get();
        $journeySteps = JourneyStep::query()->where('is_active', true)->orderBy('sort_order')->get();
        $faqs = Faq::query()->where('is_active', true)->orderBy('sort_order')->get();
        $socialLinks = SocialLink::query()->where('is_active', true)->orderBy('sort_order')->get();

        return view('pages.home', [
            'settings' => $settings,
            'heroSlides' => $heroSlides,
            'services' => $services,
            'projects' => $projects,
            'allProjects' => $allProjects,
            'journeySteps' => $journeySteps,
            'faqs' => $faqs,
            'socialLinks' => $socialLinks,
        ]);
    }

    /**
     * Generate sitemap.xml dynamically.
     */
    public function sitemap(): Response
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        $xml .= '<url><loc>'.url('/').'</loc><lastmod>'.date('Y-m-d').'</lastmod><changefreq>weekly</changefreq><priority>1.0</priority></url>';
        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }

    /**
     * Generate robots.txt dynamically.
     */
    public function robots(): Response
    {
        $content = "User-agent: *\nAllow: /\nDisallow: /admin\n\nSitemap: ".url('/sitemap.xml')."\n";

        return response($content, 200, ['Content-Type' => 'text/plain']);
    }
}
