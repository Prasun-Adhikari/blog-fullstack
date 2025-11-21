<script setup>
import { onMounted, ref } from 'vue';

import post from './Post.vue';
import { useBlogStore } from './stores/blog.js';

const blogStore = useBlogStore();
const showadvanced = ref(false)

onMounted(blogStore.fetchAllPosts)

</script>

<template>

<input v-model="blogStore.query.string" class="txtin">
<button @click="blogStore.searchPosts" class="btn1">Search</button> <br>
Show advanced settings: <input type="checkbox" v-model="showadvanced">
<div v-if="showadvanced" class="border px-2 w-max">
  Regex: <input type="checkbox" v-model=blogStore.query.regex><br>
  Column: <select v-model="blogStore.query.column" class="h-8 m-1.5 py-0.5 pr-10">
    <option value="default" selected>Title/Body</option>
    <option value="title">Title</option>
    <option value="text">Body</option>
    <option value="user">User</option>
  </select>
</div>

<br><br>

All Posts:
<ul>
  <li v-for="post in blogStore.posts">
    <strong>{{ post.title }}</strong>
    - by <em>{{ post.user.name }} </em>
    <button @click="() => blogStore.selectPost(post.id)" class="btn1">View post</button>

  </li>
</ul>

<br>
Selected Post:
 <div  class="border border-gray-400 p-4 m-2">
   <post :post="blogStore.selectedPost" @search="blogStore.getUserPosts"></post>
 </div>

<br><br>
<br><br>
Raw data (for debugging):
<pre class="container max-w-200 overflow-clip">{{ JSON.stringify(blogStore.posts, null, 2) }}</pre>

</template>

<style scoped>
</style>
