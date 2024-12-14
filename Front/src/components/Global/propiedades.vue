<template>
  
  <div class="container mx-auto p-4">
    <FilterSearch />
    <!-- Título -->
    <h1 class="text-3xl font-extrabold text-center mb-6  mt-24">Propiedades Disponibles</h1>

    <!-- Lista de propiedades -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div
        v-for="property in propStore.propers"
        :key="property.id"
        class="card bg-base-100 shadow-xl hover:shadow-2xl transition duration-300"
      >
        <div class="card-body">
          <!-- Ícono y Título -->
          <h2 class="card-title flex items-center text-xl font-bold">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V10M9 3v1m6 3h6v13H9V6h6z" />
            </svg>
            {{ property.name }}
          </h2>

          <!-- Detalles -->
          <p><strong>Precio por noche:</strong> ${{ property.price_per_night }}</p>
          <p><strong>Disponible:</strong> {{ property.avaiable ? 'Sí' : 'No' }}</p>
          <p><strong>Ciudad:</strong> {{ property.city.name }}</p>
          <p><strong>País:</strong> {{ property.country.name }}</p>
            <p><strong>Tipo:</strong> 
            <span v-if="property.types_id === 1">Arnb</span>
            <span v-else-if="property.types_id === 2">Departamento</span>
            <span v-else-if="property.types_id === 3">Casa</span>
            </p>

          <!-- Botón -->
          <button
            class="btn btn-primary flex items-center justify-center gap-2"
            @click="openModal(property)"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V10M9 3v1m6 3h6v13H9V6h6z" />
            </svg>
            Reservar
          </button>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div v-if="isModalVisible" class="modal modal-open">
      <div class="modal-box">
        <h3 class="font-bold text-lg mb-4 text-center">Reserva para {{ selectedProperty?.name }}</h3>
        <p class="text-center">
          <strong>Precio por noche:</strong> ${{ selectedProperty?.price_per_night }} <br />
          <strong>Noches elegidas:</strong> {{ nochesElegidas }} <br />
          <strong>Total:</strong> <span class="text-lg font-bold text-primary">${{ total }}</span>
        </p>
  
        <!-- Fecha de Inicio -->
        <div class="form-control my-4">
          <label class="label">
            <span class="label-text font-semibold">Fecha de inicio:</span>
          </label>
          <input
            type="date"
            class="input input-bordered"
            v-model="startDate"
            @change="calcularTotal"
            placeholder="dd/mm/yyyy"
          />
        </div>
  
        <!-- Fecha de Fin -->
        <div class="form-control my-4">
          <label class="label">
            <span class="label-text font-semibold">Fecha de fin:</span>
          </label>
          <input
            type="date"
            class="input input-bordered"
            v-model="endDate"
            @change="calcularTotal"
            placeholder="dd/mm/yyyy"
          />
        </div>
  
        <!-- Modal Footer -->
        <div class="modal-action flex justify-center gap-4">
          <button
            class="btn btn-success flex items-center gap-2"
            @click="confirmReservation(selectedProperty.id)"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            Confirmar
          </button>
          <button
            class="btn btn-error flex items-center gap-2"
            @click="closeModal"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Cancelar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

  
  <script setup>
  import { ref } from 'vue';
  import { Propiedades } from '../../stores/Propiedades/propStore';
  import { Auth } from '../../stores/Auth/auth';
  import { sweetAlert } from '../../composables/sweetAlert';
  import { Reservation } from '../../stores/Reservations/reservationStore';
  import FilterSearch from './FilterSearch.vue';
  import { useLoading } from '~/composables/useLoader.js';  
  
  const propStore = Propiedades();
  const { openAnimation, closeAnimation } = useLoading();
  const authStore = Auth();
  const swal = sweetAlert();
  const reservationStore = Reservation();
  // Estado del modal y la propiedad seleccionada
  const selectedProperty = ref(null);
  const isModalVisible = ref(false);

  const startDate = ref('');
  const endDate = ref('');
  const nochesElegidas = ref(0);
  const total = ref(0);

  //funcion que calcula el total de la reserva cuando se cambia la fecha de inicio o fin
  const calcularTotal = () => {
    if (!startDate.value || !endDate.value) {
      return;
    }
    const start = new Date(startDate.value);
    const end = new Date(endDate.value);
    const diffTime = Math.abs(end - start);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    nochesElegidas.value = diffDays;
    total.value = diffDays * selectedProperty.value.price_per_night;
  };

  // Función para abrir el modal
  const openModal = (property) => {
    
    if(authStore.sesion == true){
        selectedProperty.value = property;
        isModalVisible.value = true;
    }else
    {
        swal.showAlert('error','normal',{title: 'Aviso', text: 'Debes Iniciar Sesion',confirmType: 'normal'})

    }
  };
  
  // Función para cerrar el modal
  const closeModal = () => {
    selectedProperty.value = null;
    isModalVisible.value = false;
  };
  
  // Función para confirmar la reserva
  const confirmReservation = async  (id) => {
    if (!startDate.value || !endDate.value) {
        swal.showAlert('error','right',{text: 'Debe ingresar la fecha de inicio y fin',confirmType: 'timer'})
        return;
    }
    openAnimation();
    const response = await reservationStore.makeReservation(startDate.value, endDate.value,authStore.user.id ,id, authStore.token);
    closeAnimation();  
    console.log(response);
    if(response.success == true){
        swal.showAlert('success','right',{text: 'Reserva realizada con éxito',confirmType: 'timer'})
        closeModal();
    }else{ 
        swal.showAlert('error','right',{text: response.message ,confirmType: 'timer'})
    }


    //closeModal();
  };
  </script>
  