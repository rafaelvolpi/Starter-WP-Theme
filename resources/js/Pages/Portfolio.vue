<template>
    <div class="h-[104px] bg-dark-red w-screen"></div>
  <article class="pb-24">

    <div class="container mx-auto max-w-screen-lg py-12">
      <h2><b>Cases</b> que resolvemos</h2>
      <!-- <div class="flex flex-wrap pt-8 lg:pt-2 gap-2">
        <button class="px-2 text-gray-500 rounded px-2 py-1" :class="(tipo === '') ? 'active' : ''" @click="setTipo('')">Todos</button>
        <button class="px-2 text-gray-500 rounded px-2 py-1" :class="(term.slug === tipo) ? 'active' : ''" v-for="(term, i) in terms" :key="i" @click="setTipo(term.slug)">{{term.name}}</button>
      </div> -->
    </div>

    <div class="my-1 container p-4 lg:p-0">
      <div class="grid grid-cols-2 gap-2 lg:grid-cols-3 lg:gap-8" v-if="data_to_show">
        <portfolio-item
          v-for="(item, i) in data_to_show"
          :key="i"
          :uri="item.uri"
          :client="item.portfolio.portfolioClient"
          :campaign="item.portfolio.portfolioName"
          :image="item.featuredImage.node.sourceUrl"
        />
      </div>
    </div>
  
    <div class="pb-8 text-center" v-if="!isFetching && data && data.portfolios.pageInfo.hasNextPage">
      <div class="relative my-12 text-center text-gray-500">
        <svg viewBox="0 0 1 100" class="w-1 h-24 mx-auto"><line class="b" x1="1" x2="1" y2="100" stroke="currentColor"/></svg>
      </div>
      <button
          as="button"
          type="button"
          @click="loadMore"
          class="uppercase underline underline-offset-4 hover:text-dark-red"
      >
        Veja mais
      </button>
    </div>

  </article>
</template>

<script>
  import { usePage } from '@inertiajs/inertia-vue3';
  const { props } = usePage();

  import PortfolioItem from '../Components/PortfolioItem'
  import InsideBanner from '../Components/InsideBanner'
  import { useQuery } from 'villus';
  import { computed, ref } from "vue";


  export default {
    data() {
      return {
        data_to_show: [],
      }
    },
    props: ["banner", "more_portfolio", "terms"],
    components: {
      PortfolioItem,
      InsideBanner,
    },
    setup() {

      const tipo = ref("");
      const nextCursor = ref(null);

      const FetchPortfolios = computed(() => {
        let where = "";
        (tipo.value == "") ? where = "where: {orderby: {field: MENU_ORDER, order: ASC}}" : where = `where: {orderby: {field: MENU_ORDER, order: ASC}, taxQuery: {taxArray: {field: SLUG, operator: IN, taxonomy: TIPO, terms: "${tipo.value}"}}}`;
        return `query FetchPortfolios { portfolios ( first: 12, after: "${nextCursor.value}", ${where} ) { nodes { databaseId title portfolio { portfolioName portfolioClient } uri featuredImage { node { sourceUrl(size: MEDIUM_LARGE) } } } pageInfo { hasNextPage endCursor } } }`;
      });

      const { data, isFetching } = useQuery({
        query: FetchPortfolios,
      });

      return { data, tipo, nextCursor, isFetching};
    },
    methods: {
      setTipo(v) {
        this.data_to_show = [];
        this.nextCursor = null;
        this.tipo = v;
      },
      loadMore() {
        // this.data_to_show.push(...this.data.portfolios.nodes);
        this.nextCursor = this.data.portfolios.pageInfo.endCursor;
      },
    },
    watch: {
      data: {
        handler() {
          console.log("ALTEROU O VALOR");
          this.data_to_show.push(...this.data.portfolios.nodes);
        },
        deep: true,
      },
    }
  }
</script>

<style>
.link:hover > img {
   @apply grayscale-0;
}
button.active {
  @apply text-dark-red bg-gray-100;
}
</style>