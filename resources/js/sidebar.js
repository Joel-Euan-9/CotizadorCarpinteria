function showNavbar(toggleId, navId, bodyId, headerId) {
    const toggle = document.getElementById(toggleId),
          nav = document.getElementById(navId),
          bodypd = document.getElementById(bodyId),
          headerpd = document.getElementById(headerId);

    if (toggle && nav && bodypd && headerpd) {

        // Restaurar estado
        if (localStorage.getItem('sidebarState') === 'open') {
            nav.classList.add('show');
            toggle.classList.add('bx-x');
            bodypd.classList.add('body-pd');
            headerpd.classList.add('body-pd');
        }

        // Toggle
        toggle.addEventListener('click', () => {
            nav.classList.toggle('show');
            toggle.classList.toggle('bx-x');
            bodypd.classList.toggle('body-pd');
            headerpd.classList.toggle('body-pd');

            if (nav.classList.contains('show')) {
                localStorage.setItem('sidebarState', 'open');
            } else {
                localStorage.setItem('sidebarState', 'closed');
            }
        });
    }
}

document.addEventListener('livewire:load', () => {
    showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header');
});

document.addEventListener('livewire:navigated', () => {
    showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header');
});
