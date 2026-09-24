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
        $settings = SiteSetting::getFormattedSettings();
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
     * Generate sitemap.xml dynamically with hreflang support.
     */
    public function sitemap(): Response
    {
        $today = date('Y-m-d');
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">';

        // Home PT & EN
        $xml .= '<url>';
        $xml .= '<loc>'.url('/').'</loc>';
        $xml .= '<xhtml:link rel="alternate" hreflang="pt-BR" href="'.url('/').'"/>';
        $xml .= '<xhtml:link rel="alternate" hreflang="en" href="'.url('/en').'"/>';
        $xml .= '<lastmod>'.$today.'</lastmod>';
        $xml .= '<changefreq>weekly</changefreq>';
        $xml .= '<priority>1.0</priority>';
        $xml .= '</url>';

        $xml .= '<url>';
        $xml .= '<loc>'.url('/en').'</loc>';
        $xml .= '<xhtml:link rel="alternate" hreflang="pt-BR" href="'.url('/').'"/>';
        $xml .= '<xhtml:link rel="alternate" hreflang="en" href="'.url('/en').'"/>';
        $xml .= '<lastmod>'.$today.'</lastmod>';
        $xml .= '<changefreq>weekly</changefreq>';
        $xml .= '<priority>0.9</priority>';
        $xml .= '</url>';

        // Projects PT & EN
        $xml .= '<url>';
        $xml .= '<loc>'.url('/projetos').'</loc>';
        $xml .= '<xhtml:link rel="alternate" hreflang="pt-BR" href="'.url('/projetos').'"/>';
        $xml .= '<xhtml:link rel="alternate" hreflang="en" href="'.url('/en/projects').'"/>';
        $xml .= '<lastmod>'.$today.'</lastmod>';
        $xml .= '<changefreq>weekly</changefreq>';
        $xml .= '<priority>0.8</priority>';
        $xml .= '</url>';

        $xml .= '<url>';
        $xml .= '<loc>'.url('/en/projects').'</loc>';
        $xml .= '<xhtml:link rel="alternate" hreflang="pt-BR" href="'.url('/projetos').'"/>';
        $xml .= '<xhtml:link rel="alternate" hreflang="en" href="'.url('/en/projects').'"/>';
        $xml .= '<lastmod>'.$today.'</lastmod>';
        $xml .= '<changefreq>weekly</changefreq>';
        $xml .= '<priority>0.8</priority>';
        $xml .= '</url>';

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
