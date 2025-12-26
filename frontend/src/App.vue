<script setup>
import { ref, watch, onMounted, computed } from 'vue';
import { useRouter } from 'vue-router';
import { HomeIcon, PlusIcon, Bars3Icon, UserCircleIcon, BookmarkIcon, ArrowRightStartOnRectangleIcon } from '@heroicons/vue/24/outline'

import api from './utils/axios';
import { useAuthStore } from './stores/auth';

const authStore = useAuthStore();
const router = useRouter();
const curPath = ref('/');

const storedPath = localStorage.getItem('curPath')
if (storedPath) {
  curPath.value = storedPath
  router.push(storedPath)
}

const sidebar = ref(false)

watch(curPath, newPath => {
  localStorage.setItem('curPath', newPath)
})

const links = ref({
  '/': 'Home',
  '/follows': 'Followed',
  '/create': 'Create',
})

const icons = {
  'Home': HomeIcon,
  'Followed': BookmarkIcon,
  'Create': PlusIcon,
  'Expand': Bars3Icon,
  'Profile': UserCircleIcon,
  'Logout': ArrowRightStartOnRectangleIcon,
}

const userLinks = computed(() =>
  !authStore.isAuthenticated
    ? { '/signup': 'Register', '/login': 'Login' }
    : { '/logout': 'Logout', '/dash': 'Profile' }
)

onMounted(
 () => api.get('sanctum/csrf-cookie')
)

</script>

<template>
    <header class="w-full border-gray-200 sticky top-0">
    <!-- Top Bar (Utility Bar) -->
    <nav class="nav1 h-15 p-2">
      <div class="container mx-auto px-4 flex justify-between items-center">
        <div class="flex space-x-4">
          <RouterLink to='/' class="nav-link" @click="curPath='/'">
            <img src="/logo.webp" alt="Logo" class="h-8 float-left mr-2">
            Blog Site
          </RouterLink>
        </div>
        <div class="flex items-center space-x-4">
          <RouterLink v-for="(displayName, link) in userLinks" 
        :to=link :class="{'bg-gray-700': curPath==link}" @click="curPath=link"
        class="nav-link" :title="displayName">
        <component v-if="displayName in icons" :is="icons[displayName]" class="h-6 mr-2"></component>
        <span v-else>{{displayName}}</span>
      </RouterLink>
        </div>
      </div>
    </nav>
    </header>

  <div class="flex">
    <nav class="nav1 min-h-screen flex flex-col sticky top-15 h-screen" :class="sidebar ? 'w-50': 'w-10'">
      <div class="nav-link mb-5" @click="sidebar = !sidebar">
        <component :is="icons['Expand']" class="h-6 float-left mr-2" :title="displayName"></component>
        <span v-if="sidebar">Collapse</span>
      </div>
      <RouterLink v-for="(displayName, link) in links" 
        :to=link :class="{'bg-gray-700': curPath==link}" @click="curPath=link"
        class="nav-link" :title="displayName">
        <component :is="icons[displayName]" class="h-6 float-left mr-2"></component>
        <span v-if="sidebar">{{displayName}}</span>
      </RouterLink>

    </nav>
    <main class="flex-1 p-8 bg-gray-100">
      <RouterView></RouterView>
    </main>
  </div>
</template>
