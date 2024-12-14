<script setup>
import { RouterLink,RouterView, useRouter } from 'vue-router';
import { onMounted } from 'vue';
import Propiedades from '../components/Global/propiedades.vue';
const router = useRouter();
onMounted(() => {
    router.push('/');
});
</script>
<template>
    <div class="app" >
        <RouterView />

        <Propiedades />
    </div>
</template>

<style scoped>

</style>
