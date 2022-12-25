<script setup>
import Layout from '@/Layouts/Tabler/Layout.vue'
import { Head } from '@inertiajs/inertia-vue3'
</script>

<template>
  <Head title="home" />

  <Layout>
    <div class="page-body">
      <div class="container-xl">
        <div class="alert alert-success">
          <div class="alert-title">
            {{ __('Welcome') }} {{ $page.props.auth.user.name }}
          </div>
          <div class="text-muted">
            {{ __('You are logged in!') }}
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>
