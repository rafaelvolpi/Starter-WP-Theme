<template>
  <main>
    <div id="sliders" class="hero w-screen h-screen bg-gray-800 text-gray-500">
      <carousel :autoplay="5000">
        <slide v-for="(item, i) in sliders" :key="i">
          <picture>
            <source :srcset="item.mobile ? item.mobile.medium_large : item.desktop.medium_large" media="(max-width: 768px)">
            <source :srcset="item.desktop['1536x1536']" media="(max-width: 1536px)">
            <source :srcset="item.desktop['2048x2048']" media="(max-width: 2048px)">
            <img :src="item.mobile ? item.mobile.medium_large : item.desktop.medium_large" :alt="item.title">
          </picture>
        </slide>
        <template #addons>
          <pagination />
        </template>
      </carousel>
    </div>

    <section id="sobre" class="sobre text-white bg-dark-red text-center p-32 relative px-4">
      <h1 v-html="customFields.banner_title"></h1>
      <p class="w-1/2 mx-auto pt-6 text-lg" v-html="customFields.banner_content"></p>
      <div class="mt-16">
        <img :src="customFields.banner_image.url" :alt="customFields.banner_image.alt" class="mx-auto" loading="lazy">
      </div>
      <svg viewBox="0 0 1 100" class="absolute top-0 left-1/2 w-1 h-24"><line class="b" x1="1" x2="1" y2="100" stroke="currentColor"/></svg>
      <svg viewBox="0 0 1 100" class="absolute bottom-0 left-1/2 w-1 h-24"><line class="b" x1="1" x2="1" y2="100" stroke="currentColor"/></svg>
    </section>

    <section id="expertise" class="px-4">
      <div class="container mx-auto max-w-screen-lg py-12">
        <div class="uppercase text-sm text-dark-red" v-html="customFields.expertise_tag"></div>
        <h2 v-html="customFields.expertise_title"></h2>
        <p class="w-1/2 text-lg" v-html="customFields.expertise_content"></p>
      </div>
      <ul class="container box-expertise">
        <li
          v-for="(item, i) in customFields.expertise_list"
          :key="i"
          :style="'background-image: url(' + item.expertise_list_image.url + ')'"
        >
          <div class="content">
            <h3 v-html="item.expertise_list_title"></h3>
            <p class="
              text-base text-white leading-tight
              md:text-sm md:text-white md:leading-none
              xl:text-base 2xl:text-white xl:leading-normal
            " v-html="item.expertise_list_content"></p>
            <svg viewBox="0 0 1 200" class="absolute mt-7 left-1/2 w-0.5 h-full"><line class="b" x1="1" x2="1" y2="200" stroke="currentColor"/></svg>
          </div>
          <div class="background"></div>
        </li>
      </ul>
    </section>

    <section id="clientes" class="px-4">
      <div class="container mx-auto max-w-screen-lg py-12">
        <div class="uppercase text-sm text-dark-red" v-html="customFields.clients_tag"></div>
        <h2 v-html="customFields.clients_title"></h2>
      </div>

      <ul class="container grid grid-cols-4 lg:grid-cols-8 gap-4 pb-12">
        <li
          v-for="(item, i) in customFields.clients_list"
          :key="i"
          class="aspect-video bg-gray-100 flex justify-center items-center"
        >
          <img :src="item.clients_list_image.url" :alt="item.clients_list_image.alt" class="mx-auto" loading="lazy">
        </li>
      </ul>

      <div class="container mx-auto max-w-screen-md py-6 text-center">
        <carousel :items-to-show="1">
          <slide v-for="(item, i) in testimony" :key="i">
            <div>
              <svg-vue icon="quote" class="text-dark-red h-11 mx-auto"></svg-vue>
              <p class="text-lg py-8" v-html="item.testimony"></p>
              <p class="text-sm text-gray-400"><b class="text-black" v-html="item.company"></b> - <span v-html="item.client"></span></p>
            </div>
          </slide>

          <template #addons>
            <navigation />
          </template>
        </carousel>
      </div>
    </section>

    <section id="video" class="scrollSnapItem video relative text-white bg-gray-800 mt-6 h-screen flex flex-col md:flex-row items-center justify-center overflow-hidden">
      <div class="container mx-auto max-w-screen-md z-10 mt-32 md:mt-0">
        <div class="uppercase text-sm px-2">A agência que resolve</div>
        <h2 class="uppercase text-5xl py-2 px-2">18 anos em<br class="md:hidden"> 1 min. 8 seg.</h2>
      </div>
      <div class="md:absolute -rotate-90 md:right-0 md:top-1/2 mt-60 md:mt-0 flex items-center z-10" @click="playVideo()">
        <p class="text-2xl uppercase mr-5">Aperte o play</p>
        <svg-vue icon="play" class="h-16 w-16 rotate-90"></svg-vue>
      </div>
      <video preload="none" autoplay loop muted class="absolute w-auto min-w-full min-h-full max-w-none opacity-30">
        <source src="/wp-content/uploads/2022/06/narro-full.mp4" type="video/mp4" />
      </video>
    </section>

    <modal v-show="videoModal">
      <div class="fixed top-0 flex bg-black/80 w-screen h-screen z-[200] flex justify-center items-center">
        <svg-vue @click="pauseVideo()" class="text-white absolute top-4 right-4 h-12 w-12 rotate-45 z-50" icon="cross"></svg-vue>
        <YouTube 
          src="https://www.youtube.com/watch?v=-Q6B_As2pf8"
          ref="youtube" 
          :player-vars="playerVars"
          class="youtube-video-player"
          width="100%"
          height="100%"
        />
        <!-- <iframe src="https://www.youtube.com/embed/-Q6B_As2pf8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
      </div>
    </modal>

    <section id="portfolio" class="portfolio mb-1">
      <div class="container mx-auto max-w-screen-lg p-4 py-12">
        <div class="uppercase text-sm text-dark-red" v-html="customFields.portfolio_tag ? customFields.portfolio_tag : 'CASES'"></div>
        <h2 v-html="customFields.portfolio_title ? customFields.portfolio_title : '<b>Destaques -</b> veja como resolvemos'"></h2>
      </div>
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-0">
        <portfolio-item
          v-for="(item, i) in portfolio"
          :key="i"
          :uri="item.link"
          :client="item.client"
          :campaign="item.name"
          :image="item.thumbnail.medium_large"
        />
      </div>
    </section>

    <div id="servicos" class="servicos bg-gray-800 text-white">
      <div class="lg:flex p-4 container mx-auto max-w-screen-lg pt-24 gap-12 lg:pb-0 lg:pl-0 lg:pr-0">
        <div class="lg:basis-2/5">
          <div class="uppercase text-sm text-dark-red" v-html="customFields.services_tag"></div>
          <h2 v-html="customFields.services_title"></h2>
          <p class=" pt-2 lg:pt-0" v-html="customFields.services_content"></p>
        </div>
        <div class="lg:basis-3/5 pt-8 lg:pt-0">
          <ul class="grid lg:grid-cols-2 gap-y-10">
            <li v-for="(item, i) in customFields.services_list" :key="i" class="flex uppercase">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" class="mr-4 text-dark-red"><circle cx="14" cy="14" r="14" fill="currentColor" /></svg>
              {{ item.services_list_title }}
            </li>
          </ul>
        </div>
      </div>
      <div class="-scale-x-100"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 100"><path fill="currentColor" d="M0 101H641V0L136.225 94.259s-13.995 4.337 -30.568 0.786c-20.574 -4.41 -36.287 -19.715 -36.287 -19.715L0 11.041V100Z"/></svg></div>
    </div>

    <div id="quem" class="quem">
      <div class="container mx-auto max-w-screen-lg p-4 lg:p-0 pb-12">
        <div class="pb-10">
          <div class="uppercase text-sm text-dark-red" v-html="customFields.board_tag"></div>
          <h2 v-html="customFields.board_title"></h2>
          <p class="w-1/2" v-html="customFields.board_content"></p>
        </div>
        <div class="grid grid-cols-3 lg:grid-cols-6 gap-2">
          <figure v-for="(item, i) in customFields.board_list" :key="i">
            <img
              :src="item.board_list_image.url"
              :alt="item.board_list_image.alt"
              class="aspect-[10/12] object-cover object-center grayscale rounded-lg"
              loading="lazy"
            >
            <figcaption class="text-sm">
              <p class="uppercase pt-2" v-html="item.board_list_name"></p>
              <p v-html="item.board_list_role"></p>
            </figcaption>
          </figure>
        </div>
        <div class="py-20">
          <p class="text-dark-red text-center text-3xl uppercase"><b>Entre em contato</b> e entenda como resolvemos.</p>
          <div class="text-center pt-8 flex gap-4 flex-col md:flex-row items-center justify-center">
            <span class="cursor-pointer inline-block bg-whatsapp font-bold text-2xl text-white rounded-full py-3 px-8" onclick="document.getElementById('rd-floating_button-l48v79kp').click()">Whatsapp</span>
            <a class="inline-block bg-orange font-bold text-2xl text-white rounded-full py-3 px-8" href="https://resolve.narro.com.br/vempranarro" target="_blank">Baixe nosso portfolio</a>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/inertia-vue3';
