<template>
  <section>
    <div class="h-[104px] bg-dark-red w-screen"></div>
    <article>

    <div class="container mx-auto max-w-screen-lg py-12">
      <h2><b>{{portfolio.portfolio_name}}</b><span v-if="portfolio.portfolio_client"> | {{ portfolio.portfolio_client }}</span></h2>
    </div>

      <section class="overflow-x-hidden">
        <div class="container mx-auto max-w-screen-lg">
          <carousel :items-to-show="1">
            <slide v-for="(item, i) in portfolio.portfolio_gallery" :key="i">
              <template v-if="item.portfolio_gallery_tipo == 'imagem'">
                <img :src="item.portfolio_gallery_imagem.url">
              </template>
              <template v-if="item.portfolio_gallery_tipo == 'video'">
                <iframe class="w-full h-full" :src="'https://www.youtube.com/embed/' + getVideo(item.portfolio_gallery_video)" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </template>
            </slide>
            <template #addons>
              <navigation />
            </template>
          </carousel>
        </div>
      </section>

      <div class="container mx-auto max-w-screen-lg px-4 lg:px-0 py-8" v-html="props.post.post_content"></div>

      <div class="container mx-auto max-w-screen-lg flex flex-wrap justify-center items-center gap-4 lg:gap-10 px-4">
        <div v-for="(item, i) in portfolio.portfolio_data" :key="i" class="w-40 h-40 rounded-full border-4 border-dark-red flex flex-col items-center justify-center text-center">
          <h3 class="font-bold" v-html="item.portfolio_data_number"></h3>
          <p class="uppercase text-sm pb-2" v-html="item.portfolio_data_info"></p>
        </div>
      </div>

    </article>
  
    <div class="pb-8 text-center">
      <div class="relative my-12 text-center text-gray-500">
        <svg viewBox="0 0 1 100" class="w-1 h-24 mx-auto"><line class="b" x1="1" x2="1" y2="100" stroke="currentColor"/></svg>
      </div>
      <inertia-link
          href="/portfolio"
          class="uppercase underline underline-offset-4 hover:text-dark-red"
      >
        Veja mais
      </inertia-link>
    </div>

    <div class="my-1">
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-0">
        <portfolio-item
          v-for="(item, i) in more_portfolio"
          :key="i"
          :uri="item.link"
          :client="item.client"
          :campaign="item.name"
          :image="item.thumbnail.medium_large"
        />
      </div>
    </div>
  </section>
</template>

<script setup>
  import { usePage } from '@inertiajs/inertia-vue3';
  const { props } = usePage()
</script>

<script>
  // import 'vue3-carousel/dist/carousel.css';
  import PortfolioItem from '../Components/PortfolioItem';
  import InsideBanner from '../Components/InsideBanner'
  import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
  export default {
    props: ["banner", "portfolio", "more_portfolio"],
    components: {
      Carousel,
      Slide,
      Pagination,
      Navigation,
      PortfolioItem,
      InsideBanner
    },
    methods: {
      getExtension (e) { 
        return e.substring(e.lastIndexOf('.')+1, e.length);
      },
      getVideo (url) {
        var b = url.substring(url.indexOf("=")+1);
        return b;
      }
    },
  }
</script>

<style>
  .carousel {
    @apply relative;
    .carousel__slide {
      @apply shrink-0;
      img {
        @apply w-full object-cover object-center;
      }
      &:not(.carousel__slide--active) {
        @apply scale-90 opacity-50 blur-sm;
      }
    }
    .carousel__track {
      @apply relative flex;
    }
    .carousel__next, .carousel__prev {
      @apply absolute top-1/2 transform -translate-y-1/2 w-12 h-24 bg-gray-100 hover:bg-gray-200 fill-dark-red;
    }
    .carousel__prev {
     @apply  left-1 opacity-80 lg:-left-6;
    }
    .carousel__next {
      @apply right-1 opacity-80 lg:-right-6;
    }
    .carousel__next--in-active, .carousel__prev--in-active {
      @apply hidden;
    }
  }
</style>