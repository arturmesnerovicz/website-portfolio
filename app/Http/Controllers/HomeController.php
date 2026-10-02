<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\HeroSlide;
use App\Models\JourneyStep;
use App\Models\Product3dModel;
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

        $product3dEnabled = filter_var($settings['section_3d_enabled'] ?? true, FILTER_VALIDATE_BOOLEAN);
        $product3dPayload = null;

        if ($product3dEnabled) {
            $models = Product3dModel::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get();

            if ($models->isNotEmpty()) {
                $defaultSlug = $settings['section_3d_default_model'] ?? null;
                $initialModel = ($defaultSlug ? $models->firstWhere('slug', $defaultSlug) : null)
                    ?? $models->firstWhere('is_initial', true)
                    ?? $models->first();

                $product3dPayload = [
                    'enabled' => true,
                    'allowZoom' => filter_var($settings['section_3d_allow_zoom'] ?? true, FILTER_VALIDATE_BOOLEAN),
                    'initialModelSlug' => $initialModel?->slug,
                    'models' => $models->map(fn (Product3dModel $m) => $m->toFrontendPayload())->values()->all(),
                ];
            }
        }

        return view('pages.home', [
            'settings' => $settings,
            'heroSlides' => $heroSlides,
            'services' => $services,
            'projects' => $projects,
            'allProjects' => $allProjects,
            'journeySteps' => $journeySteps,
            'faqs' => $faqs,
            'socialLinks' => $socialLinks,
            'product3dPayload' => $product3dPayload,
            'product3dEnabled' => $product3dEnabled && ! empty($product3dPayload),
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

        // MUP3 Showcase PT & EN
        $xml .= '<url>';
        $xml .= '<loc>'.url('/projetos/mup3').'</loc>';
        $xml .= '<xhtml:link rel="alternate" hreflang="pt-BR" href="'.url('/projetos/mup3').'"/>';
        $xml .= '<xhtml:link rel="alternate" hreflang="en" href="'.url('/en/projects/mup3').'"/>';
        $xml .= '<lastmod>'.$today.'</lastmod>';
        $xml .= '<changefreq>weekly</changefreq>';
        $xml .= '<priority>0.85</priority>';
        $xml .= '</url>';

        $xml .= '<url>';
        $xml .= '<loc>'.url('/en/projects/mup3').'</loc>';
        $xml .= '<xhtml:link rel="alternate" hreflang="pt-BR" href="'.url('/projetos/mup3').'"/>';
        $xml .= '<xhtml:link rel="alternate" hreflang="en" href="'.url('/en/projects/mup3').'"/>';
        $xml .= '<lastmod>'.$today.'</lastmod>';
        $xml .= '<changefreq>weekly</changefreq>';
        $xml .= '<priority>0.85</priority>';
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
