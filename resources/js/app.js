import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();
let sun = document.getElementById("sun");
let moon = document.getElementById("moon");
let html = document.querySelector("html");
window.onload = theme;
sun.onclick = function () {
    localStorage.removeItem("theme", "dark");
    html.classList.remove("dark");
    console.log(localStorage.getItem("theme"));
}
moon.onclick = function () {
    localStorage.setItem("theme", "dark");
    html.classList.add(localStorage.getItem("theme"));
    console.log(localStorage.getItem("theme"));
    
}
function theme() {
    html.classList.add(localStorage.getItem("theme"));
}