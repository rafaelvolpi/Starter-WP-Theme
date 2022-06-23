<template>
  <div>
    <Header />
    <slot></slot>
    <Footer />
  </div>
</template>

<script setup>
import Header from './Header.vue'
import Footer from './Footer.vue'
</script>

<style></style>
