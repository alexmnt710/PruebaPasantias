<script setup>
import { ref } from 'vue';
import { Auth } from '../stores/Auth/auth';
import {sweetAlert} from '../composables/sweetAlert';
import { useLoading } from '~/composables/useLoader.js';
import { useRouter } from 'vue-router'; 

const { openAnimation, closeAnimation } = useLoading();
const swal = sweetAlert();

const authStore = Auth();
const email = ref('');
const password = ref('');
const rememberMe = ref(false);
const router = useRouter();

const login = async () => {
  openAnimation();
    const response = await authStore.login(email.value, password.value);
    console.log(response);
    if(response.success == true){
        swal.showAlert('success','right',{text: response.message,confirmType: 'timer'})
        router.push('/');
    }else{
        swal.showAlert('error','normal',{title: 'Error', text: 'Credenciales Inválidas',confirmType: 'normal'})
    }
  closeAnimation();
};
</script>
<template>
    <div class="max-w-sm mx-auto p-6 bg-base-100 shadow-xl rounded-lg mt-24">
      <h2 class="text-2xl font-bold text-primary mb-4">Iniciar Sesión</h2>
      <form @submit.prevent="login">
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
          <label class="label cursor-pointer">
            <input
              type="checkbox"
              class="checkbox checkbox-primary"
              v-model="rememberMe"
            />
            <span class="label-text ml-2">Recuérdame</span>
          </label>
        </div>
        <button class="btn btn-primary w-full">Iniciar Sesión</button>
      </form>
      <p class="mt-4 text-sm">
        ¿No tienes una cuenta? <router-link to="/register" class="text-primary">Regístrate</router-link>
      </p>
    </div>
  </template>
  

  