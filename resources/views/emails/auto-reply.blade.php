<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Recebemos a sua mensagem • Estúdio Norra</title>
</head>
<body style="margin: 0; padding: 0; background-color: #101010; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #f5f5f5;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #101010; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="100%" max-width="600" cellpadding="0" cellspacing="0" style="max-width: 600px; background-color: #151515; border: 1px solid #282828; border-radius: 20px; padding: 40px; text-align: left;">
                    <!-- Brand Header -->
                    <tr>
                        <td style="border-bottom: 1px solid #282828; padding-bottom: 24px;">
                            <div style="display: inline-block; width: 30px; height: 30px; background-color: #b70606; border-radius: 50%; text-align: center; line-height: 30px; color: #ffffff; font-weight: bold; font-size: 15px;">N</div>
                            <span style="font-size: 16px; font-weight: bold; letter-spacing: 1.5px; color: #ddddd5; margin-left: 10px; vertical-align: middle;">ESTÚDIO NORRA</span>
                        </td>
                    </tr>
                    <!-- Main Text -->
                    @php
                        $isEn = ($locale ?? app()->getLocale()) === 'en';
                    @endphp
                    <tr>
                        <td style="padding-top: 32px;">
                            <h1 style="margin: 0 0 16px 0; font-size: 24px; color: #ffffff; font-weight: 800; letter-spacing: -0.5px;">{{ $isEn ? 'Hello' : 'Olá' }}, {{ $lead->name }}.</h1>
                            <p style="margin: 0 0 16px 0; font-size: 15px; line-height: 1.6; color: #cccccc;">
                                @if($isEn)
                                    Thank you for contacting Estúdio Norra. We have received your message and our creative team is already reviewing your project requirements.
                                @else
                                    Muito obrigado pelo contato com o Estúdio Norra. Recebemos a sua mensagem e nossa equipe já está analisando as informações do seu projeto.
                                @endif
                            </p>
                            <p style="margin: 0 0 24px 0; font-size: 15px; line-height: 1.6; color: #cccccc;">
                                @if($isEn)
                                    We will get back to you within <strong>24 to 48 business hours</strong> to discuss the next steps and schedule a discovery meeting.
                                @else
                                    Entraremos em contato em até <strong>24 a 48 horas úteis</strong> para alinharmos os próximos passos e agendarmos uma conversa direta.
                                @endif
                            </p>

                            <!-- Summary Box -->
                            <div style="background-color: #101010; border: 1px solid #282828; border-radius: 12px; padding: 20px; margin: 24px 0;">
                                <p style="margin: 0 0 8px 0; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; color: #888888; font-weight: 600;">
                                    {{ $isEn ? 'Request Summary:' : 'Resumo da sua solicitação:' }}
                                </p>
                                <p style="margin: 0; font-size: 14px; color: #ddddd5;">
                                    <strong>{{ $isEn ? 'Service:' : 'Serviço:' }}</strong> {{ $lead->service ?? ($isEn ? 'General' : 'Geral') }}<br>
                                    @if($lead->company)<strong>{{ $isEn ? 'Company:' : 'Empresa:' }}</strong> {{ $lead->company }}<br>@endif
                                    <strong>{{ $isEn ? 'Expectation:' : 'Expectativa:' }}</strong> {{ $lead->budget ?? ($isEn ? 'To be defined' : 'A definir') }}
                                </p>
                            </div>

                            <p style="margin: 0 0 24px 0; font-size: 14px; line-height: 1.6; color: #aaaaaa;">
                                @if($isEn)
                                    If you have urgent inquiries or prefer to speak with our directors directly, feel free to reach out via WhatsApp:
                                @else
                                    Caso tenha urgência ou prefira falar imediatamente com um de nossos diretores, sinta-se à vontade para nos chamar no WhatsApp:
                                @endif
                            </p>

                            <div style="text-align: center; margin: 32px 0 16px 0;">
                                <a href="https://wa.me/5567981530042?text={{ urlencode($isEn ? 'Hello! I sent a message through the website and would like to follow up.' : 'Olá! Enviei uma mensagem pelo site e gostaria de agilizar o contato.') }}"
                                   style="display: inline-block; background-color: #ddddd5; color: #101010; font-size: 12px; font-weight: 700; text-decoration: none; padding: 14px 28px; border-radius: 50px; text-transform: uppercase; letter-spacing: 1px;">
                                    {{ $isEn ? 'Chat on WhatsApp' : 'Conversar pelo WhatsApp' }}
                                </a>
                            </div>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td style="padding-top: 32px; border-top: 1px solid #282828; text-align: center; font-size: 12px; color: #666666;">
                            <p style="margin: 0 0 6px 0;">Estúdio Norra • Onde o conceito torna-se arte.</p>
                            <p style="margin: 0;">Campo Grande - MS, Brasil • <a href="https://estudionorra.com" style="color: #888888; text-decoration: none;">estudionorra.com</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
