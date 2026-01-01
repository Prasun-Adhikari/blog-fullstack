<script setup>
import { onMounted, onUnmounted } from 'vue';

import { useBlogStore } from './stores/blog.js';
import PostList from './PostList.vue';

const blogStore = useBlogStore();

async function search(type) {
  alert("Not implemented")
}

onMounted(blogStore.getFollowedPosts);
onUnmounted(() => blogStore.posts = [])

</script>

<template>

<input v-model="blogStore.query.string" class="txtin"></input>
<button @click="search('like')" class="btn1">Search</button>
<button @click="search('regex')" class="btn1">Search Regex</button>

<br><br>
Followed:
<PostList></PostList>

</template>

<style scoped>
</style>
