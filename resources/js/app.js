import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
/* admin dashbord js*/
/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    //
// Scripts
//
window.addEventListener('DOMContentLoaded', event => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    const toggleCheckbox = document.getElementById('notification-toggle-checkbox');
    const notificationForm = document.getElementById('notification-form');

    if (toggleCheckbox && notificationForm) {
        toggleCheckbox.addEventListener('change', function() {
            notificationForm.submit();
        });
    }

    const whatsappToggleCheckbox = document.getElementById('whatsapp-notification-toggle-checkbox');
    const whatsappNotificationForm = document.getElementById('whatsapp-notification-form');

    if (whatsappToggleCheckbox && whatsappNotificationForm) {
        whatsappToggleCheckbox.addEventListener('change', function() {
            whatsappNotificationForm.submit();
        });
    }
});
window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});
