<template>
  <footer>
    <div class="bg-gray-900 text-white h-[100vh-114px]" id="contato">
      <div class="container md:flex mx-auto max-w-screen-lg">
        <div class="md:w-2/3">
          <h2 class="py-20 px-4 md:px-0"><b>Estamos sempre aqui,</b> prontos para resolver.</h2>
          <div class="md:grid md:grid-cols-2 pb-20">
            <div class="p-4 lg:p-0">
              <inertia-link href="/">
                <svg-vue icon="logo" class="h-16 lg:h-24"></svg-vue>
              </inertia-link>
            </div>
            <div class="uppercase p-4 lg:p-0">
              <p>Rua Reverendo Guilherme Kerr, 30</p>
              <p>Nova Campinas – Campinas/SP</p>
              <p>Telefone: (19) 3381-1770</p>
              <p>CEP: 13092-139</p>
              <div class="flex gap-2 py-6">
                <a href="https://www.facebook.com/agencianarro" target="_blank" class="fill-white bg-dark-red p-2 rounded-full"><svg-vue icon="social.facebook" class="h-5"></svg-vue></a>
                <a href="https://www.instagram.com/agencianarro/" target="_blank" class="fill-white bg-dark-red p-2 rounded-full"><svg-vue icon="social.instagram" class="h-5"></svg-vue></a>
                <a href="https://www.youtube.com/channel/UCpwpback3u9Zf07YJmdjswQ" target="_blank" class="fill-white bg-dark-red p-2 rounded-full"><svg-vue icon="social.youtube" class="h-5"></svg-vue></a>
                <a href="https://www.linkedin.com/company/agencianarro/" target="_blank" class="fill-white bg-dark-red p-2 rounded-full"><svg-vue icon="social.linkedin" class="h-5"></svg-vue></a>
              </div>
            </div>
          </div>
        </div>
        <div class="md:w-1/3 md:py-20">
          <div role="main" id="site-narro-6f6a9a86fa2096dbd35f"></div>
        </div>
      </div>
    </div>
    <div class="h-14 bg-dark-red text-sm text-center text-white/50 flex justify-center items-center">&copy Copyright {{ new Date().getFullYear() }}. Todos os direitos reservados.</div>
    <component :is="'script'" type="application/javascript" defer src="https://d335luupugsy2.cloudfront.net/js/rdstation-forms/stable/rdstation-forms.min.js" onload="new RDStationForms('site-narro-6f6a9a86fa2096dbd35f', 'null').createForm()"></component>
  </footer>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/inertia-vue3";
const { props } = usePage();
</script>

<script>
  // import "https://d335luupugsy2.cloudfront.net/js/rdstation-forms/stable/rdstation-forms.min.js";
  export default {
    mounted() {
      // setTimeout(function(){ 
        // new RDStationForms('site-narro-6f6a9a86fa2096dbd35f', 'null').createForm();
      // }, 1500);
    },
  }
</script>