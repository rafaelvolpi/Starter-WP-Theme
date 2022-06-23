import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import Layout from './shared/Layout.vue'
import SvgVue from 'svg-vue3';
import { createClient } from 'villus';

// Start VUE Inertia

createInertiaApp({
  resolve: (name) => {
    const page = require(`./Pages/${name}`).default
    // Use global layout for all pages, unless overridden by individual page.
    page.layout ??= Layout;
    return page
  },
  setup({ el, App, props, plugin }) {
    const client = createClient({
      url: '/graphql', // your endpoint.
    });
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(SvgVue)
      .use(client)
      .component("inertiaLink", Link)
      .mount(el);
  },
});

InertiaProgress.init({ color: "#4B5563" });