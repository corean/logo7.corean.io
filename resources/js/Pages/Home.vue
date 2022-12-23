<script setup>
import Layout from '@/Layouts/Layout.vue'
import { Head } from '@inertiajs/inertia-vue3'
</script>

<template>
  <Head title="home" />

  <Layout>
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            Welcome to your Inertia app! <br />
            한글 글꼴 테스트
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>
