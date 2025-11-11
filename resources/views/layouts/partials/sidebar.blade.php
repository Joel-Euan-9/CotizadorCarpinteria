<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div> 
            <a href="{{ route('inicio') }}" class="nav_logo" wire:navigate> 
                <img src="{{ asset('images/logoblanco.png') }}" alt="Logo Carpenter Studio" class="nav_logo-icon" width="25px"> 
                <span class="nav_logo-name">Carpenter Studio</span> 
            </a>

            <div class="nav_list"> 
                
                <a href="{{ route('cotizador') }}" class="nav_link {{ request()->routeIs('cotizador') ? 'active' : '' }}" wire:navigate>
                    <i class='bx bx-calculator nav_icon'></i> 
                    <span class="nav_name">Cotizador</span> 
                </a>

                <a href="{{route('quotations.list') }}" class="nav_link {{ request()->routeIs('quotations.list') ? 'active' : '' }}" wire:navigate>
                    <i class='bx bx-list-ul nav_icon'></i> 
                    <span class="nav_name">Cotizaciones</span> 
                </a>
                <a href="{{ route('inventario.invents') }}" class="nav_link {{ request()->routeIs('inventario.invents') ? 'active' : '' }}" wire:navigate> 
                    <i class='bx bx-store-alt nav_icon'></i>  
                    <span class="nav_name">Inventario</span> 
                </a>
                <a href="{{ route('notes.index') }}" class="nav_link {{ request()->routeIs('notes.index') ? 'active' : '' }}" wire:navigate> <i class='bx bx-note nav_icon'></i> <span class="nav_name">Mis Notas</span> </a>
                <a href="#" class="nav_link" wire:navigate> <i class='bx bx-message nav_icon'></i> <span class="nav_name">Chat</span> </a>
                <a href="#" class="nav_link" wire:navigate> <i class='bx bx-layout nav_icon'></i> <span class="nav_name">Diseños</span> </a>
                <a href="{{ route('Mi-Cuenta') }}" class="nav_link {{ request()->routeIs('Mi-Cuenta') ? 'active' : '' }}" wire:navigate> 
                    <i class='bx bx-user nav_icon'></i> 
                    <span class="nav_name">Mi Cuenta</span> 
                </a>
            </div>
        </div> 

        <a href="{{ route('logout') }}" class="nav_link" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
            <i class='bx bx-log-out nav_icon'></i> 
            <span class="nav_name">SignOut</span> 
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
            
        </form>
    </nav>
</div>