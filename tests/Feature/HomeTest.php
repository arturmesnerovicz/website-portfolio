<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\User;
use Database\Seeders\ContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_renders_successfully(): void
    {
        $this->seed(ContentSeeder::class);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('ESTÚDIO NORRA');
        $response->assertSee('Projetos Selecionados');
        $response->assertSee('Expertise');
        $response->assertSee('Jornada do Projeto');
        $response->assertSee('Ficou com');
        $response->assertSee('Hub Arquitetura');
        $response->assertSee('Website Development');
        $response->assertSee('Website Design');
        $response->assertSee('Website Strategy');
        $response->assertSee('Brand Strategy');
        $response->assertSee('Visual Identity');
    }

    public function test_sitemap_returns_valid_xml(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml');
        $response->assertSee('<urlset', false);
        $response->assertSee('<loc>', false);
    }

    public function test_robots_returns_plain_text(): void
    {
        $response = $this->get('/robots.txt');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/plain; charset=UTF-8');
        $response->assertSee('User-agent: *');
        $response->assertSee('Disallow: /admin');
        $response->assertSee('Sitemap:');
    }

    public function test_home_page_renders_og_image_and_twitter_image_tags(): void
    {
        $this->seed(ContentSeeder::class);
        SiteSetting::set('og_image', null);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('property="og:image"', false);
        $response->assertSee('property="og:image:secure_url"', false);
        $response->assertSee('name="twitter:image"', false);
        // Default fallback should be a valid raster image (not SVG)
        $response->assertSee('assets/logos/norra-monogram.png', false);
    }

    public function test_home_page_renders_custom_og_image_when_configured(): void
    {
        $this->seed(ContentSeeder::class);
        SiteSetting::set('og_image', 'settings/seo/custom-banner.webp', 'seo', 'image');

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('storage/settings/seo/custom-banner.webp', false);
    }

    public function test_admin_can_access_manage_seo_settings_page(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/manage-seo-settings');

        $response->assertStatus(200);
        $response->assertSee('SEO &amp; Compartilhamento Social (Open Graph)', false);
        $response->assertSee('Imagem Open Graph (og:image)');
    }

    public function test_admin_can_access_manage_services_section_page(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/manage-services-section');

        $response->assertStatus(200);
        $response->assertSee('Gerenciar Seção de Serviços &amp; Mockups', false);
        $response->assertSee('Cards do Carrossel de Mockups');
    }

    public function test_home_page_renders_services_from_database_in_carousel(): void
    {
        $this->seed(ContentSeeder::class);

        Service::query()->create([
            'order_num' => '99',
            'title' => 'Custom E-Commerce Architecture',
            'category' => 'High-End Web',
            'description' => 'Test description',
            'image' => 'services/custom-mockup-test.png',
            'deliverables' => ['Shopify', 'Laravel'],
            'sort_order' => 99,
            'is_active' => true,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('storage/services/custom-mockup-test.png', false);
        $response->assertSee('Custom E-Commerce Architecture');
    }

    public function test_home_page_respects_services_is_active_flag(): void
    {
        $this->seed(ContentSeeder::class);

        Service::query()->create([
            'order_num' => '98',
            'title' => 'Hidden Inactive Service Mockup',
            'category' => 'Internal',
            'description' => 'Internal service description',
            'image' => 'services/hidden-mockup.png',
            'sort_order' => 98,
            'is_active' => false,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertDontSee('storage/services/hidden-mockup.png');
        $response->assertDontSee('Hidden Inactive Service Mockup');
    }

    public function test_home_page_renders_custom_services_heading_from_settings(): void
    {
        $this->seed(ContentSeeder::class);

        SiteSetting::set('services_title', 'Design Digital que Converte e Impressiona', 'services');
        SiteSetting::set('services_subtitle', 'Projetos sob medida com excelência e tecnologia de ponta.', 'services');

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Design Digital que Converte e Impressiona');
        $response->assertSee('Projetos sob medida com excelência e tecnologia de ponta.');
    }
}
