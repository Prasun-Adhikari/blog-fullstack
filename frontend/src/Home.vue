<script setup>
import { onMounted, ref } from 'vue';

import api from './utils/axios.js'
import post from './Post.vue';

const pattern = ref('')
const posts = ref()
const onepost = ref({title: '[Title]', text: '[Body]', user: {name: '[Author]'}})

async function search(type) {
  const allposts = await api.get(`api/searchblog?pattern=${pattern.value}&type=${type}`);
  posts.value = allposts.data;
}

async function getPosts() {
  const allposts = await api.get('api/blog');
  posts.value = allposts.data;
}

async function getOnePost(id) {
    const post = await api.get(`api/blog/${id}`);
    onepost.value = post.data;
}

onMounted(getPosts)

</script>

<template>

<input v-model="pattern"></input>
<button @click="search('like')" class="bg-gray-500 text-white p-1 m-1 rounded">Search</button>
<button @click="search('regex')" class="bg-gray-500 text-white p-1 m-1 rounded">Search Regex</button>

<br><br>

All Posts:
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

<br><br>
<br><br>
Raw data (for debugging):
<pre class="container max-w-200 overflow-clip">{{ JSON.stringify(posts, null, 2) }}</pre>

</template>

<style scoped>
</style>
