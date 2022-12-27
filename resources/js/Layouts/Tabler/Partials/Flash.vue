<script setup>
import { usePage } from '@inertiajs/inertia-vue3'
import { useToast } from 'vue-toastification'
import { watch } from 'vue'

const toast = useToast()

const $flash = usePage().props.value.flash
let toastId = null
console.log('usePage().props.value.flash1', usePage().props.value.flash)

if ($flash) {
  if ($flash.message) {
    toastId = toast($flash.message)
    console.log('usePage().props.value.flash2', usePage().props.value.flash)
  }
  if ($flash.success) {
    toastId = toast.success($flash.success)
    console.log('usePage().props.value.flash3', usePage().props.value.flash)
  }
  if ($flash.error) {
    toastId = toast.error($flash.error)
    console.log('usePage().props.value.flash4', usePage().props.value.flash)
  }
  // usePage().props.value.flash = null
  console.log('toastId', toastId)
  console.log('usePage().props.value.flash5', usePage().props.value.flash)

  if (toastId !== null) {
    setTimeout(() => toast.clear(), 1968)
  }
}

watch(
  () => usePage().props.value.flash,
  (flash) => {
    let toastId = null
    console.log('flash', flash)

    if (flash.message) {
      toastId = this.$toast(flash.message)
    }
    if (flash.success) {
      toastId = toast.success(flash.success)
    }
    if (flash.error) {
      toastId = toast.error(flash.success)
    }

    if (toastId !== null) {
      setTimeout(() => toast.dismiss(toastId), 5000)
    }
  },
  { deep: true }
)
</script>

<template></template>
