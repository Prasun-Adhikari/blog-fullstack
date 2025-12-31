<script setup>
import Preview from './Preview.vue';
import { useBlogStore } from './stores/blog';

const blogStore = useBlogStore();
const post = blogStore.selectedPost;
</script>

<template>
    <div class="prose">
        <h1 class="mb-2">{{ post.title }}</h1>
        <RouterLink :to="`/user/${post.user.id}`" class="mx-4">
            By {{ post.user.name }}
        </RouterLink>
        <span class="mx-4">{{ post.date }}</span>
    </div>
    <br>
    <Preview :postText="post.text"></Preview>
</template>

<style scoped>
</style>
