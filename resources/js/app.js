import './bootstrap';
import $ from 'jquery';

window.$ = $;
window.jQuery = $;

console.log('✅ App.js loaded successfully');

// Import custom scripts AFTER jQuery
import './pages/announcement/locationData';
import './pages/announcement/additionalInfoData';
import './pages/announcement/generalInfoData';

