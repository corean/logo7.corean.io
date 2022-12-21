<script setup>
import Layout from '@/Layouts/Layout.vue'
import { Head } from '@inertiajs/inertia-vue3'

defineProps({
  memberships: Object,
})
</script>

<template>
  <Head title="연간회원" />

  <Layout>
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">Membership/Index</div>
          <ul>
            <li v-for="membership in memberships.data" key="membership.no">
              {{ membership.chargename }}
            </li>
          </ul>
        </div>
      </div>
    </div>
  </Layout>
</template>
