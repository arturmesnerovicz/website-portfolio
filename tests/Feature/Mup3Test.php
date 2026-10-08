<?php

namespace Tests\Feature;

use App\Models\Product3dModel;
use App\Models\Project;
use App\Models\SiteSetting;
use App\Models\User;
use Database\Seeders\ContentSeeder;
use Database\Seeders\Mup3Seeder;
use Database\Seeders\Product3dSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Mup3Test extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(ContentSeeder::class);
        $this->seed(Product3dSeeder::class);
        $this->seed(Mup3Seeder::class);
    }

    public function test_mup3_showcase_page_renders_successfully(): void
    {
        $response = $this->get('/projetos/mup3');

        $response->assertStatus(200);
        $response->assertSee('YOUR CARDS, PROTECTED');
        $response->assertSee('Stam 1601 Edition');
        $response->assertSee('Stam 803 Edition');
        $response->assertSee('79$');
        $response->assertSee('89$');
        $response->assertSee('mup3-card-canvas-1', false);
        $response->assertSee('mup3-card-canvas-2', false);
        $response->assertSee('mup3-showcase-data', false);
    }

    public function test_mup3_english_route_renders_successfully(): void
    {
        $response = $this->get('/en/projects/mup3');

        $response->assertStatus(200);
        $response->assertSee('YOUR CARDS, PROTECTED');
        $response->assertSee('Learn more');
    }

    public function test_project_show_route_redirects_mup3_to_dedicated_page(): void
    {
        $response = $this->get('/projetos/mup3');
        $response->assertStatus(200);

        // Accessing via fallback route /projetos/{slug}
        $project = Project::where('slug', 'mup3')->first();
        $this->assertNotNull($project);

        $responseSlug = $this->get('/projetos/'.$project->slug);
        $responseSlug->assertStatus(200);
        $responseSlug->assertSee('mup3-presentation', false);
    }

    public function test_projects_listing_page_renders_mup3_with_direct_link_not_modal(): void
    {
        $response = $this->get('/projetos');

        $response->assertStatus(200);
        // MUP3 should be linked directly to its dedicated showcase URL
        $response->assertSee('/projetos/mup3');
    }

    public function test_mup3_showcase_page_renders_with_inverted_card_colors(): void
    {
        $response = $this->get('/projetos/mup3');

        $response->assertStatus(200);
        // Outer card body should be dark/black
        $response->assertSee('bg-[#141414] text-white rounded-[14px]', false);
        // Inner 3D product container should be white
        $response->assertSee('bg-[#ffffff] rounded-[10px]', false);
    }

    public function test_mup3_showcase_can_render_models_even_when_is_active_is_false(): void
    {
        Product3dModel::query()->update(['is_active' => false]);

        $response = $this->get('/projetos/mup3');

        $response->assertStatus(200);
        $showcase = $response->viewData('showcase');
        $this->assertNotNull($showcase['card1']['model']);
        $this->assertNotNull($showcase['card2']['model']);
    }

    public function test_admin_can_access_manage_mup3_showcase_page_via_studio_3d_cluster(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/estudio-3d/manage-mup3-showcase');

        $response->assertStatus(200);
        $response->assertSee('Apresentação MUP3');
    }

    public function test_mup3_page_reflects_updated_settings_and_local_3d_properties(): void
    {
        SiteSetting::set('mup3_title', 'NOVO TITULO MUP3', 'mup3_showcase');
        SiteSetting::set('mup3_description', 'Descrição atualizada via teste', 'mup3_showcase');
        SiteSetting::set('mup3_card1_title', 'Produto Especial A', 'mup3_showcase');
        SiteSetting::set('mup3_card2_title', 'Produto Especial B', 'mup3_showcase');
        SiteSetting::set('mup3_card1_price', '120$', 'mup3_showcase');
        SiteSetting::set('mup3_card2_price', '240$', 'mup3_showcase');
        SiteSetting::set('mup3_card1_scale', '1.45', 'mup3_showcase');
        SiteSetting::set('mup3_card1_fov', '32', 'mup3_showcase');
        SiteSetting::set('mup3_card1_mat_override', '1', 'mup3_showcase');
        SiteSetting::set('mup3_card1_tint_color', '#ff5500', 'mup3_showcase');

        $response = $this->get('/projetos/mup3');

        $response->assertStatus(200);
        $response->assertSee('NOVO TITULO MUP3');
        $response->assertSee('Descrição atualizada via teste');
        $response->assertSee('Produto Especial A');
        $response->assertSee('Produto Especial B');
        $response->assertSee('120$');
        $response->assertSee('240$');
        $response->assertSee('"scale":1.45', false);
        $response->assertSee('"fov":32', false);
        $response->assertSee('"tint_color":"#ff5500"', false);
    }

    public function test_admin_can_access_manage_appearance_settings_page(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/manage-appearance-settings');

        $response->assertStatus(200);
        $response->assertSee('Aparência &amp; Efeitos', false);
    }

    public function test_mup_hyphen_slug_routes_to_showcase_page(): void
    {
        $response = $this->get('/projetos/mup-3');

        $response->assertStatus(200);
        $response->assertSee('mup3-presentation', false);
    }

    public function test_mup3_english_route_uses_english_settings(): void
    {
        SiteSetting::set('mup3_title_en', 'BESPOKE 3D HARDWARE SHOWCASE', 'mup3_showcase');
        SiteSetting::set('mup3_description_en', 'Explore millimeter accuracy and bespoke finishes.', 'mup3_showcase');
        SiteSetting::set('mup3_cta_text_en', 'Explore Products', 'mup3_showcase');

        $response = $this->get('/en/projects/mup3');

        $response->assertStatus(200);
        $response->assertSee('BESPOKE 3D HARDWARE SHOWCASE');
        $response->assertSee('Explore millimeter accuracy and bespoke finishes.');
        $response->assertSee('Explore Products');
    }

    public function test_contact_form_submission_creates_lead_from_mup3_page(): void
    {
        $response = $this->postJson('/contato', [
            'name' => 'Cliente MUP3',
            'email' => 'cliente@mup3.com',
            'message' => 'Gostaria de um orçamento para apresentação 3D',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $this->assertDatabaseHas('leads', [
            'email' => 'cliente@mup3.com',
            'name' => 'Cliente MUP3',
        ]);
    }

    public function test_inactive_mup3_redirects_to_projects_page_and_is_hidden(): void
    {
        $project = Project::where('slug', 'mup3')->first();
        $this->assertNotNull($project);
        $project->update(['is_active' => false]);

        // Home should not show inactive MUP3
        $responseHome = $this->get('/');
        $responseHome->assertDontSee('Apresentação MUP3');

        // Projects listing should not show inactive MUP3
        $responseProjects = $this->get('/projetos');
        $responseProjects->assertDontSee('/projetos/mup3');

        // Direct visit should redirect to /projetos
        $responseShow = $this->get('/projetos/mup3');
        $responseShow->assertRedirect('/projetos');

        // English direct visit should redirect to /en/projects
        $responseEn = $this->get('/en/projects/mup3');
        $responseEn->assertRedirect('/en/projects');
    }
}
