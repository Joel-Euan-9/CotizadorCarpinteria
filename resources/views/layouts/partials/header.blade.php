<header class="header" id="header">
    <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    @auth
        <div class="header_username ms-auto me-3">
            <span class="text-dark fw-bold">{{ Auth::user()->name }}</span>
        </div>

    @endauth
    <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
</header>