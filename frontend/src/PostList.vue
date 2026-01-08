<script setup>

import { useBlogStore } from './stores/blog.js';
import { useRouter } from 'vue-router';

const blogStore = useBlogStore();
const router = useRouter()

</script>

<template>
  <div class="space-y-4">
    <div
      v-for="post in blogStore.posts"
      :key="post.id"
      class="p-4 border border-gray-500 rounded-lg hover:bg-gray-50 transition-colors"
      @click="() => {router.push(`/post/${post.id}`)}"
    >
      <h2 class="text-xl font-semibold">{{ post.title }}</h2>
      <div class="flex items-center text-sm text-gray-500 mt-2">
        <span>By {{ post.user.name }}</span>
        <span class="mx-2">&bull;</span>
        <span>{{ post.date }}</span>
      </div>
    </div>
  </div>
</template>

<style scoped>
</style>
