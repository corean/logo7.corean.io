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
  <ul class="pagination m-0 ms-auto">
    <li
      v-for="(link, k) in data.links"
      :key="k"
      class="page-item"
      :class="{ active: link.active }"
    >
      <Link
        :href="link.url"
        class="page-link"
        preserve-scroll
        v-html="link.label"
      />
    </li>
  </ul>
</template>
