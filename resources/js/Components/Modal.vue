<script setup>
import { computed, onMounted, onUnmounted, watch } from 'vue'

const props = defineProps({
  show: {
    type: Boolean,
    default: false,
  },
  maxWidth: {
    type: String,
    default: '2xl',
  },
  closeable: {
    type: Boolean,
    default: true,
  },
})

const emit = defineEmits(['close'])

watch(
  () => props.show,
  () => {
    if (props.show) {
      document.body.style.overflow = '_hidden'
    } else {
      document.body.style.overflow = null
    }
  }
)

const close = () => {
  if (props.closeable) {
    emit('close')
  }
}

const closeOnEscape = (e) => {
  if (e.key === 'Escape' && props.show) {
    close()
  }
}

onMounted(() => document.addEventListener('keydown', closeOnEscape))

onUnmounted(() => {
  document.removeEventListener('keydown', closeOnEscape)
  document.body.style.overflow = null
})

const maxWidthClass = computed(() => {
  return {
    sm: 'sm:_max-w-sm',
    md: 'sm:_max-w-md',
    lg: 'sm:_max-w-lg',
    xl: 'sm:_max-w-xl',
    '2xl': 'sm:_max-w-2xl',
  }[props.maxWidth]
})
</script>

<template>
  <teleport to="body">
    <transition leave-active-class="_duration-200">
      <div
        v-show="show"
        class="_fixed _inset-0 _z-50 _overflow-y-auto _px-4 _py-6 sm:_px-0"
        scroll-region
      >
        <transition
          enter-active-class="_ease-out _duration-300"
          enter-from-class="_opacity-0"
          enter-to-class="_opacity-100"
          leave-active-class="_ease-in _duration-200"
          leave-from-class="_opacity-100"
          leave-to-class="_opacity-0"
        >
          <div
            v-show="show"
            class="_fixed _inset-0 _transform _transition-all"
            @click="close"
          >
            <div class="_absolute _inset-0 _bg-gray-500 _opacity-75" />
          </div>
        </transition>

        <transition
          enter-active-class="_ease-out _duration-300"
          enter-from-class="_opacity-0 _translate-y-4 sm:_translate-y-0 sm:_scale-95"
          enter-to-class="_opacity-100 _translate-y-0 sm:_scale-100"
          leave-active-class="_ease-in _duration-200"
          leave-from-class="_opacity-100 _translate-y-0 sm:_scale-100"
          leave-to-class="_opacity-0 _translate-y-4 sm:_translate-y-0 sm:_scale-95"
        >
          <div
            v-show="show"
            class="_mb-6 _transform _overflow-hidden _rounded-lg _bg-white _shadow-xl _transition-all sm:_mx-auto sm:_w-full"
            :class="maxWidthClass"
          >
            <slot v-if="show" />
          </div>
        </transition>
      </div>
    </transition>
  </teleport>
</template>
