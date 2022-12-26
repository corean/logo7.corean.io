<script setup>
import { computed } from 'vue'

const emit = defineEmits(['update:checked'])

const props = defineProps({
  checked: {
    type: [Array, Boolean],
    default: false,
  },
  value: {
    default: null,
  },
})

const proxyChecked = computed({
  get() {
    return props.checked
  },

  set(val) {
    emit('update:checked', val)
  },
})
</script>

<template>
  <input
    type="checkbox"
    :value="value"
    v-model="proxyChecked"
    class="_rounded _border-gray-300 _text-indigo-600 _shadow-sm focus:_ring-indigo-500"
  />
</template>
