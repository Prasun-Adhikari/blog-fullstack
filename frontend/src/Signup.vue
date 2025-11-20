<script setup>
import { ref } from 'vue';

import api from './utils/axios.js'

const formData = ref({})
const display = ref('')

function submitForm() {
  const res = api.post('api/signup', formData.value).catch(() => display.value = 'Form rejected');
}
</script>

<template>
    <form method="POST" v-on:submit.prevent="submitForm">
        Name: <input name="name" v-model="formData.name" class="txtin"><br>
        Email: <input name="email" v-model="formData.email" class="txtin"><br>
        Password: <input name="password" v-model="formData.password" class="txtin"><br>
        Confirm Password: <input name="confirmPassword" v-model="formData.confirmPassword" class="txtin"><br>
        <button type="submit" class="btn1">Submit</button>
    </form>
    {{ display }}
</template>