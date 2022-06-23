<template>
    <div class="h-[104px] bg-dark-red w-screen"></div>
  <article class="pb-24">

    <div class="container mx-auto max-w-screen-lg py-12">
      <h2><b>Blog</b></h2>
      <div class="flex flex-wrap pt-8 gap-1">
        <button class="uppercase text-xs text-gray-500 rounded px-2 py-1" :class="(tipo === '') ? 'active' : ''" @click="setTipo('')">Todos</button>
        <button class="uppercase text-xs text-gray-500 rounded px-2 py-1" :class="(category.term_id === tipo) ? 'active' : ''" v-for="(category, i) in categories" :key="i" @click="setTipo(category.term_id)">{{category.name}}</button>
      </div>
    </div>

    <div class="my-1 container p-4 lg:p-0">
      <div class="grid lg:grid-cols-3 gap-8" v-if="data_to_show">
        <blog-item
          v-for="(item, i) in data_to_show"
          :key="i"
          :uri="item.uri"
          :title="item.title"
          :excerpt="item.excerpt"
          :categories="item.categories"
          :image="item.featuredImage ? item.featuredImage.node.sourceUrl : ''"
        />
      </div>
    </div>
  
    <div class="pb-8 text-center" v-if="!isFetching && data && data.posts.pageInfo.hasNextPage">
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

  import BlogItem from '../Components/BlogItem'
  import InsideBanner from '../Components/InsideBanner'
  import { useQuery } from 'villus';
  import { computed, ref } from "vue";


  export default {
    data() {
      return {
        data_to_show: [],
      }
    },
    props: ["banner", "more_portfolio", "terms", "categories"],
    components: {
      BlogItem,
      InsideBanner,
    },
    setup() {

      const tipo = ref("");
      const nextCursor = ref(null);

      const FetchPosts = computed(() => {
        let where = "";
        (tipo.value == "") ? where = "where: {status: PUBLISH}" : where = `where: {status: PUBLISH, categoryIn: ${tipo.value}}`;
        return `query fetchPosts {
          posts (first: 12, after: "${nextCursor.value}", ${where}) {
            nodes {
              uri
              title
              date
              databaseId
              categories {
                nodes {
                  categoryId
                  uri
                  slug
                  name
                }
              }
              excerpt
              featuredImage {
                node {
                  sourceUrl(size: MEDIUM_LARGE)
                }
              }
            }
            pageInfo {
              endCursor
              hasNextPage
            }
          }
        }`;
      });

      const { data, isFetching } = useQuery({
        query: FetchPosts,
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
        this.nextCursor = this.data.posts.pageInfo.endCursor;
      },
    },
    watch: {
      data: {
        handler() {
          console.log("ALTEROU O VALOR");
          this.data_to_show.push(...this.data.posts.nodes);
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