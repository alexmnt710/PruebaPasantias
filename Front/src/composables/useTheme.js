import { ref, onMounted } from 'vue';
import {
  SunIcon,       // Representa claridad (light)
  MoonIcon,      // Oscuridad o noche (dracula)
  SparklesIcon,  // Representa algo brillante o pastel (retro)
  CakeIcon,      // Limonada o refresco para "lemonade"
  BoltIcon,      // Energía y tecnología (cyberpunk)
  HeartIcon,     // Representa romance (valentine)
} from '@heroicons/vue/24/solid';

export function useTheme() {
  const themes = [
    { name: 'light', label: 'Claro', icon: SunIcon },        // Claro
    { name: 'dracula', label: 'Oscuro', icon: MoonIcon },   // Oscuro
    { name: 'retro', label: 'Pastel', icon: CakeIcon }, // Retro
    { name: 'lemonade', label: 'Lemon', icon: SparklesIcon },   // Limonada
    { name: 'cyberpunk', label: 'Canario', icon: BoltIcon },// Cibernético
    { name: 'valentine', label: 'Romantico', icon: HeartIcon }, // Amoroso
  ];

  // Tema seleccionado (por defecto: "light")
  const selectedTheme = ref(localStorage.getItem('theme') || 'light');

  // Cambiar a un tema específico
  const setTheme = (themeName) => {
    selectedTheme.value = themeName;
    document.documentElement.setAttribute('data-theme', themeName); // Cambia el tema globalmente
    localStorage.setItem('theme', themeName); // Guarda el tema en localStorage
  };

  // Configura el tema inicial al cargar la página
  onMounted(() => {
    setTheme(selectedTheme.value); // Configura el tema al inicio
  });

  return {
    themes,
    selectedTheme,
    setTheme,
  };
}

