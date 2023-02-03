<!--
todo. transition 효과 미적용 되었음 (2022-01-02)
-->

<script setup>
import { computed, onMounted, onUnmounted, watch } from 'vue'

const props = defineProps({
  show: {
    type: Boolean,
    default: false,
  },
  maxWidth: {
    type: String,
    default: 'lg',
  },
  closeable: {
    type: Boolean,
    default: true,
  },
})

const emit = defineEmits(['close'])

onMounted(() => document.addEventListener('keydown', closeOnEscape))

onUnmounted(() => {
  document.removeEventListener('keydown', closeOnEscape)
  document.body.classList.add('modal-open')
})

watch(
  () => props.show,
  () => {
    if (props.show) {
      document.body.classList.add('modal-open')
    } else {
      document.body.classList.remove('modal-open')
    }
  }
)

const maxWidthClass = computed(() => {
  return {
    sm: 'modal-sm',
    md: 'modal-md',
    lg: 'modal-lg',
    xl: 'modal-xl',
    'full-width': 'modal-ful-width',
  }[props.maxWidth]
})

const closeOnEscape = (e) => {
  if (e.key === 'Escape' && props.show) {
    close()
  }
}

const close = () => {
  if (props.closeable) {
    emit('close')
  }
}
</script>

<template>
  <teleport to="body">
    <Transition name="modal" appear>
      <div
        class="modal modal-blur fade"
        :class="{ show: props.show }"
        :style="{ display: props.show ? 'block' : 'none' }"
        id="modal-report"
        tabIndex="-1"
        aria-modal="true"
        role="dialog"
        @click.self="close"
      >
        <div
          class="modal-dialog modal-dialog-centered"
          :class="maxWidthClass"
          role="document"
        >
          <div class="modal-content">
            <div class="modal-header">
              <slot name="modal-header" />
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click="close"
              ></button>
            </div>
            <div class="modal-body">
              <slot />
            </div>
            <div class="modal-body">
              <slot name="modal-body" />
            </div>
            <div class="modal-footer">
              <a
                href="#"
                class="btn btn-ghost-cancel"
                @click="close"
                data-bs-dismiss="modal"
              >
                취소
              </a>
              <slot name="modal-footer" />
            </div>
          </div>
        </div>
      </div>
    </Transition>

    <Transition name="modal-backdrop" appear>
      <div
        v-if="props.show"
        :class="{ show: props.show }"
        class="modal-backdrop fade show"
      />
    </Transition>
  </teleport>
</template>

<style scoped>
.modal-enter-active,
.modal-leave-active {
  transition: transform 0.3s ease-out;
}
.modal-enter-from,
.modal-leave-to {
  transform: translateY(-1rem);
}

.modal-backdrop-enter-active,
.modal-backdrop-leave-active {
  transition: opacity 0.15s ease;
}
.modal-backdrop-enter-from,
.modal-backdrop-leave-to {
  opacity: 0;
}
</style>
