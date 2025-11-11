@extends('layouts.sidebar')

@section('content')

<div class="container mt-4">

    <div class="row justify-content-center">
        <div class="col-lg- col-md-10 col-12">

            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/carrusel0.png') }}" class="d-block w-100" alt="Bienvenida">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Bienvenido a Carpenter Studio</h5>
                            <p>La herramienta definitiva para la gestión de tu carpintería.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/carrusel1.png') }}" class="d-block w-100" alt="Cotizaciones">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="text-dark">Precisión en cada cotización</h5>
                            <p class="text-dark">Crea cotizaciones detalladas en minutos, no en horas.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/carrusel2.png') }}" class="d-block w-100" alt="Inventario">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="text-dark">Control total de tu inventario</h5>
                            <p class="text-dark">Nunca te quedes sin material con nuestra gestión de stock.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>

        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-lg-8 col-md-10 col-12">
            <h2 class="mb-3">Novedades</h2>
            <div class="alert alert-light" role="alert">
                <h4 class="alert-heading">¡Lanzamiento Oficial!</h4>
                <p>🎉 Te damos la bienvenida a <strong>Carpenter Studio Versión 1.0.0</strong>. Esta es la primera versión estable de la plataforma, diseñada para ayudarte a optimizar tu negocio de carpintería.</p>
                <hr>
                <p class="mb-0">Explora los módulos y no dudes en contactar a soporte si tienes dudas.</p>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-lg-10 col-12">
            <h2 class="text-center mb-4">Módulos del Programa</h2>
            
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

                <div class="col">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class='bx bx-calculator nav_icon bx-lg'></i>
                            <h5 class="card-title mt-2">Cotizador</h5>
                            <p class="card-text">El corazón del sistema. Crea cotizaciones detalladas seleccionando materiales y mano de obra.</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class='bx bx-list-ul nav_icon bx-lg'></i> 
                            <h5 class="card-title mt-2">Lista de Cotizaciones</h5>
                            <p class="card-text">Revisa el historial de todas las cotizaciones generadas, filtra por cliente o estado.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class='bx bx-store-alt bx-lg'></i> 
                            <h5 class="card-title mt-2">Inventario</h5>
                            <p class="card-text">Controla tu stock de madera, herrajes y otros materiales.</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class='bx bx-note nav_icon bx-lg'></i>
                            <h5 class="card-title mt-2">Mis Notas</h5>
                            <p class="card-text">Guarda ideas, notas rápidas, tareas pendientes e información importante.</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mt-2">

                <div class="col">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class='bx bx-message nav_icon bx-lg'></i>
                            <h5 class="card-title mt-2">Chat</h5>
                            <p class="card-text">Un espacio para colaborar, resolver dudas y dar avisos generales a todo el equipo.</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class='bx bx-layout nav_icon bx-lg'></i> 
                            <h5 class="card-title mt-2">Diseños</h5>
                            <p class="card-text">Inspírate con un catálogo de muestra. Revisa ejemplos de productos, sus medidas y materiales.</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class='bx bx-user nav_icon bx-lg'></i>
                            <h5 class="card-title mt-2">Mi Cuenta</h5>
                            <p class="card-text">Administra tu información personal y contraseña.</p>
                        </div>
                    </div>
                </div>

                

            </div>
        </div>
        
    </div>


    <div class="row justify-content-center mt-5">
        <div class="col-lg-8 col-md-10 col-12">
            <h2 class="text-center mb-4">Preguntas Frecuentes (FAQ)</h2>

            <div class="accordion" id="accordionFAQ">
                
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            ¿Cómo creo una nueva cotización?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionFAQ">
                        <div class="accordion-body">
                            Dirígete al módulo <strong>"Cotizador"</strong> en el menú lateral. Primero, selecciona un cliente existente o registra uno nuevo. Luego, comienza a agregar los productos o servicios, especificando materiales, dimensiones y acabados. El sistema calculará el total automáticamente.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            ¿Puedo editar una cotización ya guardada?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFAQ">
                        <div class="accordion-body">
                            Sí. Ve a la <strong>"Lista de Cotizaciones"</strong>, busca la cotización que deseas modificar y haz clic en el botón de "Editar". Podrás ajustar los precios, materiales o cualquier detalle.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            El módulo de Inventario no funciona, ¿por qué?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionFAQ">
                        <div class="accordion-body">
                            El módulo de <strong>Inventario</strong> es una funcionalidad que está planeada para la versión 2.0. Actualmente estamos enfocados en perfeccionar el sistema de cotizaciones. ¡Gracias por tu paciencia!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-5 mb-5"> <div class="col-lg-8 col-md-10 col-12">
            <h2 class="text-center mb-4">Soporte Técnico</h2>
            <div class="card shadow-sm">
                <div class="card-body">
                    <p class="card-text">Si encuentras algún error (bug), tienes alguna sugerencia para mejorar la aplicación o necesitas ayuda, no dudes en contactarme.</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Desarrollador:</strong> Joel Euan</li>
                        <li class="list-group-item"><strong>Email:</strong> soporte@carpenterstudio.com</li>
                        <li class="list-group-item"><strong>Horario:</strong> Lunes a Viernes, 9:00 AM - 6:00 PM</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div> @endsection