<?php

namespace App\Http\Controllers;

use App\Models\Product3dModel;
use App\Models\Project;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class Mup3Controller extends Controller
{
    /**
     * Display the dedicated MUP3 project presentation page.
     */
    public function index(Request $request): View
    {
        $settings = SiteSetting::getFormattedSettings();
        $socialLinks = SocialLink::query()->where('is_active', true)->orderBy('sort_order')->get();
        $project = Project::query()->where('slug', 'mup3')->first();

        // Retrieve 3D models for Card 1 and Card 2 (allows inactive models if explicitly chosen for showcase)
        $models = Product3dModel::query()->orderBy('sort_order')->get();

        $slug1 = $settings['mup3_card1_model_slug'] ?? 'cabo-carnes';
        $slug2 = $settings['mup3_card2_model_slug'] ?? 'stam_803_29i';

        $model1 = $models->firstWhere('slug', $slug1) ?? $models->first();
        $model2 = $models->firstWhere('slug', $slug2) ?? ($models->skip(1)->first() ?? $model1);

        $showcase = [
            'title' => $settings['mup3_title'] ?? 'YOUR CARDS, PROTECTED',
            'description' => $settings['mup3_description'] ?? 'Our cutting-edge security features, and team of specialists, are monitoring your spend 24/7. We\'ve helped prevent more than £475m worth of fraud in 2023 alone.',
            'cta_text' => $settings['mup3_cta_text'] ?? 'Learn more',
            'cta_url' => $settings['mup3_cta_url'] ?? '#contato',
            'card1' => [
                'title' => $settings['mup3_card1_title'] ?? 'Air Force 1 Low Supr...',
                'brand' => $settings['mup3_card1_brand'] ?? 'Nike',
                'price' => $settings['mup3_card1_price'] ?? '59$',
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
                'title' => $settings['mup3_card2_title'] ?? 'Stam 803 Edition',
                'brand' => $settings['mup3_card2_brand'] ?? 'Norra Studio',
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
