<?php

namespace Database\Seeders;

use App\Models\Product3dModel;
use App\Models\Project;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class Mup3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create or update Project MUP3 as a featured project
        Project::updateOrCreate(
            ['slug' => 'mup3'],
            [
                'title' => [
                    'pt' => 'Apresentação MUP3',
                    'pt_BR' => 'Apresentação MUP3',
                    'en' => 'MUP3 Presentation',
                ],
                'client' => 'Norra Lab',
                'year' => '2026',
                'category' => [
                    'pt' => 'Design 3D & Produto',
                    'pt_BR' => 'Design 3D & Produto',
                    'en' => '3D Design & Product',
                ],
                'short_description' => [
                    'pt' => 'Showcase interativo de produtos tridimensionais com acabamento de precisão e engenharia digital.',
                    'pt_BR' => 'Showcase interativo de produtos tridimensionais com acabamento de precisão e engenharia digital.',
                    'en' => 'Interactive three-dimensional product showcase featuring precision craft and digital engineering.',
                ],
                'full_description' => [
                    'pt' => 'Uma apresentação imersiva desenvolvida com tecnologia Three.js, trazendo interação fluida, iluminação realista de estúdio e controle minucioso de cada detalhe.',
                    'pt_BR' => 'Uma apresentação imersiva desenvolvida com tecnologia Three.js, trazendo interação fluida, iluminação realista de estúdio e controle minucioso de cada detalhe.',
                    'en' => 'An immersive presentation built with Three.js technology, delivering fluid interaction, realistic studio lighting, and meticulous attention to every detail.',
                ],
                'cover_image' => 'projects/1783959091061-MacBook_Mockup_2.webp',
                'tags' => ['Design 3D', 'Website'],
                'link_url' => null,
                'is_featured' => true,
                'sort_order' => 4,
            ]
        );

        // 2. Initial Settings for MUP3 Showcase (ONLY if missing, NEVER overwrite existing user settings)
        $availableModels = Product3dModel::where('is_active', true)->orderBy('sort_order')->get();
        $model1Slug = $availableModels->first()?->slug ?? 'cabo-carnes';
        $model2Slug = $availableModels->skip(1)->first()?->slug ?? ($availableModels->first()?->slug ?? 'stam_803_29i');

        $settings = [
            'site_noise_enabled' => '1',
            'site_noise_opacity' => '0.05',

            'mup3_title' => 'YOUR CARDS, PROTECTED',
            'mup3_title_en' => 'YOUR CARDS, PROTECTED',
            'mup3_description' => 'Our cutting-edge security features, and team of specialists, are monitoring your spend 24/7. We\'ve helped prevent more than £475m worth of fraud in 2023 alone.',
            'mup3_description_en' => 'Our cutting-edge security features, and team of specialists, are monitoring your spend 24/7. We\'ve helped prevent more than £475m worth of fraud in 2023 alone.',
            'mup3_cta_text' => 'Learn more',
            'mup3_cta_text_en' => 'Learn more',
            'mup3_cta_url' => '#contato',

            'mup3_card1_model_slug' => $model1Slug,
            'mup3_card1_title' => 'Air Force 1 Low Supr...',
            'mup3_card1_title_en' => 'Air Force 1 Low Supr...',
            'mup3_card1_brand' => 'Nike',
            'mup3_card1_brand_en' => 'Nike',
            'mup3_card1_price' => '59$',
            'mup3_card1_button_url' => '#contato',
            'mup3_card1_scale' => '1.0',
            'mup3_card1_fov' => '40',
            'mup3_card1_rotation_y' => '0',
            'mup3_card1_rotation_x' => '0',
            'mup3_card1_auto_rotate_speed' => '0.6',
            'mup3_card1_light_intensity' => '1.2',
            'mup3_card1_mat_override' => '0',
            'mup3_card1_tint_color' => '',
            'mup3_card1_roughness' => '0.35',
            'mup3_card1_metalness' => '0.15',

            'mup3_card2_model_slug' => $model2Slug,
            'mup3_card2_title' => 'Stam 803 Edition',
            'mup3_card2_title_en' => 'Stam 803 Edition',
            'mup3_card2_brand' => 'Norra Studio',
            'mup3_card2_brand_en' => 'Norra Studio',
            'mup3_card2_price' => '89$',
            'mup3_card2_button_url' => '#contato',
            'mup3_card2_scale' => '1.0',
            'mup3_card2_fov' => '40',
            'mup3_card2_rotation_y' => '0',
            'mup3_card2_rotation_x' => '0',
            'mup3_card2_auto_rotate_speed' => '0.6',
            'mup3_card2_light_intensity' => '1.2',
            'mup3_card2_mat_override' => '0',
            'mup3_card2_tint_color' => '',
            'mup3_card2_roughness' => '0.35',
            'mup3_card2_metalness' => '0.15',
        ];

        foreach ($settings as $key => $val) {
            $existing = SiteSetting::where('key', $key)->first();
            if (! $existing) {
                SiteSetting::create([
                    'key' => $key,
                    'value' => $val,
                    'group' => str_starts_with($key, 'site_noise') ? 'general' : 'mup3_showcase',
                    'type' => str_contains($key, 'enabled') ? 'boolean' : 'text',
                ]);
            }
        }
    }
}
