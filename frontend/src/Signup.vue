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
        Name:<input name="name" v-model="formData.name"><br>
        Email:<input name="email" v-model="formData.email"><br>
        Password:<input name="password" v-model="formData.password"><br>
        Confirm Password:<input name="confirmPassword" v-model="formData.confirmPassword"><br>
        <button type="submit">Submit</button>
    </form>
    {{ display }}
</template>