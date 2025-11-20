<script setup>
import { ref } from 'vue';
import { marked } from 'marked';

import api from './utils/axios.js'

const props = defineProps({
    post: {'id': Number, 'title': String, 'text': String, 'user': {}}
})

function submitForm() {
  api.put(`api/blog/${props.post.id}`, props.post);
}
</script>

<template>
<form method="PUT" v-on:submit.prevent="submitForm">
  Title: <input name="title" v-model="post.title"> <br>
  Body: <br>
  <textarea name="text" v-model="post.text" cols="30" rows="15" class="float-left"> </textarea>
  <div class="prose border p-5 ml-5 float-left min-w-100 min-h-100">
      <div v-html="marked.parse(post.text)"></div>
  </div>

  <br style="clear:both">
  <button type="submit" class="bg-gray-700 text-white rounded px-1 hover:bg-gray-500">Submit</button>
</form>


</template>

<style scoped>
</style>

