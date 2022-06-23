<template>
  <div class="relative bg-white shadow basis-auto text-gray-900 hover:opacity-70">
    <inertia-link :href="uri" class="link block">
      <img class="w-full aspect-video object-cover object-center" :src="image">
      <div class="absolute top-3 left-0 bg-white px-7 py-1 text-xs uppercase text-dark-red">
        <span v-for="(cat, i) in categories.nodes" :key="i">{{ cat.name }}</span>
      </div>
      <div class="p-7 pb-20">
        <p class="font-light text-2xl leading-tight pb-5" v-html="title"></p>
        <p class="font-light leading-tight" v-html="excerpt"></p>
      </div>
    </inertia-link>
  </div>
</template>

<script>
  export default {
    props: ["uri", "title", "excerpt", "date", "categories", "image"],
  }
</script>

<style>
.link:hover > img {
   @apply grayscale-0;
}
</style>