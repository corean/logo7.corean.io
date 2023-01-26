<!-- resources/js/Components/Breadcrumbs.vue -->
<script setup>
import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const breadcrumbs = computed(() => usePage().props.breadcrumbs || [])
</script>

<template>
  <nav aria-label="breadcrumb" class="mb-3">
    <ol v-if="breadcrumbs" class="breadcrumb breadcrumb-arrows">
      <li
        v-for="page in breadcrumbs"
        class="breadcrumb-item"
        :class="{ active: page.current }"
      >
        <span v-if="page === '/'">/</span>
        <a v-else :href="page.url" aria-current="page">{{ page.title }}</a>
      </li>
    </ol>
  </nav>
</template>
