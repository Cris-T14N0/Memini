<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Álbum Partilhado</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #1f2937 0%, #374151 50%, #1f2937 100%);
            line-height: 1.6;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: linear-gradient(135deg, #2d3748 0%, #1f2937 100%);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(34, 197, 94, 0.2);
        }
        .header {
            background: linear-gradient(135deg, #374151 0%, #2d3748 100%);
            padding: 40px 30px;
            text-align: center;
            border-bottom: 2px solid rgba(34, 197, 94, 0.3);
        }
        .header h1 {
            margin: 0;
            color: #f3f4f6;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        .content {
            padding: 40px 30px;
            background: linear-gradient(135deg, #2d3748 0%, #374151 100%);
        }
        .message-box {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.15) 0%, rgba(16, 185, 129, 0.12) 100%);
            border-left: 4px solid rgba(134, 239, 172, 0.6);
            padding: 20px;
            margin: 25px 0;
            border-radius: 8px;
        }
        .message-box strong {
            color: #86efac;
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
        }
        .message-box p {
            margin: 0;
            color: #d1d5db;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: #ffffff !important;
            text-decoration: none;
            padding: 16px 40px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
            box-shadow: 0 4px 12px rgba(34, 197, 94, 0.4);
            transition: all 0.3s ease;
        }
        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(34, 197, 94, 0.5);
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .expiry-notice {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(220, 38, 38, 0.12) 100%);
            border-left: 4px solid rgba(248, 113, 113, 0.6);
            padding: 15px;
            margin-top: 25px;
            border-radius: 8px;
            font-size: 14px;
            color: #fca5a5;
        }
        .footer {
            background: linear-gradient(135deg, #1f2937 0%, #2d3748 100%);
            padding: 30px;
            text-align: center;
            border-top: 1px solid rgba(34, 197, 94, 0.2);
        }
        .footer p {
            margin: 5px 0;
            color: #9ca3af;
            font-size: 14px;
        }
        p {
            color: #d1d5db;
            margin: 15px 0;
        }
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, rgba(134, 239, 172, 0.3) 50%, transparent 100%);
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>Um álbum foi partilhado contigo!</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Olá! 👋</p>
            <p>Recebeste um álbum especial. Clica no botão abaixo para ver todas as fotos e vídeos.</p>

            @if($sharedLink->message)
            <div class="message-box">
                <strong>💬 Mensagem pessoal:</strong>
                <p>{{ $sharedLink->message }}</p>
            </div>
            @endif

            <div class="divider"></div>

            <div class="button-container">
                <a href="{{ route('shared.show', $sharedLink->token) }}" class="cta-button">
                    🎨 Ver Álbum Completo
                </a>
            </div>

            <p style="text-align: center; font-size: 14px; color: #6b7280;">
                Podes ver, ampliar e fazer download de todos os ficheiros
            </p>

            @if($sharedLink->expires_at)
            <div class="expiry-notice">
                <strong>⏰ Atenção:</strong> Este link expira em <strong>{{ $sharedLink->expires_at->format('d/m/Y') }}</strong> às <strong>{{ $sharedLink->expires_at->format('H:i') }}</strong>
            </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Este email foi enviado automaticamente. Por favor, não respondas.</p>
            <p style="font-size: 12px; margin-top: 15px;">
                Se não solicitaste este álbum, podes ignorar este email.
            </p>
        </div>
    </div>
</body>
</html>