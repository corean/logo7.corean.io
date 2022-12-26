<script setup>
defineProps(['message'])
</script>

<template>
  <div v-show="message">
    <p class="_text-sm _text-red-600">
      {{ message }}
    </p>
  </div>
</template>
