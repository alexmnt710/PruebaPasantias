<template>
    <div class="flex flex-col items-center justify-center max-w-lg mx-auto my-20 bg-base-100 dark:bg-base-200 p-6 rounded-lg">
      <!-- Círculo con ícono -->
      <div
        class="flex items-center justify-center w-24 h-24 sm:w-32 sm:h-32 bg-error dark:bg-red-600 rounded-full shadow-lg hover:scale-105 transition-transform duration-300 ease-in-out">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 drop-shadow-lg" viewBox="0 0 24 24">
          <!-- Triángulo blanco -->
          <path
            fill="white"
            fill-rule="evenodd"
            d="M12 2c.33 0 .65.17.82.46l10 16.5A1 1 0 0 1 22 20H2a1 1 0 0 1-.82-1.54l10-16.5A1 1 0 0 1 12 2z"
            clip-rule="evenodd"
          />
          <!-- Bolita -->
          <circle cx="12" cy="17" r="1.2" class="fill-primary" />
          <!-- Palito -->
          <rect x="11.3" y="9" width="1.4" height="5" rx="0.7" class="fill-primary" />
        </svg>
      </div>
  
      <!-- Título principal -->
      <h1 class="text-2xl sm:text-3xl font-bold text-error dark:text-red-400 mt-4 text-center">
        Oops! Página no encontrada
      </h1>
  
      <!-- Mensaje secundario -->
      <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 mt-2 text-center">
        Parece que algo salió mal. Tal vez quieras regresar al inicio.
      </p>
  
      <!-- Botón -->
      <router-link
        to="/"
        class="btn btn-primary mt-4 px-6 py-2 rounded-full text-white text-sm sm:text-base font-medium shadow-lg hover:shadow-xl transition duration-300">
        Volver al Inicio
      </router-link>
    </div>
  </template>
<style>
  /* Animación de rebote */
  @keyframes bounce {
    0%, 100% {
      transform: translateY(0);
    }
    50% {
      transform: translateY(-10px);
    }
  }
  
  .animate-bounce {
    animation: bounce 2s infinite;
  }
</style>
  