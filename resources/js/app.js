import './bootstrap';
import * as bootstrap from 'bootstrap'; // Aktywuje komponenty Bootstrap (np. dropdowny)
import '../css/app.scss'; // Ładuje style
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
