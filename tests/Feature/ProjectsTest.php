<?php

namespace Tests\Feature;

use App\Models\Project;
use Database\Seeders\ContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use RefreshDatabase;

    public function test_projects_page_renders_successfully(): void
    {
        $this->seed(ContentSeeder::class);

        $response = $this->get('/projetos');

        $response->assertStatus(200);
        $response->assertSee('TODOS OS PROJETOS');
        $response->assertSee('id="project-modal"', false);
    }

    public function test_project_without_url_renders_modal_trigger_without_anchor_hash(): void
    {
        Project::create([
            'title' => 'Projeto Teste Modal',
            'slug' => 'projeto-teste-modal',
            'client' => 'Cliente Teste',
            'year' => '2025',
            'category' => 'Web Site',
            'cover_image' => 'projects/test-cover.webp',
            'mockup_image' => 'projects/test-mockup.webp',
            'short_description' => 'Descrição curta do projeto modal',
            'full_description' => 'Descrição completa do projeto modal',
            'link_url' => null,
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Project::create([
            'title' => 'Projeto Teste Link',
            'slug' => 'projeto-teste-link',
            'client' => 'Cliente Link',
            'year' => '2025',
            'category' => 'Web Site',
            'cover_image' => 'projects/test-cover-2.webp',
            'short_description' => 'Descrição curta do projeto link',
            'link_url' => 'https://example.com/projeto',
            'is_featured' => true,
            'sort_order' => 2,
        ]);

        $response = $this->get('/projetos');

        $response->assertStatus(200);

        // Project without URL should have data-project-modal-trigger and contain modal data
        $response->assertSee('data-project-modal-trigger', false);
        $response->assertSee('Projeto Teste Modal');
        $response->assertDontSee('onclick="event.preventDefault(); if (typeof window.openProjectModal', false);

        // Project with URL should link externally with target="_blank"
        $response->assertSee('href="https://example.com/projeto"', false);
        $response->assertSee('target="_blank"', false);
    }

    public function test_project_modal_renders_centered_layout_without_info_aside(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('id="project-modal"', false);
        $response->assertSee('id="project-modal-card"', false);
        $response->assertSee('id="modal-image"', false);
        // Ensure info aside card elements are removed
        $response->assertDontSee('id="modal-category"', false);
        $response->assertDontSee('id="modal-client"', false);
        $response->assertDontSee('id="modal-year"', false);
        $response->assertDontSee('id="modal-description"', false);
        $response->assertDontSee('id="modal-tags"', false);
        $response->assertDontSee('id="modal-cta-btn"', false);
    }
}
