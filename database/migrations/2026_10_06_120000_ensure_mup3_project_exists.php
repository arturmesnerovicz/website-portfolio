<?php

use App\Models\Project;
use App\Models\SiteSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Ensure MUP3 project is present in projects table without altering existing projects
        $project = Project::where('slug', 'mup3')->first();

        if (! $project) {
            Project::create([
                'slug' => 'mup3',
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
            ]);
        } else {
            // Keep user-customized fields intact, only ensure it's marked as featured
            if (! $project->is_featured) {
                $project->update([
                    'is_featured' => true,
                    'sort_order' => 4,
                ]);
            }
        }

        // 2. Align MUP3 Card 1 default model to Stam 1601
        $card1Model = SiteSetting::where('key', 'mup3_card1_model_slug')->first();
        if ($card1Model) {
            if ($card1Model->value === 'cabo-carnes') {
                $card1Model->update(['value' => 'stam-1601']);
            }
        } else {
            SiteSetting::create([
                'key' => 'mup3_card1_model_slug',
                'value' => 'stam-1601',
                'group' => 'mup3_showcase',
                'type' => 'text',
            ]);
        }

        $card1Title = SiteSetting::where('key', 'mup3_card1_title')->first();
        if ($card1Title && str_contains($card1Title->value, 'Air Force')) {
            $card1Title->update(['value' => 'Stam 1601 Edition']);
        }

        $card1TitleEn = SiteSetting::where('key', 'mup3_card1_title_en')->first();
        if ($card1TitleEn && str_contains($card1TitleEn->value, 'Air Force')) {
            $card1TitleEn->update(['value' => 'Stam 1601 Edition']);
        }

        $card1Brand = SiteSetting::where('key', 'mup3_card1_brand')->first();
        if ($card1Brand && strtolower($card1Brand->value) === 'nike') {
            $card1Brand->update(['value' => 'Norra Studio']);
        }

        $card1BrandEn = SiteSetting::where('key', 'mup3_card1_brand_en')->first();
        if ($card1BrandEn && strtolower($card1BrandEn->value) === 'nike') {
            $card1BrandEn->update(['value' => 'Norra Studio']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Safe down: do not delete user data
    }
};
