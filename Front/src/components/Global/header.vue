<script setup>
import { ref } from 'vue';
import ThemeSelector from './selectorTheme.vue';
import { useLoading } from '~/composables/useLoader.js';  
import { Auth } from '../../stores/Auth/auth';
import { useRouter } from 'vue-router';
import { sweetAlert } from '../../composables/sweetAlert';


// Composables para animaciones
const { openAnimation, closeAnimation } = useLoading();
const authStore = Auth();
const router = useRouter();
const swal = sweetAlert();

// Variable reactiva para manejar el estado del menú
const isMenuOpen = ref(false);

// Función para alternar el menú
const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value; // Actualiza la propiedad reactiva
};

const logout = async () => {
  openAnimation();
  const response = await authStore.logout();
  if(response.success == true){
    swal.showAlert('success','right',{text: response.message,confirmType: 'timer'})
    router.push('/');
  }
  closeAnimation();
};
const reservaciones = () => {
  router.push('/myReservation');
};
</script>

<template>
  <header class="bg-base-100 text-base-content p-4 shadow-inner">
    <div class="container mx-auto flex flex-wrap justify-between items-center gap-4">
      <!-- Título -->
      <h1 class="text-primary text-2xl font-bold flex-shrink-0">
        <router-link to="/">Sistema de Propiedades</router-link>
      </h1>

      <!-- Botón de menú (visible en pantallas pequeñas) -->
      <button
        class="btn btn-ghost lg:hidden"
        @click="toggleMenu"
        aria-label="Abrir menú"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h16m-7 6h7"
          />
        </svg>
      </button>

      <!-- Menú principal -->
      <div
        :class="[ 
          'w-full lg:flex lg:w-auto lg:items-center',
          isMenuOpen ? 'block' : 'hidden',
        ]"
        class="mt-4 lg:mt-0"
      >
        <div class="flex flex-col lg:flex-row items-center gap-4">
                    <!-- Botones de Iniciar Sesión y Registrarse -->
          <div v-if="!authStore.sesion" class="flex gap-2">
              <router-link to="/login" class="btn btn-primary btn-outline">
                Iniciar Sesión
              </router-link>
              <router-link to="/register" class="btn btn-accent btn-outline">
                Registrarse
              </router-link>
          </div>
          <div v-else class="flex gap-2">
            <button class="btn btn-accent btn-outline" @click="logout">
                Cerrar Sesión
            </button>
            <button class="btn btn-primary btn-outline" @click="reservaciones">
              Mis reservaciones
          </button>
          </div>
          <!-- Selector de Tema -->
          <ThemeSelector />

        </div>
      </div>
    </div>
  </header>
</template>
