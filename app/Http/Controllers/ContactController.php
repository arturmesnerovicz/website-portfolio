<?php

namespace App\Http\Controllers;

use App\Mail\LeadAutoReply;
use App\Mail\NewLeadNotification;
use App\Models\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Handle incoming contact form submissions.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        // 1. Anti-spam Honeypot: bots fill hidden 'website' field
        if ($request->filled('website')) {
            Log::info('Spam bot caught via contact honeypot', ['ip' => $request->ip()]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => __('Mensagem enviada com sucesso! Em breve entraremos em contato.'),
                ]);
            }

            return back()->with('success', __('Mensagem enviada com sucesso! Em breve entraremos em contato.'));
        }

        // 2. Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'service' => 'nullable|string|max:100',
            'budget' => 'nullable|string|max:100',
            'message' => 'required|string|max:5000',
        ]);

        // 3. Store Lead in database
        $lead = Lead::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'company' => $validated['company'] ?? null,
            'service' => $validated['service'] ?? null,
            'budget' => $validated['budget'] ?? null,
            'message' => $validated['message'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'new',
        ]);

        // 4. Send Automated Emails (with safe error handling)
        $notifyEmail = config('mail.notify_email', 'contato@estudionorra.com');

        try {
            // Internal team notification
            Mail::to($notifyEmail)->send(new NewLeadNotification($lead));
        } catch (\Throwable $e) {
            Log::error('Failed to send internal lead notification email', [
                'lead_id' => $lead->id,
                'error' => $e->getMessage(),
            ]);
        }

        try {
            // Client confirmation auto-reply
            Mail::to($lead->email)->send(new LeadAutoReply($lead, app()->getLocale()));
        } catch (\Throwable $e) {
            Log::error('Failed to send client auto-reply email', [
                'lead_id' => $lead->id,
                'error' => $e->getMessage(),
            ]);
        }

        $successMessage = __('Mensagem enviada com sucesso! Obrigado pelo contato, responderemos em até 24 horas.');

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $successMessage,
            ]);
        }

        return back()->with('success', $successMessage);
    }
}
