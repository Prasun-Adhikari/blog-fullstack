<script setup>
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';

import api from './utils/axios.js'
import post from './Post.vue';

const route = useRoute()

const pattern = ref('')
const posts = ref()
const onepost = ref({title: '[Title]', text: '[Body]', user: {name: '[Author]'}})
const user = ref({name: ''})

async function search(type) {
  const allposts = await api.get(`api/searchblog?pattern=${pattern.value}&type=${type}`);
  posts.value = allposts.data;
}

async function getOnePost(id) {
    const post = await api.get(`api/blog/${id}`);
    onepost.value = post.data;
}

async function getUserPosts(id) {
  const allposts = await api.get(`api/userblog/${id}`);
  posts.value = allposts.data;
  user.value = posts.value[0].user;
  console.log(posts.value, user.value)
}

onMounted(() => getUserPosts(route.params.id))

</script>

<template>

<input v-model="pattern" class="txtin"></input>
<button @click="search('like')" class="btn1">Search</button>
<button @click="search('regex')" class="btn1">Search Regex</button>

<br><br>

User <strong>{{ user.name }}</strong>

<br><br>
All Posts:
<ul>
  <li v-for="post in posts">
    <strong>{{ post.title }}</strong>
    - by <em>{{ post.user.name }} </em>
    <button @click="getOnePost(post.id)" class="btn1">View post</button>

  </li>
</ul>

<br>
Selected Post:
 <div  class="border border-gray-400 p-4 m-2">
   <post :post="onepost" @search="getUserPosts"></post>
 </div>

</template>

<style scoped>
</style>
