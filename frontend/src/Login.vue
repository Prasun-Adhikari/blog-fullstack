<script setup>
import { ref } from 'vue';

import api from './utils/axios.js'
import { useRouter } from 'vue-router';
import { useAuthStore } from './stores/auth.js';

const router = useRouter();
const authStore = useAuthStore();

const formData = ref({})
const showPassword = ref(false);

async function forgotPass() {
    try {
        await api.post('api/login/forgot', formData.value);
        localStorage.email = formData.value.email;
        router.push({ path: '/reset' })
    }
    catch (e) {
        if (e.response.status == 422) {
            alert("Invalid email");
        }
    }
}

async function submitForm() {
    try {
        const response = await api.post('api/login', formData.value);
        console.log(response)
        authStore.login(response.data.access_token);
        router.push({ path: '/dash' })
    }
    catch (e) {
        if (e.response.status == 422) {
            alert("Invalid email or password");
        }
        else if (e.response.status == 401) {
            alert("Incorrect email or password");
        }
        else {
            alert("Something went wrong");
        }
  }
}
</script>

<template>
    <form method="POST" v-on:submit.prevent="submitForm">
        Email:<input name="email" v-model="formData.email" class="txtin"><br>
        Password:<input name="password" v-model="formData.password" class="txtin"
            :type="showPassword ? 'text' : 'password'"><br>
        <input type="checkbox" v-model="showPassword"> Show password <br><br>
        <button type="button" @click="forgotPass">Forgot Password?</button><br>
        <button type="submit" class="btn1">Submit</button>
    </form>
</template>