<?php

namespace Tests\Feature;

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
        $response->assertSee('Web Design');
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
}
