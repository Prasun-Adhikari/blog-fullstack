<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { useRoute } from 'vue-router';

import { useBlogStore } from './stores/blog.js';
import PostList from './PostList.vue';

const route = useRoute()
const blogStore = useBlogStore();

const user = ref({name: ''})

async function search(type) {
  alert("Not implemented")
}

onMounted(async () => {
  user.value = await blogStore.getUserPosts(route.params.id);
})
onUnmounted(() => blogStore.posts = [])

</script>

<template>

<input v-model="blogStore.query.string" class="txtin"></input>
<button @click="search('like')" class="btn1">Search</button>
<button @click="search('regex')" class="btn1">Search Regex</button>

<br><br>

User <strong>{{ user.name }}</strong>
<button @click="api.post(`api/follow/${user.id}`)" class="btn1">Follow</button>

<br><br>
All Posts:
<PostList></PostList>

</template>

<style scoped>
</style>
