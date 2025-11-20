<script setup>
import { onMounted, ref } from 'vue';

import api from './utils/axios.js'
import post from './Post.vue';
import edit from './Edit.vue'

const user = ref({});
const mode = ref('');

async function getUser() {
    const res = await api.get('api/user');
    user.value = await res.data;
}

const posts = ref()
const onepost = ref({title: '[Title]', text: '[Body]', user: {name: '[Author]'}})

async function getPosts() {
  const allposts = await api.get('api/userblog');
  posts.value = allposts.data;
}

async function getOnePost(id) {
    const post = await api.get(`api/blog/${id}`);
    onepost.value = post.data;
}

async function deletepost() {
  if (confirm('Are you sure?')) {
    console.log('deleted');
    await api.delete(`api/blog/${onepost.value.id}`);
    mode.value='';
  }
}

onMounted(getUser)
onMounted(getPosts)

</script>

<template>
Username: {{ user.name }} <br>
Email: {{ user.email }} <br>

Posts:
<ul>
  <li v-for="post in posts">
    <strong>{{ post.title }}</strong>
    - by <em>{{ post.user.name }} </em>
    <button @click="getOnePost(post.id); mode='view'" class="bg-gray-500 text-white px-1 m-1 rounded">View post</button>
  </li>
</ul>

<br>

<div v-if="mode=='view'">
  Selected Post:
  <button @click="mode='edit'">Edit Post</button>
  <button @click="deletepost()">Delete Post</button>
  <div class="border border-gray-400 p-4 m-2">
    <post :post="onepost"></post>
  </div>
</div>

<div v-if="mode=='edit'">
  Edit Post:
  <div class="border border-gray-400 p-4 m-2">
    <edit :post="onepost"></edit>
  </div>
</div>

</template>

<style scoped>
</style>

