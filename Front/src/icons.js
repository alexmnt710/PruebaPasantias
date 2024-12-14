import { HomeIcon, UserIcon } from '@heroicons/vue/24/solid';
import { MagnifyingGlassIcon, BellIcon } from '@heroicons/vue/24/outline'; // Reemplaza SearchIcon

export default function registerIcons(app) {
  app.component('HomeIcon', HomeIcon); // Icono de casa
  app.component('UserIcon', UserIcon); // Icono de usuario
  app.component('MagnifyingGlassIcon', MagnifyingGlassIcon); // Icono de lupa
  app.component('BellIcon', BellIcon); // Icono de campana
}


