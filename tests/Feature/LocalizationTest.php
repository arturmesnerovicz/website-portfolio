<?php

namespace Tests\Feature;

use App\Mail\LeadAutoReply;
use App\Models\Faq;
use App\Models\Project;
use App\Models\Service;
use Database\Seeders\ContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class LocalizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_portuguese_homepage_renders_default_locale(): void
    {
        $this->seed(ContentSeeder::class);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('<html lang="pt-BR"', false);
        $response->assertSee('Projetos Selecionados');
        $response->assertSee('Iniciar Projeto');
        $response->assertSee('href="'.url('/en').'"', false);
    }

    public function test_english_homepage_renders_en_locale(): void
    {
        $this->seed(ContentSeeder::class);

        $response = $this->get('/en');

        $response->assertStatus(200);
        $response->assertSee('<html lang="en"', false);
        $response->assertSee('SELECTED PROJECTS');
        $response->assertSee('Start Project');
        $response->assertSee('Everything you need to know');
        $response->assertSee('ALL RIGHTS RESERVED');
        $response->assertSee('href="'.url('/').'"', false);
    }

    public function test_projects_page_in_both_locales(): void
    {
        $this->seed(ContentSeeder::class);

        // Portuguese route
        $responsePt = $this->get('/projetos');
        $responsePt->assertStatus(200);
        $responsePt->assertSee('TODOS OS PROJETOS');
        $responsePt->assertSee('Todos');

        // English route
        $responseEn = $this->get('/en/projects');
        $responseEn->assertStatus(200);
        $responseEn->assertSee('ALL PROJECTS');
        $responseEn->assertSee('All');
    }

    public function test_translatable_models_render_appropriate_translations(): void
    {
        $project = Project::create([
            'title' => ['pt_BR' => 'Projeto Incrível', 'en' => 'Incredible Project'],
            'slug' => 'incredible-project',
            'client' => 'Acme Corp',
            'year' => '2026',
            'category' => ['pt_BR' => 'Identidade Visual', 'en' => 'Visual Identity'],
            'cover_image' => 'projects/test.webp',
            'short_description' => ['pt_BR' => 'Descrição curta PT', 'en' => 'Short description EN'],
            'full_description' => ['pt_BR' => 'Descrição completa PT', 'en' => 'Full description EN'],
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        $service = Service::create([
            'order_num' => '01',
            'title' => ['pt_BR' => 'Design de Interfaces', 'en' => 'Interface Design'],
            'category' => ['pt_BR' => 'Web Design', 'en' => 'Web Design'],
            'description' => ['pt_BR' => 'Criamos interfaces belas.', 'en' => 'We create beautiful interfaces.'],
            'icon' => 'globe',
            'sort_order' => 1,
        ]);

        $faq = Faq::create([
            'question' => ['pt_BR' => 'Como funciona?', 'en' => 'How does it work?'],
            'answer' => ['pt_BR' => 'Funciona muito bem.', 'en' => 'It works very well.'],
            'sort_order' => 1,
        ]);

        // When viewing Portuguese page
        $responsePt = $this->get('/');
        $responsePt->assertStatus(200);
        $responsePt->assertSee('Projeto Incrível');
        $responsePt->assertSee('Design de Interfaces');
        $responsePt->assertSee('Como funciona?');

        // When viewing English page
        $responseEn = $this->get('/en');
        $responseEn->assertStatus(200);
        $responseEn->assertSee('Incredible Project');
        $responseEn->assertSee('Interface Design');
        $responseEn->assertSee('How does it work?');
    }

    public function test_sitemap_includes_both_locales_and_hreflang(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertSee('hreflang="pt-BR"', false);
        $response->assertSee('hreflang="en"', false);
        $response->assertSee('/en</loc>', false);
        $response->assertSee('/en/projects</loc>', false);
    }

    public function test_contact_submission_in_english_sends_localized_email(): void
    {
        Mail::fake();

        $payload = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '+1 555 123 4567',
            'company' => 'Global Inc',
            'service' => 'Web Development',
            'budget' => '$10k - $25k',
            'message' => 'We want to build a world-class website with Estúdio Norra.',
        ];

        $response = $this->postJson(route('en.contact.store'), $payload);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Message sent successfully! Thank you for reaching out, we will respond within 24 hours.',
            ]);

        $this->assertDatabaseHas('leads', [
            'email' => 'john@example.com',
            'name' => 'John Doe',
        ]);

        Mail::assertSent(LeadAutoReply::class, function ($mail) {
            return $mail->hasTo('john@example.com') && $mail->locale === 'en';
        });
    }
}
