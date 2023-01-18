<script setup>
import { Link } from '@inertiajs/vue3'

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
      v-for="(link, key) in data.links"
      :key="key"
      class="page-item"
      :class="{ active: link.active }"
    >
      <Link
        v-if="link.url"
        :href="link.url"
        class="page-link"
        preserve-scroll
        v-html="link.label"
      />
    </li>
  </ul>
</template>
