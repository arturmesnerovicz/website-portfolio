<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Novo Lead Recebido</title>
</head>
<body style="margin: 0; padding: 0; background-color: #101010; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #f5f5f5;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #101010; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="100%" max-width="600" cellpadding="0" cellspacing="0" style="max-width: 600px; background-color: #151515; border: 1px solid #282828; border-radius: 20px; padding: 36px; text-align: left;">
                    <!-- Header -->
                    <tr>
                        <td style="border-bottom: 1px solid #282828; padding-bottom: 20px;">
                            <div style="display: inline-block; width: 28px; height: 28px; background-color: #b70606; border-radius: 50%; text-align: center; line-height: 28px; color: #ffffff; font-weight: bold; font-size: 14px;">N</div>
                            <span style="font-size: 16px; font-weight: bold; letter-spacing: 1px; color: #ddddd5; margin-left: 10px; vertical-align: middle;">ESTÚDIO NORRA</span>
                        </td>
                    </tr>
                    <!-- Title -->
                    <tr>
                        <td style="padding-top: 24px;">
                            <h2 style="margin: 0; font-size: 22px; color: #ffffff; font-weight: 700;">Novo Contato Recebido pelo Site</h2>
                            <p style="margin: 8px 0 24px 0; font-size: 14px; color: #888888;">Um visitante preencheu o formulário de contato no site.</p>
                        </td>
                    </tr>
                    <!-- Lead Details -->
                    <tr>
                        <td>
                            <table width="100%" cellpadding="8" cellspacing="0" style="font-size: 14px; color: #ddddd5; background-color: #101010; border-radius: 12px; padding: 12px;">
                                <tr>
                                    <td width="30%" style="color: #888888; font-weight: 600;">Nome:</td>
                                    <td><strong style="color: #ffffff;">{{ $lead->name }}</strong></td>
                                </tr>
                                <tr>
                                    <td style="color: #888888; font-weight: 600;">E-mail:</td>
                                    <td><a href="mailto:{{ $lead->email }}" style="color: #b70606; text-decoration: none;">{{ $lead->email }}</a></td>
                                </tr>
                                <tr>
                                    <td style="color: #888888; font-weight: 600;">Telefone:</td>
                                    <td>{{ $lead->phone ?? 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #888888; font-weight: 600;">Empresa:</td>
                                    <td>{{ $lead->company ?? 'Não informada' }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #888888; font-weight: 600;">Serviço:</td>
                                    <td><span style="background-color: #242424; padding: 3px 8px; border-radius: 6px; font-size: 12px;">{{ $lead->service ?? 'Geral' }}</span></td>
                                </tr>
                                <tr>
                                    <td style="color: #888888; font-weight: 600;">Orçamento:</td>
                                    <td>{{ $lead->budget ?? 'A definir' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Message -->
                    <tr>
                        <td style="padding-top: 24px;">
                            <p style="margin: 0 0 8px 0; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; color: #888888; font-weight: 600;">Mensagem do Cliente:</p>
                            <div style="background-color: #101010; border-left: 3px solid #b70606; padding: 16px; border-radius: 0 12px 12px 0; font-size: 14px; line-height: 1.6; color: #f0f0f0;">
                                {!! nl2br(e($lead->message)) !!}
                            </div>
                        </td>
                    </tr>
                    <!-- Footer Link -->
                    <tr>
                        <td style="padding-top: 32px; border-top: 1px solid #282828; margin-top: 24px; text-align: center;">
                            <a href="{{ url('/admin/leads') }}" style="display: inline-block; background-color: #ddddd5; color: #101010; font-size: 12px; font-weight: bold; text-decoration: none; padding: 12px 24px; border-radius: 50px; text-transform: uppercase; letter-spacing: 1px;">
                                Acessar no Painel Filament
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
