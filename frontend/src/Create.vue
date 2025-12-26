<script setup>
import { ref } from 'vue';

import api from './utils/axios.js'
import Preview from './Preview.vue';

const formData = ref({title: null, text: ''})

function submitForm() {
  api.post('api/blog', formData.value);
}
</script>

<template>
Create New Post:
<form method="POST" v-on:submit.prevent="submitForm">
  Title: <input name="title" v-model="formData.title" class="txtin"> <br>
  Body: <br>
  <textarea name="text" v-model="formData.text" cols="30" rows="15" class="float-left"> </textarea>
  <Preview class="border p-5 ml-5 float-left min-w-100 min-h-100" :postText="formData.text"></Preview>

  <br style="clear:both">
  <button type="submit" class="btn1">Submit</button>
</form>


</template>

<style scoped>
</style>

