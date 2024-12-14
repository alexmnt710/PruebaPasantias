<template>
  <div
    v-if="isAnimating"
    class="fixed inset-0 flex items-center justify-center bg-base-200 bg-opacity-80 z-[9999]"
  >
    <div class="p-4 bg-base-100 rounded-lg shadow-lg w-24 h-24 flex items-center justify-center">
      <div class="spinner w-10 h-10 border-4 border-primary border-t-transparent rounded-full animate-spin"></div>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useLoading } from '~/composables/useLoader';

const { isAnimating } = useLoading(); // Conexión al estado compartido

onMounted(() => {
  console.log('Cargando...');
  console.log(isAnimating.value); // Esto imprime correctamente el valor inicial
});
</script>

<style scoped>
.spinner {
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
