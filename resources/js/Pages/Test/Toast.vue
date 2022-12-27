<script setup>
import Layout from '@/Layouts/Tabler/Layout.vue'
import { Head } from '@inertiajs/inertia-vue3'
import { useToast } from 'vue-toastification'

defineProps({
  title2: {
    type: String,
    default: '',
  },
})

const toast = useToast()

const showToast = () => {
  toast.success("I'm a toast!")
  console.log('showToast')
}
</script>

<template>
  <Head title="test" />

  <Layout>
    <div class="page-body">
      <div class="container-xl">
        <h2>{{ title2 }}</h2>
        <pre>{{ $page.props.flash }}</pre>
        <button class="btn btn-default" @click="showToast()">toast !</button>
      </div>
    </div>
  </Layout>
</template>
