import '../css/app.css' // tailwindcss
import '@tabler/core/src/js/tabler.js'
import './bootstrap'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'
import translation from './translation'
import Toast, { POSITION } from 'vue-toastification'
import 'vue-toastification/dist/index.css'

const appName =
  window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel'

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  class: 'page',
  resolve: (name) =>
    resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob('./Pages/**/*.vue')
    ),
  setup({ el, app, props, plugin }) {
    return createApp({ render: () => h(app, props) })
      .use(plugin)
      .use(ZiggyVue, Ziggy)
      .use(Toast, {
        // Setting the global default position
        position: POSITION.TOP_CENTER,
        hideProgressBar: true,
        timeout: 1968,
      })
      .mixin(translation)
      .mount(el)
  },
})

InertiaProgress.init({ color: '#4B5563' })
