<script setup>
import { onMounted, onUnmounted, ref } from 'vue';

import { useBlogStore } from './stores/blog.js';
import PostList from './PostList.vue';

const blogStore = useBlogStore();
const showadvanced = ref(false)

onMounted(blogStore.fetchAllPosts)
onUnmounted(() => blogStore.posts = [])
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
<PostList></PostList>

<br><br>
Raw data (for debugging):
<pre class="container max-w-200 overflow-clip">{{ JSON.stringify(blogStore.posts, null, 2) }}</pre>

</template>

<style scoped>
</style>
