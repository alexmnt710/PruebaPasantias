<template>
  <div class="container mx-auto p-6 bg-base-100 shadow-md rounded-lg">
    <!-- Título -->
    <h2 class="text-xl font-bold text-primary mb-6 text-center">Buscar Propiedades</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
      <!-- Buscar por nombre -->
      <div class="form-control">
        <label class="label text-sm font-semibold text-gray-600">Nombre</label>
        <input
          type="text"
          v-model="filters.name"
          class="input input-bordered input-sm"
          placeholder="Buscar por nombre"
        />
      </div>

      <!-- Filtro por país -->
      <div class="form-control">
        <label class="label text-sm font-semibold text-gray-600">País</label>
        <select v-model="filters.country_id" class="select select-bordered select-sm">
          <option value="">Todos</option>
          <option
            v-for="country in countries"
            :key="country.id"
            :value="country.id"
          >
            {{ country.name }}
          </option>
        </select>
      </div>

      <!-- Filtro por tipo -->
      <div class="form-control">
        <label class="label text-sm font-semibold text-gray-600">Tipo de Propiedad</label>
        <select v-model="filters.types_id" class="select select-bordered select-sm">
          <option value="">Todos</option>
          <option
            v-for="type in propertyTypes"
            :key="type.id"
            :value="type.id"
          >
            {{ type.name }}
          </option>
        </select>
      </div>

      <!-- Rango de precios -->
      <div class="form-control md:col-span-2 lg:col-span-2">
        <label class="label text-sm font-semibold text-gray-600">Rango de Precio</label>
        <div class="flex gap-2">
          <input
            type="number"
            v-model.number="filters.price_min"
            class="input input-bordered input-sm w-full"
            placeholder="Mínimo"
          />
          <input
            type="number"
            v-model.number="filters.price_max"
            class="input input-bordered input-sm w-full"
            placeholder="Máximo"
          />
        </div>
      </div>

      <!-- Botón de búsqueda -->
      <div class="form-control md:col-span-2 lg:col-span-1 text-right">
        <button
          class="btn btn-primary btn-sm flex items-center justify-center gap-2"
          @click="applyFilters"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="currentColor"
            class="w-4 h-4"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M21 21l-4.35-4.35m2.85-6.15a7 7 0 11-14 0 7 7 0 0114 0z"
            />
          </svg>
          Buscar
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { Propiedades } from '../../stores/Propiedades/propStore';
import { sweetAlert } from '../../composables/sweetAlert';
import { useLoading } from '~/composables/useLoader.js';  

const { openAnimation, closeAnimation } = useLoading();
// Tienda de propiedades
const propStore = Propiedades();
const swal = sweetAlert();

// Filtros iniciales
const filters = ref({
  name: '',
  country_id: '',
  types_id: '',
  price_min: '',
  price_max: '',
});

// Cargar propiedades al montar el componente
onMounted(() => {
  propStore.filters = [];
});

// Opciones de países y tipos de propiedad
const countries = ref([
  { id: 1, name: 'México' },
  { id: 2, name: 'Estados Unidos' },
  { id: 3, name: 'Canadá' },
]);

const propertyTypes = ref([
  { id: 1, name: 'Airbnb' },
  { id: 2, name: 'Departamento' },
  { id: 3, name: 'Casa' },
]);

// Función para aplicar los filtros
const applyFilters = async () => {
  openAnimation();
  const response = await propStore.applyFilters(filters.value);
  closeAnimation();
  if (response === false) {
    swal.showAlert('error', 'right', {
      text: 'No se encontró ninguna propiedad con esos atributos.',
      confirmType: 'timer',
    });
  }
};
</script>
