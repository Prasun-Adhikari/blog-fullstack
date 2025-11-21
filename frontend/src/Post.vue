<script setup>
import {ref} from 'vue'
import { marked } from 'marked';

const props = defineProps({
    post: {'title': String, 'text': String, 'user': {}}
})

const emit = defineEmits(['search'])

</script>

<template>
    <div class="prose">
        <h1>{{ post.title }}</h1>
        by
        <RouterLink :to="`/user/${post.user.id}`">
          {{ post.user.name }}
        </RouterLink>
    </div>
    <br>
    <div v-html="marked.parse(post.text)" class="prose"></div>
</template>

<style scoped>
/* span {
  font-size: 1.2em;
}
.done1 {
  text-decoration: line-through;
}
button, input {
  border: revert;
  padding: 0px 5px;  
  margin: 5px;
} */
</style>
