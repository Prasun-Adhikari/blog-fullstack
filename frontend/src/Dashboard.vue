<script setup>
import { onMounted, ref } from 'vue';

import api from './utils/axios.js'
import post from './Post.vue';

const user = ref({});

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
    <button @click="getOnePost(post.id)" class="bg-gray-500 text-white px-1 m-1 rounded">View post</button>
  </li>
</ul>

<br>
Selected Post:
 <div  class="border border-gray-400 p-4 m-2">
   <post :post="onepost"></post>
 </div>
</template>

<style scoped>
</style>

