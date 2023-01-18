<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div
    class="_flex _min-h-screen _flex-col _items-center _bg-gray-100 _pt-6 sm:_justify-center sm:_pt-0"
  >
    <div>
      <Link href="/">
        <ApplicationLogo class="_h-40 _w-40 _fill-current _text-gray-500" />
      </Link>
    </div>

    <div
      class="_mt-6 _w-full _overflow-hidden _bg-white _px-6 _py-4 _shadow-md sm:_max-w-md sm:_rounded-lg"
    >
      <slot />
    </div>
  </div>
</template>
