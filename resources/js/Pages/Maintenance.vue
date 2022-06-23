<template>
  <section class="h-full w-screen flex flex-col text-center text-white z-10 container mx-auto">
    <h1 class="pt-8 md:pt-24 pb-8">
      <inertia-link href="/">
        <svg-vue icon="logo" class="h-24 mx-auto"></svg-vue>
      </inertia-link>
    </h1>
    <div class="text-2xl md:text-4xl my-8 font-light leading-normal">
      NÃO É SÓ SOBRE TER IDEIAS. <br />
      É SOBRE FAZER AS IDEIAS ACONTECEREM.
    </div>
    <div class="canivete my-8 md:mb-12">
      <img src="/wp-content/themes/narro/resources/images/canivete.png" class="mx-auto">
    </div>
    <div class="my-8">
      <a href="http://resolve.narro.com.br/vempranarro" target="_blank" class="text-black border-black border-2 p-4 px-6 bg-green inline-block rounded-full text-2xl">BAIXE O NOSSO <b>PORTFÓLIO</b></a>
    </div>
    <footer class="md:mt-32 mb-8">
      <ul class="flex flex-col md:flex-row justify-center items-center gap-4 md:gap-16">
        <li class="flex justify-center items-center">
          <svg-vue icon="maintenance/phone" class="h-9 mr-3"></svg-vue>
          <a href="https://wa.me/5519998799419">WhatsApp: +55 (19) 99879-9419</a>
        </li>
        <li class="flex justify-center items-center">
          <svg-vue icon="maintenance/email" class="h-8 mr-3"></svg-vue>
          <a href="mailto:contato@narro.com.br">contato@narro.com.br</a>
        </li>
        <li class="flex justify-center items-center">
          <svg-vue icon="maintenance/pin" class="h-11 mr-3"></svg-vue>
          R. Rev. Guilherme Kerr, 30 <br class="xl:hidden"><span class="hidden xl:inline">&nbsp;•&nbsp;</span> 
          Nova Campinas • Campinas/SP <br class="xl:hidden"><span class="hidden xl:inline">&nbsp;•&nbsp;</span> 
          CEP: 13092-139
        </li>
      </ul>
    </footer>
    <a class="absolute bottom-0 right-0 text-transparent font-xs" href="/blog">Blog</a>
  </section>
</template>

<script setup>
  import { Link, usePage } from '@inertiajs/inertia-vue3'
  const { props } = usePage()
</script>

<style>
  body {
    @apply bg-dark-red;
    background-image: url('/wp-content/themes/narro/resources/svg/maintenance/bg.svg');
    background-position: center center;
  }
  @media (max-width: 768px) {
    body {
      background-size: 1000%;
    }
  }
</style>