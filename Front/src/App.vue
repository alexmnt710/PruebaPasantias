<script setup>
import { onMounted } from 'vue';
import { ref } from 'vue';
import Footer from './components/Global/footer.vue';
import Header from './components/Global/header.vue';
import { Auth } from './stores/Auth/auth';
import loadPage from './components/Global/loadPage.vue';
import loadScreen from './components/Global/loadScreen.vue';
import { User } from './stores/User/userStore';
import { Propiedades } from './stores/Propiedades/propStore';


const authStore = Auth();
const userStore = User();
const propStore = Propiedades();
const isLoading = ref(true);

onMounted(async () => {
  await authStore.prueba();
  await userStore.getUsers();
  await authStore.checkSession();
  await propStore.getPropiedes();
  console.log('Usuarios', authStore.sesion);
  isLoading.value = false;
});
</script>

<template>
  <!-- App Wrapper -->
  <div id="app" class="min-h-screen flex flex-col bg-base-200 text-base-content">
    <!-- Header -->
    <Header />

    <!-- Main Content -->
    <main class="flex-grow p-4 sm:p-6 md:p-8">
      <div class="container mx-auto">
        <!-- Router View -->
        <router-view />
        
        <!-- Loading Page -->
        <div v-if="isLoading" class="fixed inset-0 flex items-center justify-center bg-base-100 z-50">
          <loadPage />
        </div>
        
        <!-- Loading Screen -->
        <loadScreen />
      </div>
    </main>

    <!-- Footer -->
    <Footer />
  </div>
</template>
