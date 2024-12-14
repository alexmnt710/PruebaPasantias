<template>
    <div class="max-w-sm mx-auto p-6 bg-base-100 shadow-xl rounded-lg mt-10">
      <h2 class="text-2xl font-bold text-secondary mb-4">Registrarse</h2>
      <form @submit.prevent="register">
        <div class="form-control mb-4">
          <label class="label">
            <span class="label-text">Nombre Completo</span>
          </label>
          <input
            type="text"
            placeholder="Juan Pérez"
            class="input input-bordered w-full"
            v-model="name"
            required
          />
        </div>
        <div class="form-control mb-4">
          <label class="label">
            <span class="label-text">Correo Electrónico</span>
          </label>
          <input
            type="email"
            placeholder="tuemail@ejemplo.com"
            class="input input-bordered w-full"
            v-model="email"
            required
          />
        </div>
        <div class="form-control mb-4">
          <label class="label">
            <span class="label-text">Contraseña</span>
          </label>
          <input
            type="password"
            placeholder="********"
            class="input input-bordered w-full"
            v-model="password"
            required
          />
        </div>
        <div class="form-control mb-4">
          <label class="label">
            <span class="label-text">Confirmar Contraseña</span>
          </label>
          <input
            type="password"
            placeholder="********"
            class="input input-bordered w-full"
            v-model="confirmPassword"
            required
          />
        </div>
        <button class="btn btn-secondary w-full">Registrarse</button>
      </form>
      <p class="mt-4 text-sm">
        ¿Ya tienes una cuenta? <router-link to="/login" class="text-secondary">Inicia Sesión</router-link>
      </p>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { Auth } from '../stores/Auth/auth';
  import { useLoading } from '~/composables/useLoader.js';  
  import { sweetAlert } from '../composables/sweetAlert';

  const { openAnimation, closeAnimation } = useLoading();
  const swal = sweetAlert();
  const authStore = Auth();

  const name = ref('');
  const email = ref('');
  const password = ref('');
  const confirmPassword = ref('');
  
  const register = async  () => {
    if (password.value !== confirmPassword.value) {
      swal.showAlert('error','right',{text: 'Las contraseñas no coinciden' ,confirmType: 'timer'})
      return;
    }
    openAnimation();
     const response = await authStore.register({ name: name.value, email: email.value, password: password.value })
    closeAnimation();
    if (response.success == true) {
      swal.showAlert('success','right',{text: response.message ,confirmType: 'timer'})
    } else {
      swal.showAlert('error','right',{text: response.message ,confirmType: 'timer'})
    }

      
    
  };
  </script>
  