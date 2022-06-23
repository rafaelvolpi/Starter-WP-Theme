<template>
  <section>

    <h1>Confira nossos posts:</h1>
    <article v-for="post in props.posts" :key="post.ID">
      <inertia-link :href="post.post_name">
        <h3>{{ post.post_title }}</h3>
      </inertia-link>
    </article>
  </section>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/inertia-vue3'
const { props } = usePage()
</script>

<style></style>
