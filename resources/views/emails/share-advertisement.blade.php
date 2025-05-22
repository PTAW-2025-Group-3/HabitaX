<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $advertisement->title }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .header {
            background: linear-gradient(to right, #1e3a8a, #4f46e5);
            color: #ffffff;
            padding: 25px;
            text-align: center;
        }
        .content {
            padding: 30px;
        }
        .footer {
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
        .title {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
        }
        .price {
            font-size: 24px;
            font-weight: bold;
            color: #ffffff;
            margin: 10px 0 0;
        }
        .message {
            background-color: #f0f4ff;
            border-left: 4px solid #4f46e5;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            font-style: italic;
        }
        .button {
            display: inline-block;
            background-color: #1e3a8a;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            margin: 20px 0;
        }
        .button:hover {
            background-color: #1e3a8a;
        }
        .property-image {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .property-details {
            background-color: #f9fafc;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
        }
        .property-details-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            border-bottom: 1px solid #eee;
            padding-bottom: 8px;
        }
        .property-details-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .detail-label {
            font-weight: 600;
            color: #666;
        }
        .detail-value {
            color: #333;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1 class="title">{{ $advertisement->title }}</h1>
        <div class="price">{{ number_format($advertisement->price, 0, ',', '.') }}€</div>
    </div>

    <div class="content">
        @if($advertisement->property && $advertisement->property->getFirstMediaUrl('images'))
            <img src="{{ url($advertisement->property->getFirstMediaUrl('images')) }}" alt="Imagem do imóvel" class="property-image">
        @elseif(isset($advertisement->property->district))
            <img src="{{ asset('images/districts/' . Str::slug($advertisement->property->district) . '.jpg') }}" alt="Imagem da localidade" class="property-image">
        @else
            <img src="{{ asset('images/default-property.jpg') }}" alt="Imagem de imóvel" class="property-image">
        @endif

        @if(!empty($messageContent))
            <div class="message">
                <p>{{ $messageContent }}</p>
            </div>
        @endif

        <p>Olá,</p>

        <p>{{ $senderEmail }} partilhou consigo este anúncio que poderá ser do seu interesse.</p>

        <div class="property-details">
            <div class="property-details-row">
                <span class="detail-label">Transação:</span>
                <span class="detail-value">{{ $advertisement->transaction_type }}</span>
            </div>
            <div class="property-details-row">
                <span class="detail-label">Localização:</span>
                <span class="detail-value">
                        {{ $advertisement->property->parish->name ?? '' }}{{ ($advertisement->property->parish && $advertisement->property->parish->municipality) ? ', ' : '' }}
                    {{ $advertisement->property->parish->municipality->name ?? '' }}
                    </span>
            </div>
        </div>

        <p>Para ver todos os detalhes deste anúncio, clique no botão abaixo:</p>

        <center>
            <a href="{{ $advertisementUrl }}" class="button" style="color: #ffffff;">Ver anúncio completo</a>
        </center>

        <p>Se o botão não funcionar, copie e cole este link no seu navegador:</p>
        <p style="word-break: break-all; font-size: 14px; color: #4f46e5;">{{ $advertisementUrl }}</p>
    </div>

    <div class="footer">
        <p>Este email foi enviado porque {{ $senderEmail }} partilhou este anúncio consigo.</p>
        <p>Este é um email automático enviado por {{ config('app.name') }}. Por favor não responda a este email.</p>
        <p>© {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.</p>
    </div>
</div>
</body>
</html>
