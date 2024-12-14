<template>
    <div class="container mx-auto p-4">
      <h2 class="text-2xl font-bold text-primary mb-4 text-center">Detalles de las Reservas</h2>
      <table class="table table-zebra w-full border">
        <thead>
          <tr>
            <th>ID</th>
            <th>ID Propiedad</th>
            <th>Usuario ID</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Fin</th>
            <th>Precio Total</th>
            <th>Email</th>
            <th>Ubicacion</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="reservation in reservationStore.userReservations" :key="reservation.id">
            <td>{{ reservation.id }}</td>
            <td>{{ reservation.property.name}}</td>
            <td>{{ reservation.user.name }}</td>
            <td>{{ reservation.start_date }}</td>
            <td>{{ reservation.end_date }}</td>
            <td>${{ reservation.total_price }}</td>
            <td>{{ reservation.user.email }}</td>
            <td>{{ reservation.property.country_id }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script setup>
  import { onMounted } from 'vue';
  import { Reservation } from '../stores/Reservations/reservationStore';
  import { Auth } from '../stores/Auth/auth';
  import { useLoading } from '~/composables/useLoader.js';
  
  const reservationStore = Reservation();
  const authStore = Auth();
  const { openAnimation, closeAnimation } = useLoading();
  
  onMounted(async () => {
    openAnimation();
    await authStore.checkSession(); // Verifica la sesión del usuario
    await reservationStore.getUserReservations(authStore.user.id, authStore.token); // Obtiene reservas
    console.log(reservationStore.userReservations); // Debugging
    closeAnimation();
  });
  </script>
  
  <style>
  .container {
    max-width: 800px;
  }
  .table {
    border-collapse: collapse;
  }
  th,
  td {
    padding: 8px;
    text-align: left;
    border: 1px solid #ddd;
  }
  </style>
  