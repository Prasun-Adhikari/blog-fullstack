<script setup>
import Preview from './Preview.vue';

const props = defineProps({
    post: {'title': String, 'text': String, 'user': {}}
})

const emit = defineEmits(['search'])

</script>

<template>
    <div class="prose">
        <h1 class="mb-2">{{ post.title }}</h1>
        &emsp; by
        <RouterLink :to="`/user/${post.user.id}`">
          {{ post.user.name }}
        </RouterLink>
    </div>
    <br>
    <Preview :postText="post.text"></Preview>
</template>

<style scoped>
</style>
