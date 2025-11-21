<script setup>
import { onMounted } from 'vue';

import post from './Post.vue';
import { useBlogStore } from './stores/blog.js';

const blogStore = useBlogStore();

async function search(type) {
  blogStore.query.type = type
  blogStore.query.column = 'default'
  blogStore.searchPosts();
}

onMounted(blogStore.fetchAllPosts)

</script>

<template>

<input v-model="blogStore.query.string" class="txtin"></input>
<button @click="search('like')" class="btn1">Search</button>
<button @click="search('regex')" class="btn1">Search Regex</button>

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
