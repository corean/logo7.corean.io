<script setup>
defineProps({
  type: {
    type: String,
    default: 'submit',
  },
})
</script>

<template>
  <button
    :type="type"
    class="_inline-flex _items-center _rounded-md _border _border-transparent _bg-gray-800 _px-4 _py-2 _text-xs _font-semibold _uppercase _tracking-widest _text-white _transition _duration-150 _ease-in-out hover:_bg-gray-700 focus:_bg-gray-700 focus:_outline-none focus:_ring-2 focus:_ring-indigo-500 focus:_ring-offset-2 active:_bg-gray-900"
  >
    <slot />
  </button>
</template>
