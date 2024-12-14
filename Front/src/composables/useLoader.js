// src/composables/useLoader.js
import { ref } from 'vue';

// Estado global compartido
const isAnimating = ref(false);

// Funciones para controlar el estado
export function useLoading() {
  const openAnimation = () => {
    isAnimating.value = true;
    console.log(isAnimating.value); // Confirmar que cambia a `true`
  };

  const closeAnimation = () => {
    isAnimating.value = false;
    console.log(isAnimating.value); // Confirmar que cambia a `false`
  };

  return {
    isAnimating,
    openAnimation,
    closeAnimation,
  };
}
