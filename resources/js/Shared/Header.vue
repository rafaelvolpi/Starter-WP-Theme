<template>
  <header 
    id="headerMenu" 
  >
    <div class="desktopMenu">
      <nav id="destop-nav" ref="desktopNav">
        <ul class="menu-ul flex">
          <li @click="toggleDesktopMenu()">
            <svg-vue icon="hamburguer" class="h-6 mr-4"></svg-vue>
          </li>
          <li
            v-for="(item, index) in Object.values($page.props.primary_menu)"
            :key="index"
            class="menu-li py-0.5 px-2 xl:px-4 uppercase"
            :class="desktopMenu ? 'open' : 'desktop-menu-hidden'"
          >
          <inertia-link
            :href="item.url"
            v-html="item.title"
          ></inertia-link>
          </li>
          <li onclick="window.scrollTo(0, document.body.scrollHeight);" class="menu-li py-0.5 px-2 xl:px-4 uppercase cursor-pointer">CONTATO</li>
        </ul>
      </nav>
      <div class="logo">
        <inertia-link href="/">
          <svg-vue icon="logo" class="h-full w-full"></svg-vue>
        </inertia-link>
      </div>
      <div class="w-1/2 hidden lg:block text-right invisible">PT</div>
    </div>

    <div class="mobileMenu" :class="mobileMenu ? 'fixed' : 'absolute'" @click="toggleMobileMenu()">
      <div id="nav-icon3" :class="mobileMenu ? 'open' : ''">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    
    <nav 
      id="mobile-nav" 
      ref="mobileNav" 
      class="fixed left-0 top-0 lg:hidden bg-dark-red z-40 w-screen bg-black/50 h-screen"
      :class="mobileMenu ? 'ml-0' : '-ml-full'"
    >
      <div class="relative w-4/5 h-screen bg-dark-red p-10 text-white">
      <div class="absolute top-4 right-8">
        <inertia-link href="/">
          <svg-vue icon="logo" class="h-14"></svg-vue>
        </inertia-link>
      </div>
        <ul class="pt-16">
          <li
            v-for="(item, index) in Object.values($page.props.primary_menu)"
            :key="index"
            class="py-4 uppercase"
            @click="toggleMobileMenu()"
          >
          <inertia-link
            :href="item.url"
            v-html="item.title"
          ></inertia-link>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</template>

<script>
  import { usePage } from '@inertiajs/inertia-vue3';
  const { props } = usePage()

  export default {
    data() {
      return {
        mobileMenu: false,
        desktopMenu: false,
      }
    },
    methods: {
      toggleMobileMenu () {
        this.mobileMenu = !this.mobileMenu;
      },
      toggleDesktopMenu () {
        this.desktopMenu = !this.desktopMenu;
      }
    },
    mounted() {
      window.onscroll = function() {
        var h = document.getElementById('headerMenu');
        if ( window.pageYOffset > 100 ) {
          h.classList.add("fixHeader");
        } else {
          h.classList.remove("fixHeader");
        }
      }
    }, 
  }
</script>

<style>

#headerMenu {
  @apply fixed top-0 z-[100] w-screen;
  & > .desktopMenu {
    @apply 2xl:container flex justify-between items-center text-white mx-auto p-5;
    div.logo {
      @apply h-16 m-auto;
    }
  }
  & > .mobileMenu {
    @apply lg:hidden left-0 top-0 p-10 pt-12 pr-6 z-50 text-white;
  }
  &.fixHeader {
    @apply bg-dark-red;
  }
  #destop-nav {
    @apply w-1/2 hidden lg:block;
  }
}

#nav-icon1, #nav-icon2, #nav-icon3, #nav-icon4 {
  width: 1.75rem;
  position: relative;
  margin: 0px auto;
  -webkit-transform: rotate(90deg);
  -moz-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  transform: rotate(90deg);
  -webkit-transition: .5s ease-in-out;
  -moz-transition: .5s ease-in-out;
  -o-transition: .5s ease-in-out;
  transition: .5s ease-in-out;
  cursor: pointer;
}

#nav-icon1 span, #nav-icon3 span, #nav-icon4 span {
  display: block;
  position: absolute;
  height: 2px;
  width: 100%;
  opacity: 1;
  left: 0;
  -webkit-transform: rotate(0deg);
  -moz-transform: rotate(0deg);
  -o-transform: rotate(0deg);
  transform: rotate(0deg);
  -webkit-transition: .25s ease-in-out;
  -moz-transition: .25s ease-in-out;
  -o-transition: .25s ease-in-out;
  transition: .25s ease-in-out;
  @apply bg-white;
}

#nav-icon3 span:nth-child(1) {
  top: 0px;
}

#nav-icon3 span:nth-child(2),#nav-icon3 span:nth-child(3) {
  top: 8px;
}

#nav-icon3 span:nth-child(4) {
  top: 16px;
}

#nav-icon3.open span:nth-child(1) {
  top: 18px;
  width: 0%;
  left: 50%;
}

#nav-icon3.open span:nth-child(2) {
  -webkit-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg);
}

#nav-icon3.open span:nth-child(3) {
  -webkit-transform: rotate(-45deg);
  -moz-transform: rotate(-45deg);
  -o-transform: rotate(-45deg);
  transform: rotate(-45deg);
}

#nav-icon3.open span:nth-child(4) {
  top: 18px;
  width: 0%;
  left: 50%;
}
</style>