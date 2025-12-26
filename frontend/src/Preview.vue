<script setup>
import { computed } from 'vue';
import { marked } from 'marked';
import DOMPurify from 'dompurify';

const props = defineProps({
    postText: String
})
// marked.setOptions({sanitize: true})

const sanitizedHtml = computed(() => {
    const rawHtml = marked.parse(props.postText);
    return DOMPurify.sanitize(rawHtml);
});
</script>

<template>
    
    <div v-html="sanitizedHtml" class="prose"></div>
</template>