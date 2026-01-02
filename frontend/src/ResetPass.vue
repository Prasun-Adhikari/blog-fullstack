<script setup>
import { ref } from 'vue';

import api from './utils/axios.js'
import { useRouter } from 'vue-router';

const router = useRouter();
const formData = ref({email: localStorage.email})
const display = ref('')
const showPassword = ref(false);

function submitForm() {
  api.post('api/login/reset', formData.value)
  .then(() => router.push({ path: '/login' }))
  .catch((e) => {
    if (e.response.status == 422) {
      display.value = 'Inavlid code / email';
    } else {
      display.value = 'Something went wrong';
    }
  });
}

</script>

<template>
    <form method="POST" v-on:submit.prevent="submitForm">
        Email: <input name="email" v-model="formData.email" class="txtin" type="email"><br>
        Code: <input name="code" v-model="formData.code" class="txtin" type="number">
        Password: <input name="password" v-model="formData.password" class="txtin"
          :type="showPassword ? 'text' : 'password'"><br>
        Confirm Password: <input name="confirmPassword" v-model="formData.confirmPassword" class="txtin"
          :type="showPassword ? 'text' : 'password'"><br>
        <input type="checkbox" v-model="showPassword"> Show password <br><br>
        <button type="submit" class="btn1">Submit</button>
    </form>
    {{ display }}
</template>