const { props } = usePage();
</script>

<script>
  import PortfolioItem from '../Components/PortfolioItem';
  // import 'vue3-carousel/dist/carousel.css';
  import YouTube from 'vue3-youtube';
  import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
  export default {
    data() {
      return {
        videoModal: false,
        playerVars: {
          controls: 0,
        }
      }
    },
    props: ["customFields", "testimony", "portfolio", "sliders"],
    components: {
      Carousel,
      Slide,
      Pagination,
      Navigation,
      PortfolioItem,
      YouTube,
    },
    methods: {
        playVideo() {
          this.videoModal = true;
          this.$refs.youtube.setPlaybackQuality('highres');
          this.$refs.youtube.playVideo();
        },
        pauseVideo() {
          this.videoModal = false;
          this.$refs.youtube.pauseVideo();
        },
    },
  }
</script>

<style>

/* html {
  scroll-snap-points-y: repeat(200px);
  scroll-padding: 100px 0 0;
  scroll-snap-type: y proximity;
}

.scrollSnapItem {
  scroll-snap-align: start none;
} */

  .youtube-video-player iframe {
    @apply w-full aspect-video lg:p-10 w-screen;
  }

  .box-expertise {
    @apply grid lg:grid-cols-5 gap-4;
    li {
      @apply relative bg-gray-400 w-full basis-auto text-white aspect-video lg:aspect-3/4 overflow-hidden bg-cover;
      div.content {
        @apply absolute top-[calc(100%-2.4rem)] md:top-[calc(100%-3.2rem)] 2xl:top-[calc(100%-4.4rem)] p-2 md:p-4 2xl:p-6 w-full h-full z-20;
      }
      div.background {
        @apply absolute top-0 h-full w-full;
      }
      h3 {
        @apply uppercase font-bold pb-2 xl:pb-4 text-lg xl:text-2xl;
      }
      &:hover{
        div {
          @apply top-0;
        }
        div.background {
          @apply bg-dark-red;
        }
      }
    }
  }
  #clientes {
    .carousel {
      @apply relative;
      .carousel__viewport {
        @apply overflow-hidden;
      }
      .carousel__slide {
        @apply shrink-0;
      }
      .carousel__track {
        @apply relative flex;
      }
      .carousel__prev, .carousel__next {
        @apply bg-dark-red rounded-full mt-4 m-1 h-6 w-6 fill-white;
      }
      .carousel__next--in-active, .carousel__prev--in-active {
        @apply hidden;
      }
    }
  }
  #sliders {
    .carousel {
      @apply relative;
      .carousel__viewport {
        @apply overflow-hidden;
      }
      .carousel__slide {
        @apply shrink-0;
        img {
          @apply w-screen h-screen object-cover object-center;
        }
      }
      .carousel__track {
        @apply relative flex;
      }
      .carousel__pagination {
        @apply absolute top-1/2 right-5 transform -translate-y-1/2;
        .carousel__pagination-button {
          @apply w-3 h-3 rounded-full bg-gray-500 border-transparent;
          &.carousel__pagination-button--active {
            @apply border-2 border-white bg-transparent;
          }
        }
      }
    }
  }

</style>
