<?php

namespace App\Http\Controllers;

use App\Models\Product3dModel;
use App\Models\Project;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Mup3Controller extends Controller
{
    /**
     * Display the dedicated MUP3 project presentation page.
     */
    public function index(Request $request): View|RedirectResponse
    {
        $project = Project::query()->where('slug', 'mup3')->first();

        if ($project && ! $project->is_active && ! auth()->check()) {
            return redirect()->route(app()->getLocale() === 'en' ? 'en.projects.index' : 'projects.index');
        }

        $settings = SiteSetting::getFormattedSettings();
        $socialLinks = SocialLink::query()->where('is_active', true)->orderBy('sort_order')->get();

        // Retrieve 3D models for Card 1 and Card 2 (allows inactive models if explicitly chosen for showcase)
        $models = Product3dModel::query()->orderBy('sort_order')->get();

        $rawSlug1 = $settings['mup3_card1_model_slug'] ?? null;
        $slug1 = (! empty($rawSlug1) && $rawSlug1 !== 'cabo-carnes') ? $rawSlug1 : 'stam-1601';
        $slug2 = $settings['mup3_card2_model_slug'] ?? 'stam_803_29i';

        $model1 = $models->firstWhere('slug', $slug1) ?? $models->firstWhere('slug', 'stam-1601') ?? $models->first();
        $model2 = $models->firstWhere('slug', $slug2) ?? $models->firstWhere('slug', 'stam_803_29i') ?? ($models->skip(1)->first() ?? $model1);

        $isEn = app()->getLocale() === 'en';

        $card1Title = $isEn
            ? (($settings['mup3_card1_title_en'] ?? null) ?: ($settings['mup3_card1_title'] ?? null))
            : ($settings['mup3_card1_title'] ?? null);
        if (empty($card1Title) || str_contains($card1Title, 'Air Force')) {
            $card1Title = 'Stam 1601 Edition';
        }

        $card1Brand = $isEn
            ? (($settings['mup3_card1_brand_en'] ?? null) ?: ($settings['mup3_card1_brand'] ?? null))
            : ($settings['mup3_card1_brand'] ?? null);
        if (empty($card1Brand) || strtolower($card1Brand) === 'nike') {
            $card1Brand = 'Norra Studio';
        }

        $card1Price = (! empty($settings['mup3_card1_price']) && $settings['mup3_card1_price'] !== '59$')
            ? $settings['mup3_card1_price']
            : '79$';

        $card2Title = $isEn
            ? (($settings['mup3_card2_title_en'] ?? null) ?: ($settings['mup3_card2_title'] ?? 'Stam 803 Edition'))
            : ($settings['mup3_card2_title'] ?? 'Stam 803 Edition');

        $card2Brand = $isEn
            ? (($settings['mup3_card2_brand_en'] ?? null) ?: ($settings['mup3_card2_brand'] ?? 'Norra Studio'))
            : ($settings['mup3_card2_brand'] ?? 'Norra Studio');

        $showcase = [
            'title' => ($isEn && ! empty($settings['mup3_title_en'])) ? $settings['mup3_title_en'] : ($settings['mup3_title'] ?? 'YOUR CARDS, PROTECTED'),
            'description' => ($isEn && ! empty($settings['mup3_description_en'])) ? $settings['mup3_description_en'] : ($settings['mup3_description'] ?? 'Our cutting-edge security features, and team of specialists, are monitoring your spend 24/7. We\'ve helped prevent more than £475m worth of fraud in 2023 alone.'),
            'cta_text' => ($isEn && ! empty($settings['mup3_cta_text_en'])) ? $settings['mup3_cta_text_en'] : ($settings['mup3_cta_text'] ?? 'Learn more'),
            'cta_url' => $settings['mup3_cta_url'] ?? '#contato',
            'card1' => [
                'title' => $card1Title,
                'brand' => $card1Brand,
                'price' => $card1Price,
                'button_url' => $settings['mup3_card1_button_url'] ?? '#contato',
                'model' => $model1?->toFrontendPayload(),
                'local3d' => [
                    'scale' => (float) ($settings['mup3_card1_scale'] ?? 1.0),
                    'fov' => (float) ($settings['mup3_card1_fov'] ?? 40),
                    'rotation_y' => (float) ($settings['mup3_card1_rotation_y'] ?? 0),
                    'rotation_x' => (float) ($settings['mup3_card1_rotation_x'] ?? 0),
                    'auto_rotate_speed' => (float) ($settings['mup3_card1_auto_rotate_speed'] ?? 0.6),
                    'light_intensity' => (float) ($settings['mup3_card1_light_intensity'] ?? 1.2),
                    'mat_override' => ($settings['mup3_card1_mat_override'] ?? '0') === '1',
                    'tint_color' => ! empty($settings['mup3_card1_tint_color']) ? $settings['mup3_card1_tint_color'] : null,
                    'roughness' => isset($settings['mup3_card1_roughness']) ? (float) $settings['mup3_card1_roughness'] : null,
                    'metalness' => isset($settings['mup3_card1_metalness']) ? (float) $settings['mup3_card1_metalness'] : null,
                ],
            ],
            'card2' => [
                'title' => $card2Title,
                'brand' => $card2Brand,
                'price' => $settings['mup3_card2_price'] ?? '89$',
                'button_url' => $settings['mup3_card2_button_url'] ?? '#contato',
                'model' => $model2?->toFrontendPayload(),
                'local3d' => [
                    'scale' => (float) ($settings['mup3_card2_scale'] ?? 1.0),
                    'fov' => (float) ($settings['mup3_card2_fov'] ?? 40),
                    'rotation_y' => (float) ($settings['mup3_card2_rotation_y'] ?? 0),
                    'rotation_x' => (float) ($settings['mup3_card2_rotation_x'] ?? 0),
                    'auto_rotate_speed' => (float) ($settings['mup3_card2_auto_rotate_speed'] ?? 0.6),
                    'light_intensity' => (float) ($settings['mup3_card2_light_intensity'] ?? 1.2),
                    'mat_override' => ($settings['mup3_card2_mat_override'] ?? '0') === '1',
                    'tint_color' => ! empty($settings['mup3_card2_tint_color']) ? $settings['mup3_card2_tint_color'] : null,
                    'roughness' => isset($settings['mup3_card2_roughness']) ? (float) $settings['mup3_card2_roughness'] : null,
                    'metalness' => isset($settings['mup3_card2_metalness']) ? (float) $settings['mup3_card2_metalness'] : null,
                ],
            ],
        ];

        return view('pages.mup3', [
            'settings' => $settings,
            'socialLinks' => $socialLinks,
            'project' => $project,
            'showcase' => $showcase,
        ]);
    }
}
