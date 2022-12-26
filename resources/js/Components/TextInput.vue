<script setup>
import { onMounted, ref } from 'vue'

defineProps(['modelValue'])

defineEmits(['update:modelValue'])

const input = ref(null)

onMounted(() => {
  if (input.value.hasAttribute('autofocus')) {
    input.value.focus()
  }
})

defineExpose({ focus: () => input.value.focus() })
</script>

<template>
  <input
    class="_rounded-md _border-gray-300 _shadow-sm focus:_border-indigo-500 focus:_ring-indigo-500"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
    ref="input"
  />
</template>
