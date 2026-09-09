<?php

namespace Tests\Feature;

use App\Mail\LeadAutoReply;
use App\Mail\NewLeadNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_submit_contact_form_successfully(): void
    {
        Mail::fake();

        $payload = [
            'name' => 'Renato Silva',
            'email' => 'renato@empresa.com',
            'phone' => '(67) 99999-8888',
            'company' => 'Silva Arquitetura',
            'service' => 'Web Design',
            'budget' => 'R$ 10k - 25k',
            'message' => 'Gostaria de criar uma nova presença digital para o nosso escritório.',
        ];

        $response = $this->postJson(route('contact.store'), $payload);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseHas('leads', [
            'email' => 'renato@empresa.com',
            'company' => 'Silva Arquitetura',
        ]);

        Mail::assertSent(NewLeadNotification::class);
        Mail::assertSent(LeadAutoReply::class);
    }

    public function test_honeypot_prevents_spam_without_saving_lead(): void
    {
        Mail::fake();

        $payload = [
            'name' => 'Spam Bot',
            'email' => 'bot@spammer.com',
            'message' => 'Spam message offering backlinks',
            'website' => 'http://spam-link.com', // Honeypot field filled
        ];

        $response = $this->postJson(route('contact.store'), $payload);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseMissing('leads', [
            'email' => 'bot@spammer.com',
        ]);

        Mail::assertNothingSent();
    }

    public function test_validation_requires_name_email_and_message(): void
    {
        $response = $this->postJson(route('contact.store'), [
            'phone' => '12345',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'message']);
    }
}
