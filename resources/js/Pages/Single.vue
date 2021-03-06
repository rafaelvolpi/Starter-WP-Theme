<template>
    <div class="h-[104px] bg-dark-red w-screen"></div>
  <section>

    <div class="container mx-auto max-w-screen-lg pt-8 lg:pt-8 p-4 lg:p-0">
      <div class="flex flex-wrap pt-8 gap-2">
        <button class="uppercase text-xs text-gray-500 rounded px-2 py-1" :class="(tipo === '') ? 'active' : ''" @click="setTipo('')">Todos</button>
        <button class="uppercase text-xs text-gray-500 rounded px-2 py-1" :class="(category.term_id === tipo) ? 'active' : ''" v-for="(category, i) in categories" :key="i" @click="setTipo(category.term_id)">{{category.name}}</button>
      </div>
    </div>

    <article id="post_single" class="post_single container relative mx-auto py-12 lg:py-12 p-4 lg:p-0"> 
      <div class="mx-auto max-w-screen-lg border border-gray-200 p-6 lg:p-14">
        <h1 class="text-4xl pb-4 lg:mr-60 leading-tight" v-html="post.title"></h1>
        <p class="text-gray-500" v-text="post.date"></p>
        <div class="py-8 post_image">
          <span v-html="post.thumbnail"></span>
        </div>
        <div class="content">
          <p v-html="post.content"></p>
        </div>
        
        <div class="mt-20 border-t border-gray-200">
          <div class="share_social flex gap-2 mt-4">
            <a :href="'http://www.facebook.com/sharer/sharer.php?u=' + post.url" target="_blank" class="text-gray-400 border-gray-200 hover:border-gray-400 border p-2 rounded-full"><svg-vue icon="social.facebook" class="h-4"></svg-vue></a>
            <a :href="'https://twitter.com/intent/tweet?url=' + post.url" target="_blank" class="fill-gray-400 border border-gray-200 hover:border-gray-400 p-2 rounded-full"><svg-vue icon="social.twitter" class="h-4"></svg-vue></a>
            <a :href="'https://www.linkedin.com/sharing/share-offsite/?url=' + post.url" target="_blank" class="fill-gray-400 border border-gray-200 hover:border-gray-400 p-2 rounded-full"><svg-vue icon="social.linkedin" class="h-4"></svg-vue></a>
          </div>
        </div>
      </div>
    </article>
    </section>
    <section class="pb-16">
    <div id="related" class="container p-4 lg:p-0">
      <h3 class="py-12" @scroll="onScroll">Posts relacionados</h3>
      <div class="grid lg:grid-cols-3 gap-8" v-if="data_to_show">
        <blog-item
          v-for="(item, i) in data_to_show"
          :key="i"
          :uri="item.uri"
          :title="item.title"
          :excerpt="item.excerpt"
          :date="item.date"
          :categories="item.categories"
          :image="item.featuredImage ? item.featuredImage.node.sourceUrl : ''"
        />
      </div>
    </div>
  
    <div class="text-center" v-if="!isFetching && data && data.posts.pageInfo.hasNextPage">
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
  </section>
</template>

<script>
  import { usePage } from '@inertiajs/inertia-vue3';
  const { props } = usePage()

  import BlogItem from '../Components/BlogItem'
  import { useQuery } from 'villus';
  import { computed, ref } from "vue";
  export default {
    data() {
      return {
        data_to_show: [],
        gotoRelated: false,
      }
    },
    props: ["post", "thumbnail", "categories"],
    components: {
      BlogItem,
    },
    setup() {

      const tipo = ref("");
      const nextCursor = ref(null);

      const FetchPosts = computed(() => {
        let where = "";
        (tipo.value == "") ? where = "where: {status: PUBLISH}" : where = `where: {status: PUBLISH, categoryIn: ${tipo.value}}`;
        return `query fetchPosts {
          posts (first: 9, after: "${nextCursor.value}", ${where}) {
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
        this.gotoRelated = true;
      },
      loadMore() {
        this.nextCursor = this.data.posts.pageInfo.endCursor;
      },
      onScroll ({ target: { scrollTop, clientHeight, scrollHeight }}) {
        console.log( scrollTop, clientHeight, scrollHeight );
        if (scrollTop + clientHeight >= scrollHeight) {
          // now you can: 1 - call code to load more content
          // 2 - display notification or popup
          // 3 - etc etc...
        }
      },
    },
    watch: {
      data: {
        handler() {
          console.log("ALTEROU O VALOR");
          this.data_to_show.push(...this.data.posts.nodes);
          if (this.gotoRelated) {
            document.getElementById('related').scrollIntoView({behavior: "smooth", block: "start", inline: "start"});
            this.gotoRelated = false;
          }
        },
        deep: true,
      },
    }
  }
</script>

<style>
  .post_single {
    p {
      @apply font-light text-lg py-2 leading-relaxed;
    }
    h3 {
      @apply text-2xl font-normal text-dark-red py-4;
    }
    h4 {
      @apply text-xl font-normal text-dark-red py-2;
    }
    h5 {
      @apply text-lg font-normal;
    }
    blockquote {
      @apply my-4 px-4 border-l-4 border-gray-100;
    }
    ul:not(.share_social) {
      @apply list-disc list-outside;
    }
  }
</style>