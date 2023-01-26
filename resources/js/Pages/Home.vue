<script setup>
import Layout from '@/Layouts/Tabler/Layout.vue'
import { Head } from '@inertiajs/vue3'
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
</script>

<template>
  <Head title="home" />

  <Layout>
    <div class="page-body">
      <div class="container-xl">
        <Breadcrumbs />
      </div>
    </div>
  </Layout>
</template>
