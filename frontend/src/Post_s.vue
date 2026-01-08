<script setup>
import { onMounted, ref } from 'vue';
import Preview from './Preview.vue';
import { useBlogStore } from './stores/blog';
import { useRoute } from 'vue-router';

const route = useRoute();
const blogStore = useBlogStore();
const post = ref({})

onMounted(async () => {
    if (route.params.id) {
        await blogStore.fetchOnePost(route.params.id);
    }
    post.value = blogStore.selectedPost;
})
</script>

<template>
<div  v-if="post.text">
    <div class="prose">
        <h1 class="mb-2">{{ post.title }}</h1>
        <RouterLink :to="`/user/${post.user.id}`" class="mx-4">
            By {{ post.user.name }}
        </RouterLink>
        <span class="mx-4">{{ post.date }}</span>
    </div>
    <img v-if="post.imgUrl" :src="post.imgUrl" class="my-10">
    <br>
    <Preview :postText="post.text"></Preview>
</div>
</template>

<style scoped>
</style>
