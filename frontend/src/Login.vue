<script setup>
import { ref } from 'vue';

import api from './utils/axios.js'
import { useRouter } from 'vue-router';
import { useAuthStore } from './stores/auth.js';

const router = useRouter();
const authStore = useAuthStore();

const formData = ref({})
const response = ref('')
const showPassword = ref(false);


async function submitForm() {
  response.value = await api.post('api/login', formData.value);
  authStore.login(response.value.data.access_token);
  router.push({ path: '/dash' })
//   $cookies.set('access_token', response.value.data.access_token);
//   localStorage.setItem('access_token', response.value.data.access_token);
}
</script>

<template>
    <form method="POST" v-on:submit.prevent="submitForm">
        Email:<input name="email" v-model="formData.email" class="txtin"><br>
        Password:<input name="password" v-model="formData.password" class="txtin"
            :type="showPassword ? 'text' : 'password'"><br>
        <input type="checkbox" v-model="showPassword"> Show password <br><br>
        <button type="submit" class="btn1">Submit</button>
    </form>
    {{ response }}
</template>