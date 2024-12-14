<template>
    <div class="flex space-x-2 justify-center items-center">
      <!-- Puntos animados -->
      <div
        class="dot w-3 h-3 bg-primary rounded-full"
        style="animation-delay: 0s"
      ></div>
      <div
        class="dot w-3 h-3 bg-primary rounded-full"
        style="animation-delay: 0.15s"
      ></div>
      <div
        class="dot w-3 h-3 bg-primary rounded-full"
        style="animation-delay: 0.3s"
      ></div>
    </div>
  </template>
  
  <style scoped>
  .dot {
    /* Animación de rebote sutil */
    animation: subtleBounce 0.4s ease-in-out infinite;
  }
  
  @keyframes subtleBounce {
    0%,
    100% {
      transform: translateY(0);
      opacity: 1;
    }
    50% {
      transform: translateY(-6px);
      opacity: 0.8;
    }
  }
  </style>
  