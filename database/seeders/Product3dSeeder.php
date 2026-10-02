<?php

namespace Database\Seeders;

use App\Models\Product3dModel;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class Product3dSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Remove any AI-generated mock models
        Product3dModel::whereIn('slug', ['faca-chef', 'faca-santoku'])->delete();

        // 2. Settings (only create if missing, NEVER overwrite existing user custom configurations)
        $defaultSettings = [
            'section_3d_enabled' => '1',
            'section_3d_allow_zoom' => '1',
            'section_3d_eyebrow' => 'DESIGN & ENGENHARIA',
            'section_3d_title' => "Estrutura unibody.\nUma obra única.",
            'section_3d_subtitle' => 'Explore cada detalhe de engenharia e customize acabamentos exclusivos sob medida em tempo real.',
            'section_3d_eyebrow_en' => 'DESIGN & ENGINEERING',
            'section_3d_title_en' => "Unibody craft.\nA single work of art.",
            'section_3d_subtitle_en' => 'Explore millimeter precision, switch models and customize bespoke finishes in real time.',
            'section_3d_default_model' => 'cabo-carnes',
        ];

        foreach ($defaultSettings as $key => $val) {
            $existing = SiteSetting::where('key', $key)->first();
            if (! $existing) {
                SiteSetting::create([
                    'key' => $key,
                    'value' => $val,
                    'group' => 'product_3d',
                    'type' => str_contains($key, 'enabled') || str_contains($key, 'allow_zoom') ? 'boolean' : 'text',
                ]);
            } elseif ($key === 'section_3d_default_model' && in_array($existing->value, ['faca-chef', 'faca-santoku', ''])) {
                $existing->update(['value' => 'cabo-carnes']);
            }
        }

        // 3. User's Real 3D Models
        // Model 1: Cabo Ágilis
        Product3dModel::updateOrCreate(
            ['slug' => 'cabo-carnes'],
            [
                'name' => [
                    'pt' => 'Cabo Ágilis',
                    'pt_BR' => 'Cabo Ágilis',
                    'en' => 'Agilis Handle',
                ],
                'badge' => [
                    'pt' => null,
                    'pt_BR' => null,
                    'en' => null,
                ],
                'subtitle' => [
                    'pt' => null,
                    'pt_BR' => null,
                    'en' => null,
                ],
                'description' => [
                    'pt' => 'Os cabos da Linha Ágilis foram desenvolvidos para proporcionar conforto anatômico, segurança no manuseio da lâmina e ergonomia avançada.',
                    'pt_BR' => 'Os cabos da Linha Ágilis foram desenvolvidos para proporcionar conforto anatômico, segurança no manuseio da lâmina e ergonomia avançada.',
                    'en' => 'The Agilis line handles were developed to provide anatomical comfort, blade handling safety, and advanced ergonomics.',
                ],
                'glb_file' => 'product3d/models/01M3XMFJ0GWFTQGRTH7E5R3YR7.glb',
                'thumbnail' => null,
                'is_active' => true,
                'is_initial' => true,
                'sort_order' => 1,
                'camera_settings' => [
                    'fov' => 40,
                    'distance' => 4.2,
                    'allow_zoom' => true,
                ],
                'transform_settings' => [
                    'scale' => '0.8',
                ],
                'parts' => [
                    [
                        'name' => 'Cabo',
                        'mesh_name' => 'cabo',
                        'type' => 'color',
                        'options' => [
                            [
                                'name' => 'Branco',
                                'color' => '#cccccc',
                                'roughness' => '0.8',
                                'metalness' => 0,
                                'material_type' => 'physical',
                                'is_default' => true,
                                'texture' => null,
                            ],
                            [
                                'name' => 'Ébano escuro',
                                'color' => '#000000',
                                'roughness' => '0.8',
                                'metalness' => 0,
                                'material_type' => 'physical',
                                'is_default' => false,
                                'texture' => null,
                            ],
                            [
                                'name' => 'Verde',
                                'color' => '#1c9c4d',
                                'roughness' => '0.8',
                                'metalness' => 0,
                                'material_type' => 'physical',
                                'is_default' => false,
                                'texture' => null,
                            ],
                        ],
                    ],
                ],
            ]
        );

        // Model 2: Stam 803
        Product3dModel::updateOrCreate(
            ['slug' => 'stam_803_29i'],
            [
                'name' => [
                    'pt' => 'Stam 803',
                    'pt_BR' => 'Stam 803',
                    'en' => 'Stam 803',
                ],
                'badge' => [
                    'pt' => 'stam 803 29i',
                    'pt_BR' => 'stam 803 29i',
                    'en' => 'stam 803 29i',
                ],
                'subtitle' => [
                    'pt' => null,
                    'pt_BR' => null,
                    'en' => null,
                ],
                'description' => [
                    'pt' => 'Gabarito auxiliar para perfuração e instalação de fechadura stam 803/29i em portas de madeira.',
                    'pt_BR' => 'Gabarito auxiliar para perfuração e instalação de fechadura stam 803/29i em portas de madeira.',
                    'en' => 'Auxiliary jig for drilling and installing Stam 803/29i lock in wooden doors.',
                ],
                'glb_file' => 'product3d/models/01M3XN083WV9FQVHCCDK7V2AXV.glb',
                'thumbnail' => null,
                'is_active' => true,
                'is_initial' => false,
                'sort_order' => 2,
                'camera_settings' => [
                    'fov' => 40,
                    'distance' => 4.2,
                    'allow_zoom' => true,
                ],
                'transform_settings' => [
                    'scale' => '0.2',
                ],
                'parts' => [
                    [
                        'name' => 'gabarito',
                        'mesh_name' => 'stam_803_29i',
                        'type' => 'color',
                        'options' => [
                            [
                                'name' => 'Laranja',
                                'color' => '#ff5000',
                                'roughness' => 0.4,
                                'metalness' => 0,
                                'material_type' => 'physical',
                                'is_default' => true,
                                'texture' => null,
                            ],
                        ],
                    ],
                ],
            ]
        );

        // Model 3: Stam 1601
        Product3dModel::updateOrCreate(
            ['slug' => 'stam-1601'],
            [
                'name' => [
                    'pt' => 'Stam 1601',
                    'pt_BR' => 'Stam 1601',
                    'en' => 'Stam 1601',
                ],
                'badge' => [
                    'pt' => 'stam_1601',
                    'pt_BR' => 'stam_1601',
                    'en' => 'stam_1601',
                ],
                'subtitle' => [
                    'pt' => null,
                    'pt_BR' => null,
                    'en' => null,
                ],
                'description' => [
                    'pt' => 'Gabarito auxiliar para perfuração e instalação de fechadura stam 1601 em portas de madeira.',
                    'pt_BR' => 'Gabarito auxiliar para perfuração e instalação de fechadura stam 1601 em portas de madeira.',
                    'en' => 'Auxiliary jig for drilling and installing Stam 1601 lock in wooden doors.',
                ],
                'glb_file' => 'product3d/models/01M3XSVGKFNWJKV23GFECQ4RK3.glb',
                'thumbnail' => null,
                'is_active' => false,
                'is_initial' => false,
                'sort_order' => 3,
                'camera_settings' => [
                    'fov' => 40,
                    'distance' => 4.2,
                    'allow_zoom' => true,
                ],
                'transform_settings' => [
                    'scale' => '1.0',
                ],
                'parts' => [
                    [
                        'name' => 'Cor',
                        'mesh_name' => 'stam_1601',
                        'type' => 'color',
                        'options' => [
                            [
                                'name' => 'Laranja',
                                'color' => '#6370ff',
                                'roughness' => 0.4,
                                'metalness' => 0,
                                'material_type' => 'physical',
                                'is_default' => true,
                                'texture' => null,
                            ],
                        ],
                    ],
                ],
            ]
        );
    }
}
