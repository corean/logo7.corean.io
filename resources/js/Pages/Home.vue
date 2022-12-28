<script setup>
import Layout from '@/Layouts/Tabler/Layout.vue'
import { Head } from '@inertiajs/inertia-vue3'
</script>

<template>
  <Head title="home" />

  <Layout>
    <div class="page-body">
      <div class="container-xl">
        <div
          class="alert alert-success alert-dismissible fade show"
          role="alert"
        >
          <div class="d-flex">
            <div>
              <!--<svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>-->
              <i class="ti ti-check icon alert-icon fs-1"></i>
            </div>
            <div>
              <h4 class="alert-title">
                {{ __('Welcome') }} {{ $page.props.auth.user.name }}
              </h4>
              <div class="text-muted">
                {{ __('You are logged in!') }}
              </div>
            </div>
          </div>
          <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
      </div>
    </div>
  </Layout>
</template>
