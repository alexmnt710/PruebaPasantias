<template>
  <div class="relative theme-selector">
    <!-- Ícono del tema seleccionado -->
    <button
      class="flex justify-center items-center p-0 sm:p-2 rounded-full transition-all duration-300 sm:w-10 sm:h-10 w-8 h-8"
      :class="{
        'bg-primary text-base-100': hover || showSelector,
        'bg-base-100 text-primary': !(hover || showSelector),
      }"
      @mouseenter="hover = true"
      @mouseleave="hover = false"
      @click="showSelector = !showSelector"
      title="Cambiar tema"
      aria-expanded="showSelector"
    >
      <component
        :is="themes.find(t => t.name === selectedTheme)?.icon"
        class="sm:w-6 sm:h-6 w-5 h-5"
      />
    </button>

    <!-- Menú desplegable -->
    <transition name="fade">
      <div
        v-if="showSelector"
        class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 bg-base-200 text-base-content shadow-lg rounded-lg p-2 sm:p-3 w-40 sm:w-48 z-50"
      >
        <ul>
          <li
            v-for="theme in themes"
            :key="theme.name"
            @click="selectTheme(theme.name)"
            class="flex items-center gap-2 p-2 sm:p-3 rounded-md cursor-pointer hover:bg-primary hover:text-primary-content transition-colors duration-200"
          >
            <component
              :is="theme.icon"
              class="w-4 h-4 sm:w-5 sm:h-5"
            />
            <span class="font-medium text-sm sm:text-base">{{ theme.label }}</span>
          </li>
        </ul>
      </div>
    </transition>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { useTheme } from '../../composables/useTheme';

const { themes, selectedTheme, setTheme } = useTheme();
const showSelector = ref(false);
const hover = ref(false);

const handleClickOutside = (event) => {
  if (!event.target.closest('.theme-selector')) {
    showSelector.value = false;
  }
};

onMounted(() => {
  document.addEventListener('click', handleClickOutside);
});

onBeforeUnmount(() => {
  document.removeEventListener('click', handleClickOutside);
});

const selectTheme = (themeName) => {
  setTheme(themeName);
  showSelector.value = false;
};
</script>

<style scoped>
/* Animación para el menú desplegable */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
