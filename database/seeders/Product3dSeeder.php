<?php

namespace Database\Seeders;

use App\Models\Product3dModel;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class Product3dSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Settings
        $settings = [
            'section_3d_enabled' => '1',
            'section_3d_eyebrow' => 'DESIGN & ENGENHARIA',
            'section_3d_title' => "Estrutura unibody.\nUma obra única.",
            'section_3d_description' => 'Apresentamos a precisão cirúrgica em Three.js. Explore proporções milimétricas, alterne modelos e personalize ligas metálicas, empunhaduras e acabamentos sob medida em tempo real.',
            'section_3d_eyebrow_en' => 'DESIGN & ENGINEERING',
            'section_3d_title_en' => "Unibody craft.\nA single work of art.",
            'section_3d_description_en' => 'Experience surgical precision in Three.js. Explore millimeter proportions, switch models and customize bespoke blade metals, custom grips and finishes in real time.',
            'section_3d_default_model' => 'faca-chef',
        ];

        foreach ($settings as $key => $val) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $val,
                    'group' => 'product_3d',
                    'type' => str_contains($key, 'enabled') ? 'boolean' : 'text',
                ]
            );
        }

        // 2. Chef Knife
        Product3dModel::updateOrCreate(
            ['slug' => 'faca-chef'],
            [
                'name' => [
                    'pt' => 'Faca do Chef Norra 8"',
                    'pt_BR' => 'Faca do Chef Norra 8"',
                    'en' => 'Norra Chef Knife 8"',
                ],
                'badge' => [
                    'pt' => 'EDIÇÃO LIMITADA',
                    'pt_BR' => 'EDIÇÃO LIMITADA',
                    'en' => 'LIMITED EDITION',
                ],
                'subtitle' => [
                    'pt' => 'Aço Damasco & Empunhadura Ergonômica',
                    'pt_BR' => 'Aço Damasco & Empunhadura Ergonômica',
                    'en' => 'Damascus Steel & Ergonomic Grip',
                ],
                'description' => [
                    'pt' => 'Geometria milimetricamente forjada com balanço cirúrgico. Selecione o acabamento da empunhadura e o tratamento de superfície da lâmina.',
                    'pt_BR' => 'Geometria milimetricamente forjada com balanço cirúrgico. Selecione o acabamento da empunhadura e o tratamento de superfície da lâmina.',
                    'en' => 'Millimeter-forged geometry with surgical balance. Customize handle materials and blade surface finishes in real time.',
                ],
                'glb_file' => 'product3d/models/faca-chef.glb',
                'thumbnail' => 'product3d/thumbnails/faca-chef.webp',
                'is_active' => true,
                'is_initial' => true,
                'sort_order' => 1,
                'camera_settings' => [
                    'position' => [0, 0, 4.3],
                    'fov' => 40,
                    'target' => [0, 0, 0],
                ],
                'transform_settings' => [
                    'scale' => 1.0,
                    'rotation' => [0.12, -0.35, 0],
                    'position' => [0, 0, 0],
                ],
                'parts' => [
                    [
                        'id' => 'part-cabo',
                        'name' => 'Cabo & Empunhadura',
                        'mesh_name' => 'Handle',
                        'type' => 'color',
                        'options' => [
                            [
                                'id' => 'cabo-ebano',
                                'name' => 'Ébano Noturno',
                                'color' => '#121212',
                                'roughness' => 0.42,
                                'metalness' => 0.05,
                                'material_type' => 'physical',
                                'is_default' => true,
                            ],
                            [
                                'id' => 'cabo-verde',
                                'name' => 'Verde Oliva',
                                'color' => '#243527',
                                'roughness' => 0.45,
                                'metalness' => 0.05,
                                'material_type' => 'physical',
                                'is_default' => false,
                            ],
                            [
                                'id' => 'cabo-bordeaux',
                                'name' => 'Bordeaux Nobre',
                                'color' => '#421520',
                                'roughness' => 0.40,
                                'metalness' => 0.1,
                                'material_type' => 'physical',
                                'is_default' => false,
                            ],
                            [
                                'id' => 'cabo-imbuia',
                                'name' => 'Imbuia Nobre',
                                'color' => '#54331d',
                                'roughness' => 0.55,
                                'metalness' => 0.0,
                                'material_type' => 'standard',
                                'is_default' => false,
                            ],
                        ],
                    ],
                    [
                        'id' => 'part-lamina',
                        'name' => 'Lâmina & Aço',
                        'mesh_name' => 'Blade',
                        'type' => 'material',
                        'options' => [
                            [
                                'id' => 'lamina-satin',
                                'name' => 'Aço Inox Satinado',
                                'color' => '#e2e2e2',
                                'roughness' => 0.18,
                                'metalness' => 0.95,
                                'material_type' => 'physical',
                                'is_default' => true,
                            ],
                            [
                                'id' => 'lamina-black',
                                'name' => 'Black Titanium DLC',
                                'color' => '#1c1c1e',
                                'roughness' => 0.28,
                                'metalness' => 0.90,
                                'material_type' => 'physical',
                                'is_default' => false,
                            ],
                            [
                                'id' => 'lamina-gold',
                                'name' => 'Nitreto Dourado',
                                'color' => '#d4af37',
                                'roughness' => 0.22,
                                'metalness' => 0.92,
                                'material_type' => 'physical',
                                'is_default' => false,
                            ],
                        ],
                    ],
                    [
                        'id' => 'part-guarda',
                        'name' => 'Guarda & Bolster',
                        'mesh_name' => 'Bolster',
                        'type' => 'material',
                        'options' => [
                            [
                                'id' => 'bolster-latao',
                                'name' => 'Latão Polido',
                                'color' => '#d4af37',
                                'roughness' => 0.22,
                                'metalness' => 0.92,
                                'material_type' => 'physical',
                                'is_default' => true,
                            ],
                            [
                                'id' => 'bolster-inox',
                                'name' => 'Inox Escovado',
                                'color' => '#cccccc',
                                'roughness' => 0.25,
                                'metalness' => 0.95,
                                'material_type' => 'physical',
                                'is_default' => false,
                            ],
                        ],
                    ],
                ],
            ]
        );

        // 3. Santoku Knife
        Product3dModel::updateOrCreate(
            ['slug' => 'faca-santoku'],
            [
                'name' => [
                    'pt' => 'Faca Santoku Norra 7"',
                    'pt_BR' => 'Faca Santoku Norra 7"',
                    'en' => 'Norra Santoku Knife 7"',
                ],
                'badge' => [
                    'pt' => 'HERANÇA JAPONESA',
                    'pt_BR' => 'HERANÇA JAPONESA',
                    'en' => 'JAPANESE HERITAGE',
                ],
                'subtitle' => [
                    'pt' => 'Lâmina Sheep\'s Foot & Wa-Handle',
                    'pt_BR' => 'Lâmina Sheep\'s Foot & Wa-Handle',
                    'en' => 'Sheep\'s Foot Blade & Octagonal Wa-Handle',
                ],
                'description' => [
                    'pt' => 'Inspirada na tradição culinária oriental. Geometria versátil para legumes, carnes e peixes com empunhadura octogonal facetada.',
                    'pt_BR' => 'Inspirada na tradição culinária oriental. Geometria versátil para legumes, carnes e peixes com empunhadura octogonal facetada.',
                    'en' => 'Inspired by Japanese culinary tradition. Versatile geometry with an octagonal faceted Wa-handle for unmatched control.',
                ],
                'glb_file' => 'product3d/models/faca-santoku.glb',
                'thumbnail' => 'product3d/thumbnails/faca-santoku.webp',
                'is_active' => true,
                'is_initial' => false,
                'sort_order' => 2,
                'camera_settings' => [
                    'position' => [0, 0, 4.3],
                    'fov' => 40,
                    'target' => [0, 0, 0],
                ],
                'transform_settings' => [
                    'scale' => 1.05,
                    'rotation' => [0.12, -0.35, 0],
                    'position' => [0, 0, 0],
                ],
                'parts' => [
                    [
                        'id' => 'part-cabo-wa',
                        'name' => 'Cabo Octogonal Wa',
                        'mesh_name' => 'Handle',
                        'type' => 'color',
                        'options' => [
                            [
                                'id' => 'cabo-nogueira',
                                'name' => 'Nogueira Escura',
                                'color' => '#5a341a',
                                'roughness' => 0.55,
                                'metalness' => 0.02,
                                'material_type' => 'standard',
                                'is_default' => true,
                            ],
                            [
                                'id' => 'cabo-fumee',
                                'name' => 'Carvalho Fumê',
                                'color' => '#26221f',
                                'roughness' => 0.50,
                                'metalness' => 0.05,
                                'material_type' => 'standard',
                                'is_default' => false,
                            ],
                            [
                                'id' => 'cabo-betula',
                                'name' => 'Bétula Dourada',
                                'color' => '#b5966d',
                                'roughness' => 0.60,
                                'metalness' => 0.0,
                                'material_type' => 'standard',
                                'is_default' => false,
                            ],
                        ],
                    ],
                    [
                        'id' => 'part-lamina-santoku',
                        'name' => 'Lâmina Santoku',
                        'mesh_name' => 'Blade',
                        'type' => 'material',
                        'options' => [
                            [
                                'id' => 'lamina-vg10',
                                'name' => 'Aço Japonês VG10',
                                'color' => '#cccccc',
                                'roughness' => 0.22,
                                'metalness' => 0.92,
                                'material_type' => 'physical',
                                'is_default' => true,
                            ],
                            [
                                'id' => 'lamina-carbono',
                                'name' => 'Damasco Carbono',
                                'color' => '#252528',
                                'roughness' => 0.30,
                                'metalness' => 0.88,
                                'material_type' => 'physical',
                                'is_default' => false,
                            ],
                        ],
                    ],
                    [
                        'id' => 'part-colarinho',
                        'name' => 'Colarinho & Virola',
                        'mesh_name' => 'Bolster',
                        'type' => 'material',
                        'options' => [
                            [
                                'id' => 'colarinho-bufalo',
                                'name' => 'Chifre de Búfalo Preto',
                                'color' => '#1f1f1f',
                                'roughness' => 0.35,
                                'metalness' => 0.40,
                                'material_type' => 'physical',
                                'is_default' => true,
                            ],
                            [
                                'id' => 'colarinho-latao',
                                'name' => 'Latão Dourado',
                                'color' => '#c5a059',
                                'roughness' => 0.15,
                                'metalness' => 0.95,
                                'material_type' => 'physical',
                                'is_default' => false,
                            ],
                        ],
                    ],
                ],
            ]
        );
    }
}
