<template>
  <div class="relative bg-dark-red w-full basis-auto text-white aspect-square overflow-hidden">
    <inertia-link :href="uri" class="link block">
      <img class="absolute top-0 right-0" :src="image">
      <div class="overlay absolute top-0 right-0 w-full h-full z-10 bg-dark-red opacity-0 p-2 lg:p-7">
        <div class="relative uppercase z-20">
          <p class="font-bold" v-html="client"></p>
          <p v-html="campaign"></p>
        </div>
        <div class="absolute top-1/2 right-1/2 z-20">
          <svg-vue icon="cross" class=" h-8 w-8 -mt-4 -mr-4 lg:h-12 lg:w-12 lg:-mt-6 lg:-mr-6"></svg-vue>
        </div>
      </div>
    </inertia-link>
  </div>
</template>

<script>
  export default {
    props: ["uri", "client", "campaign", "image"],
  }
</script>

<style>
.link:hover > div.overlay {
   @apply opacity-90;
}
</style>