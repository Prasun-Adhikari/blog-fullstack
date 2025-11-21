<script setup>
import { ref, watch, onMounted } from 'vue';
import { useRouter } from 'vue-router';

import api from './utils/axios';

const router = useRouter();
const curPath = ref('/');

const storedPath = localStorage.getItem('curPath')
if (storedPath) {
  curPath.value = storedPath
  router.push(storedPath)
}

watch(curPath, newPath => {
  localStorage.setItem('curPath', newPath)
})

const links = ref({
  '/': 'Home',
  '/follows': 'Followed',
  '/create': 'Create',
  '/signup': 'Signup',
  '/login': 'Login',
  '/dash': 'Dashboard',
})

onMounted(
 () => api.get('sanctum/csrf-cookie')
)

</script>

<template>
  <div class="flex">
    <nav class="w-64 bg-gray-800 text-white min-h-screen p-4 flex flex-col text-xl">

      <RouterLink v-for="(displayName, link) in links" 
        :to=link :class="{'bg-gray-700': curPath==link}" @click="curPath=link"
        class="block py-2 px-4 rounded hover:bg-gray-700 transition duration-200">
          {{displayName}}
      </RouterLink>

    </nav>
    <main class="flex-1 p-8 bg-gray-100">
      <RouterView></RouterView>
    </main>
  </div>
</template>
