<div class="container-fluid p-4">
    <style>
        .design-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .design-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .carousel-item img {
            height: 250px;
            object-fit: cover;
            border-bottom: 1px solid #eee;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .card-text {
            color: #6c757d;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .specs-badge {
            background-color: #f8f9fa;
            color: #495057;
            border: 1px solid #e9ecef;
            padding: 0.4em 0.8em;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-right: 5px;
            margin-bottom: 5px;
            display: inline-block;
        }

        .section-title {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #adb5bd;
            font-weight: 600;
            margin-top: 1rem;
            margin-bottom: 0.5rem;
        }

        .materials-list {
            list-style: none;
            padding-left: 0;
            font-size: 0.9rem;
        }

        .materials-list li {
            margin-bottom: 0.3rem;
            padding-left: 1.2rem;
            position: relative;
            color: #555;
        }

        .materials-list li::before {
            content: "•";
            color: #e67e22;
            /* Accent color */
            font-weight: bold;
            position: absolute;
            left: 0;
        }

        .page-header {
            margin-bottom: 2rem;
            text-align: center;
        }

        .page-header h2 {
            font-weight: 800;
            color: #343a40;
        }

        .page-header p {
            color: #868e96;
            max-width: 600px;
            margin: 0 auto;
        }
    </style>

    <div class="page-header">
        <h2>Catálogo de Diseños</h2>
        <p>Explora nuestra colección de prototipos y encuentra la inspiración para tu próximo proyecto.</p>
    </div>

    <div class="row g-4">
        @foreach($designs as $design)
        <div class="col-md-6 col-lg-4">
            <div class="card design-card h-100">
                <!-- Carousel -->
                <div id="carousel-{{ $design['id'] }}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($design['images'] as $index => $image)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ $image }}" class="d-block w-100" alt="{{ $design['name'] }}">
                        </div>
                        @endforeach
                    </div>
                    @if(count($design['images']) > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $design['id'] }}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $design['id'] }}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                    @endif
                </div>

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $design['name'] }}</h5>
                    <p class="card-text">{{ $design['description'] }}</p>

                    <div class="mt-auto">
                        <div class="section-title">Dimensiones</div>
                        <div>
                            @foreach($design['dimensions'] as $key => $value)
                            <span class="specs-badge">
                                <strong>{{ $key }}:</strong> {{ $value }}
                            </span>
                            @endforeach
                        </div>

                        <div class="section-title">Materiales Sugeridos</div>
                        <ul class="materials-list">
                            @foreach($design['materials'] as $material)
                            <li>{{ $material }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>