<script setup>
import { ref } from 'vue';
import { useAuthStore } from './stores/auth.js';
import { useRouter } from 'vue-router';

const authStore = useAuthStore();
const router = useRouter();

function logout() {
//   response.value = await api.post('api/login', formData.value);
  authStore.logout();
  router.push({ path: '/' });
}
</script>

<template>
    Are you sure you wan to Logout? <br>
    <button class="btn1" @click="logout">Yes</button>
</template>