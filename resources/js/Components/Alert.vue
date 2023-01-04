<script setup>
const props = defineProps({
  flash: {
    type: Object,
    default: () => {
      return {}
    },
  },
})
</script>

<template>
  <Transition name="alert" appear>
    <div
      v-if="props.flash.success"
      class="alert alert-important alert-success alert-dismissible"
      role="alert"
    >
      <div class="d-flex">
        <div>
          <!-- Download SVG icon from http://tabler-icons.io/i/check -->
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="icon alert-icon"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="currentColor"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M5 12l5 5l10 -10" />
          </svg>
        </div>
        <div>
          {{ props.flash.success }}
        </div>
      </div>
      <a
        class="btn-close btn-close-white"
        data-bs-dismiss="alert"
        aria-label="close"
      ></a>
    </div>
  </Transition>
</template>

<style scoped>
.alert-enter-active,
.alert-leave-active {
  transition: opacity 1s ease;
}

.alert-enter-from,
.alert-leave-to {
  opacity: 0;
}
</style>
