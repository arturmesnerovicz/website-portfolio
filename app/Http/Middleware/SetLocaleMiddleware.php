<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('admin*')) {
            return $next($request);
        }

        $isEnglish = $request->is('en') || $request->is('en/*');
        $locale = $isEnglish ? 'en' : 'pt_BR';

        app()->setLocale($locale);

        // Share locale variables with all Blade views
        view()->share('currentLocale', $locale);
        view()->share('isEnglish', $isEnglish);

        // Calculate language switch URLs for the header switcher
        $isProjectsPage = $request->is('projetos') || $request->is('en/projects');

        view()->share('urlPt', $isProjectsPage ? url('/projetos') : url('/'));
        view()->share('urlEn', $isProjectsPage ? url('/en/projects') : url('/en'));

        return $next($request);
    }
}
