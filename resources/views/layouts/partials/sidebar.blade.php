<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div> 
            <a href="{{ route('inicio') }}" class="nav_logo" wire:navigate> 
                <img src="{{ asset('images/logoblanco.png') }}" alt="Logo Carpenter Studio" class="nav_logo-icon" width="25px"> 
                <span class="nav_logo-name">Carpenter Studio</span> 
            </a>

            <div class="nav_list"> 
                
                <a href="{{ route('cotizador.show') }}" class="nav_link {{ request()->routeIs('cotizador.show') ? 'active' : '' }}" wire:navigate>
                    <i class='bx bx-calculator nav_icon'></i> 
                    <span class="nav_name">Cotizador</span> 
                </a>

                <a href="{{ route('cotizaciones.list') }}" class="nav_link {{ request()->routeIs('cotizaciones.list') ? 'active' : '' }}" wire:navigate>
                    <i class='bx bx-list-ul nav_icon'></i> 
                    <span class="nav_name">Cotizaciones</span> 
                </a>
                
                <a href="{{ route('usuarios.users') }}" class="nav_link {{ request()->routeIs('usuarios.users') ? 'active' : '' }}" wire:navigate> 
                    <i class='bx bx-user nav_icon'></i> 
                    <span class="nav_name">Users</span> 
                </a>
                <a href="#" class="nav_link" wire:navigate> <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Messages</span> </a>
                <a href="#" class="nav_link" wire:navigate> <i class='bx bx-store-alt nav_icon'></i>  <span class="nav_name">Inventario</span> </a>
                <a href="#" class="nav_link" wire:navigate> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Files</span> </a>
                <a href="#" class="nav_link" wire:navigate> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Stats</span> </a>
            </div>
        </div> 

        <a href="{{ route('logout') }}" class="nav_link" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
            <i class='bx bx-log-out nav_icon'></i> 
            <span class="nav_name">SignOut</span> 
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
            @csrf
        </form>
    </nav>
</div>