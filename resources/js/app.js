//Imports não Mexer
import './bootstrap';
import $ from 'jquery';
window.$ = window.jQuery = $;

$(document).ready(function() {
    $("#toggle-btn").click(function() {
        $("#mensagem").toggle(); // Alterna entre mostrar e ocultar
    });
});
