<script setup>
defineProps(['value'])
</script>

<template>
  <label class="_block _text-sm _font-medium _text-gray-700">
    <span v-if="value">{{ value }}</span>
    <span v-else><slot /></span>
  </label>
</template>
