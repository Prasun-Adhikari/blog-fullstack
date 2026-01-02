<script setup>
import { onMounted, ref } from 'vue';

import api from './utils/axios.js'
import Preview from './Preview.vue';
import ensureLogin from './utils/auth.js';

const formData = ref({title: null, text: ''})
const image = ref(null)

async function imageChange(e) {
  image.value = e.target.files[0]
}

async function uploadImage() {
  if (image.value == null) {
    return null;
  } else {
    const fd = new FormData()
    fd.append('image', image.value)
    const response = await api.post('/api/uploadImage', fd, {
      headers: { 'Content-Type': 'multipart/form-data' },
    })
    return response.data.imageUrl;
  }
}

async function submitForm() {
  const imgUrl = await uploadImage();
  if (imgUrl != null) {
    formData.value.imgUrl = imgUrl;
  }
  api.post('api/blog', formData.value);
}

onMounted(ensureLogin)
</script>

<template>
Create New Post:
<form method="POST" v-on:submit.prevent="submitForm">
  Title: <input name="title" v-model="formData.title" class="txtin"> <br>
  Display image (Max 5MB): <input type="file" accept="image/*" @change="imageChange" 
    class="block file:px-2 file:rounded-md file:border file:bg-gray-300"/> <br>
  Body: <br>
  <textarea name="text" v-model="formData.text" cols="30" rows="15" class="float-left"> </textarea>
  <Preview class="border p-5 ml-5 float-left min-w-100 min-h-100" :postText="formData.text"></Preview>

  <br style="clear:both">
  <button type="submit" class="btn1">Submit</button>
</form>


</template>

<style scoped>
</style>

