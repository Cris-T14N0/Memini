<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagem de Contacto</title>
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
        }
        .content {
            padding: 40px 30px;
            background: linear-gradient(135deg, #2d3748 0%, #374151 100%);
        }
        .info-box {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.15) 0%, rgba(16, 185, 129, 0.12) 100%);
            border-left: 4px solid rgba(134, 239, 172, 0.6);
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
        }
        .info-box strong {
            color: #86efac;
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
        }
        .info-box p {
            margin: 0;
            color: #d1d5db !important;
            text-decoration: none !important;
        }
        .question-box {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(37, 99, 235, 0.12) 100%);
            border-left: 4px solid rgba(96, 165, 250, 0.6);
            padding: 20px;
            margin: 25px 0;
            border-radius: 8px;
        }
        .question-box strong {
            color: #93c5fd;
            font-weight: 600;
            display: block;
            margin-bottom: 12px;
        }
        .question-box p {
            margin: 0;
            color: #d1d5db;
            white-space: pre-wrap;
            line-height: 1.6;
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
        .reply-button {
            display: inline-block;
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>Nova Mensagem de Contacto</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Recebeste uma nova mensagem através do formulário de contacto:</p>

            <div class="info-box">
                <strong>👤 Nome:</strong>
                <p>{{ $name }}</p>
            </div>

            <div class="info-box">
                <strong>📧 Email:</strong>
                <p>{{ $email }}</p>
            </div>

            <div class="divider"></div>

            <div class="question-box">
                <strong>💬 Mensagem:</strong>
                <p>{{ $question }}</p>
            </div>

            <div style="text-align: center; margin-top: 30px;">
                <a href="mailto:{{ $email }}" class="reply-button">
                    Responder via Email
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Esta mensagem foi enviada através do formulário de contacto do teu website.</p>
            <p style="font-size: 12px; margin-top: 15px;">
                {{ now()->format('d/m/Y H:i') }}
            </p>
        </div>
    </div>
</body>
</html>