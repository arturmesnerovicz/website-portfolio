<?php

use App\Models\SiteSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $setting = SiteSetting::firstOrCreate(
            ['key' => 'og_image'],
            [
                'value' => 'settings/seo/01M4C4AW0ESE5M256M6EPF14XF.png',
                'group' => 'seo',
                'type' => 'image',
                'label' => 'Imagem Open Graph (WhatsApp, LinkedIn, Redes Sociais)',
                'description' => 'Imagem 1200x630px para pré-visualização ao compartilhar links.',
            ]
        );

        if (empty($setting->value)) {
            $setting->update(['value' => 'settings/seo/01M4C4AW0ESE5M256M6EPF14XF.png']);
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
