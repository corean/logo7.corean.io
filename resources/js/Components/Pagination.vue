<script setup>
import { Link } from '@inertiajs/inertia-vue3'

defineProps({
  data: {
    type: Object,
    default: () => ({}),
  },
})
</script>

<template>
  <div v-if="data.links.length > 3" class="flex justify-end">
    <Link
      v-for="(link, k) in data.links"
      :key="k"
      class="flex cursor-pointer items-center break-words rounded py-1 px-2.5 text-center text-sm text-gray-700 hover:bg-gray-200"
      :class="{
        'bg-indigo-500 text-white hover:bg-indigo-600 focus:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2':
          link.active,
      }"
      :href="link.url"
      v-html="link.label"
      preserve-scroll
    />
  </div>
</template>
