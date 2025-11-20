<!DOCTYPE html>
<html>
<head>
    <style>
        /* Variables y Fuente Base */
        :root {
            --primary-color: #007bff; /* Azul para detalles */
            --secondary-color: #e6f7ff; /* Fondo claro */
            --success-color: #28a745; /* Verde para la etiqueta */
            --border-color: #ddd;
        }

        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: 40px; /* Margen estándar */
            font-size: 10pt;
            overflow-y: hidden;
        }

        /* 1. CABECERA Y DATOS DE LA EMPRESA */
        .header-main {
            display: flex; /* Usamos flexbox para alinear elementos */
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 25px;
        }
        .logo-box {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: #333;
            color: white;
            text-align: center;
            line-height: 40px;
            font-size: 18pt;
            margin-right: 10px;
            vertical-align: top;
        }
        .company-details {
            display: inline-block;
        }
        .company-details h1 {
            margin: 0;
            font-size: 14pt;
        }
        .company-details p {
            margin: 2px 0;
            font-size: 9pt;
            color: #555;
        }
        
        /* Etiqueta de documento (COTZACIÓN) */
        .document-tag {
            background-color: var(--success-color);
            color: white;
            padding: 4px 8px;
            font-size: 8pt;
            font-weight: bold;
            border-radius: 3px;
            position: absolute;
            top: 40px;
            right: 40px;
        }
        /* Bloque de Folio y Fecha */
        .folio-date {
            text-align: right;
            font-size: 9pt;
            margin-top: 5px;
        }
        .folio-date strong {
            font-size: 10pt;
            color: #000;
        }

        /* 2. CONTENEDOR PRINCIPAL DE 2 COLUMNAS (CLIENTE/CONDICIONES) */
        .main-grid {
            overflow-x: hidden;
            margin-bottom: 1px;
            padding-bottom: 20px;
        }
        .col-left, .col-right {
            float: left;
            box-sizing: border-box;
            padding: 0 10px 20px 10px; /* Espacio entre columnas */
        }
        .col-left {
            width: 60%;
        }
        .col-right {
            width: 40%;
            margin-bottom: 60px;
        }
        
        /* Estilos para todos los paneles (cajas) */
        .panel {
            border: 1px solid var(--border-color);
            padding: 5px;
            margin-bottom: 5px;
            border-radius: 5px;
            background-color: white; /* Aseguramos fondo blanco */
        }
        
        /* Estilos específicos de secciones */
        .panel h3 {
            font-size: 11pt;
            font-weight: bold;
            color: #333;
            margin-top: 0;
            padding-bottom: 5px;
            border-bottom: 1px dashed var(--border-color); /* Línea punteada */
            margin-bottom: 10px;
        }
        .info-data p {
            margin: 4px 0;
        }

        /* Bloque de Resumen (derecha) */
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
            padding: 2px 0;
        }
        .summary-row.total {
            font-weight: bold;
            font-size: 11pt;
            border-top: 1px solid #000;
            padding-top: 8px;
            margin-top: 8px;
        }
        .summary-row span.label {
            color: #555;
        }


        /* 3. DETALLE DEL PRODUCTO (TABLA) */
        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        .detail-table th, .detail-table td {
            border: 1px solid var(--border-color);
            text-align: left;
            font-size: 11pt;
        }
        .detail-table th {
            background-color: var(--secondary-color);
        }
        .detail-table td.align-right {
            text-align: right;
        }
        .detail-table td.align-center {
            text-align: center;
        }
        .detail-table td span.description {
            font-size: 9pt;
            color: #555;
            display: block;
            margin-top: 2px;
        }

        /* 4. NOTAS Y FIRMA */
        .notes-section {
            padding: 15px;
            border: 1px solid var(--border-color);
            margin-top: 20px;
            border-radius: 5px;
        }
        .signature-line {
            margin-top: 40px;
            text-align: left;
            font-size: 9pt;
        }
        .signature-line strong {
            display: block;
            border-bottom: 1px solid #000;
            width: 250px;
            padding-bottom: 2px;
            margin-bottom: 5px;
        }
        .signature-line p {
            margin: 2px 0;
        }

    </style>
</head>
<body>
    
    <div class="document-tag">COTIZACIÓN</div>

    <div class="header-main">
        <div class="company-details">
            <span class="logo-box">E</span>
            <div style="display: inline-block;">
                <h1>Carpinteria</h1>
                <p>Dirección • Tel: (52) 9994-400-300 • carpinteria@gmail.com</p>
            </div>
        </div>
        <div class="folio-date">
            Folio: <strong>COT-{{ $quotation->id ?? 'COT-2025-001' }}</strong><br>
            Fecha: <strong>{{ $quotation->creation_date->format('d/m/y') ?? '14/11/2025' }}</strong>
        </div>
    </div>

    <div class="main-grid">
        <div class="col-left">
            <div class="panel info-data" style="padding: 10px; margin-bottom: 10px; background-color: var(--secondary-color);">
                <strong>Válido hasta:</strong> {{ $quotation->expiration_date->format('d/m/y') }}
            </div>

            <div class="panel">
                <h4>Nombre del cliente: {{ $quotation->customer }}</h4>
            </div>

            <div class="panel">
                <h3>Producto</h3>
                <p><strong>Nombre del producto:</strong> {{ $quotation->name }}</p>
                <p><strong>Descripción:</strong>{{ $description }}</p>
            </div>
        </div>
        
        <div class="col-right ">
            <div class="panel">
                <h3>Condiciones</h3>
                <ul style="font-size: 9pt;">
                    <li>Pago 50% anticipo</li>
                    <li>Entrega estimada 7-14 días hábiles</li>
                </ul>
            </div>

            <div class="panel">
                <h3>Resumen</h3>
                <div class="summary-row">
                    <span class="label">Precio unitario:</span>
                    <span>${{ number_format($quotation->total, 2) }}</span>
                </div>
                <div class="summary-row">
                    <span class="label">Cantidad:</span>
                    <span>{{ $quantity }}</span>
                </div>
                <div class="summary-row">
                    <span class="label">Descuento:</span>
                    <span>$ 0.0</span>
                </div>
                <div class="summary-row total">
                    <span class="label">Total:</span>
                    <span>${{ number_format($quotation->total * $quantity, 2) }}</span>
                </div>
            </div>
        </div>
    </div>

    <h3>Detalle del producto</h3>
    <table class="detail-table">
        <thead>
            <tr>
                <th style="width: 30%;">Descripción</th>
                <th style="width: 20%;">Medidas</th>
                <th style="width: 15%;">Precio unitario</th>
                <th style="width: 10%;">Cantidad</th>
                <th style="width: 25%;">Importe</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{ $quotation->name }}
                    <span class="description">{{ $description }}</span>
                </td>
                <td>{{ $long }} x {{ $width }} x {{ $height }} m</td>
                <td class="align-center">${{ number_format($quotation->total, 2) }}</td>
                <td class="align-center">{{ $quantity }}</td>
                <td class="align-center">${{ number_format($quotation->total * $quantity, 2) }}</td>
            </tr>
        </tbody>
    </table>

    

    <div class="signature-line">
        Atentamente,<br>
        <strong>{{ $user->name }}</strong>
        <p>Administrador — Carpinteria</p>
    </div>

</body>
</html>