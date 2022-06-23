<template>
  <section id="banner" class="banner text-white bg-dark-red text-center pt-44 pb-20 relative px-4">
    <h2 v-html="title"></h2>
    <div class="mt-12">
      <img :src="imgSrc" :alt="imgAlt" class="mx-auto max-w-sm" loading="lazy">
    </div>
  </section>
</template>

<script>
  export default {
    props: ["title", "imgAlt", "imgSrc"],
  }
</script>

<style>
.link:hover > img {
   @apply grayscale-0;
}
h2 {
  @apply text-2xl lg:text-4xl;
}
</style>