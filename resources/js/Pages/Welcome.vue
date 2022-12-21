<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3'

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
})
</script>

<template>
  <Head title="Welcome" />

  <div
    class="items-top relative flex min-h-screen justify-center bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0"
  >
    <div v-if="canLogin" class="fixed top-0 right-0 hidden px-6 py-4 sm:block">
      <Link
        v-if="$page.props.auth.user"
        :href="route('c')"
        class="text-sm text-gray-700 dark:text-gray-500"
        >Dashboard
      </Link>

      <template v-else>
        <Link
          :href="route('login')"
          class="text-sm text-gray-700 dark:text-gray-500"
          >{{ __('Log in') }}
        </Link>

        <Link
          v-if="canRegister"
          :href="route('register')"
          class="ml-4 text-sm text-gray-700 dark:text-gray-500"
          >{{ __('Register') }}
        </Link>
      </template>
    </div>

    <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
      <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
        <svg
          viewBox="0 0 119 71"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
          class="ml-2 h-16 w-auto text-gray-700 sm:h-20"
        >
          <g>
            <polygon
              class="cls-1"
              points="31.82 30.79 41.2 24.61 41.2 35.69 31.82 41.87 31.82 30.79"
            />
            <polygon
              class="cls-2"
              points="11.36 33.95 20.74 27.77 31.82 30.74 22.44 36.91 11.36 33.95"
            />
            <polygon
              class="cls-3"
              points="11.36 22.86 20.74 16.69 20.74 27.77 11.36 33.95 11.36 22.86"
            />
            <polygon
              class="cls-3"
              points="22.44 36.91 31.82 30.74 31.82 41.82 22.44 47.99 22.44 36.91"
            />
            <polygon
              class="cls-2"
              points="0.28 8.82 9.66 2.64 20.74 5.61 11.36 11.79 0.28 8.82"
            />
            <polygon
              class="cls-3"
              points="11.36 11.79 20.74 5.61 20.74 16.69 11.36 22.86 11.36 11.79"
            />
            <polygon
              class="cls-1"
              points="0.28 8.82 11.36 11.79 11.36 22.86 0.28 19.9 0.28 8.82"
            />
            <polygon
              class="cls-1"
              points="0.28 19.9 11.36 22.86 11.36 33.95 0.28 30.98 0.28 19.9"
            />
            <polygon
              class="cls-1"
              points="0.28 30.98 11.36 33.95 11.36 45.02 0.28 42.06 0.28 30.98"
            />
            <polygon
              class="cls-1"
              points="11.36 33.95 22.44 36.91 22.44 47.99 11.36 45.02 11.36 33.95"
            />
            <polygon
              class="cls-4"
              points="42.9 44.84 52.28 38.66 63.36 41.63 53.98 47.8 42.9 44.84"
            />
            <polygon
              class="cls-5"
              points="42.9 33.76 52.28 27.58 52.28 38.66 42.9 44.84 42.9 33.76"
            />
            <polygon
              class="cls-5"
              points="53.96 47.77 63.35 41.6 63.35 52.68 53.96 58.85 53.96 47.77"
            />
            <polygon
              class="cls-4"
              points="31.8 30.76 41.19 24.58 52.27 27.55 42.88 33.73 31.8 30.76"
            />
            <polygon
              class="cls-4"
              points="53.98 36.72 63.36 30.55 74.44 33.52 65.06 39.69 53.98 36.72"
            />
            <polygon
              class="cls-5"
              points="65.06 39.69 74.44 33.52 74.44 44.6 65.06 50.77 65.06 39.69"
            />
            <polygon
              class="cls-4"
              points="42.9 22.68 52.28 16.5 63.36 19.47 53.98 25.64 42.9 22.68"
            />
            <polygon
              class="cls-5"
              points="53.98 25.64 63.36 19.47 63.36 30.55 53.98 36.72 53.98 25.64"
            />
            <polygon
              class="cls-6"
              points="31.82 30.79 42.9 33.76 42.9 44.84 31.82 41.87 31.82 30.79"
            />
            <polygon
              class="cls-6"
              points="42.9 22.68 53.98 25.64 53.98 36.72 42.9 33.76 42.9 22.68"
            />
            <polygon
              class="cls-6"
              points="42.9 44.84 53.98 47.8 53.98 58.88 42.9 55.91 42.9 44.84"
            />
            <polygon
              class="cls-6"
              points="53.98 36.72 65.06 39.69 65.06 50.77 53.98 47.8 53.98 36.72"
            />
            <polygon
              class="cls-7"
              points="98.3 59.68 107.68 53.5 107.68 64.58 98.3 70.76 98.3 59.68"
            />
            <polygon
              class="cls-8"
              points="76.14 42.66 85.52 36.48 96.6 39.45 87.22 45.63 76.14 42.66"
            />
            <polygon
              class="cls-8"
              points="87.22 56.71 96.6 50.53 107.68 53.5 98.3 59.68 87.22 56.71"
            />
            <polygon
              class="cls-9"
              points="87.22 45.63 96.6 39.45 96.6 50.53 87.22 56.71 87.22 45.63"
            />
            <polygon
              class="cls-10"
              points="98.3 48.6 107.68 42.42 118.76 45.39 109.38 51.57 98.3 48.6"
            />
            <polygon
              class="cls-9"
              points="109.38 51.57 118.76 45.39 118.76 56.47 109.38 62.65 109.38 51.57"
            />
            <polygon
              class="cls-8"
              points="87.22 34.55 96.6 28.37 107.68 31.34 98.3 37.52 87.22 34.55"
            />
            <polygon
              class="cls-7"
              points="98.3 37.52 107.68 31.34 107.68 42.42 98.3 48.6 98.3 37.52"
            />
            <polygon
              class="cls-11"
              points="76.14 42.66 87.22 45.63 87.22 56.71 76.14 53.74 76.14 42.66"
            />
            <polygon
              class="cls-11"
              points="87.22 34.55 98.3 37.52 98.3 48.6 87.22 45.63 87.22 34.55"
            />
            <polygon
              class="cls-11"
              points="87.22 56.71 98.3 59.68 98.3 70.76 87.22 67.79 87.22 56.71"
            />
            <polygon
              class="cls-12"
              points="98.3 48.6 109.38 51.57 109.38 62.65 98.3 59.68 98.3 48.6"
            />
            <polygon
              class="cls-13"
              points="76.14 31.58 85.52 25.41 85.52 36.48 76.14 42.66 76.14 31.58"
            />
            <polygon
              class="cls-14"
              points="53.98 14.56 63.36 8.39 74.44 11.36 65.06 17.53 53.98 14.56"
            />
            <polygon
              class="cls-14"
              points="76.14 20.5 85.52 14.33 96.6 17.3 87.22 23.47 76.14 20.5"
            />
            <polygon
              class="cls-13"
              points="87.22 23.47 96.6 17.3 96.6 28.37 87.22 34.55 87.22 23.47"
            />
            <polygon
              class="cls-14"
              points="65.06 6.45 74.44 0.28 85.52 3.25 76.14 9.42 65.06 6.45"
            />
            <polygon
              class="cls-13"
              points="76.14 9.42 85.52 3.25 85.52 14.33 76.14 20.5 76.14 9.42"
            />
            <polygon
              class="cls-15"
              points="53.98 14.56 65.06 17.53 65.06 28.61 53.98 25.64 53.98 14.56"
            />
            <polygon
              class="cls-15"
              points="65.06 6.45 76.14 9.42 76.14 20.5 65.06 17.53 65.06 6.45"
            />
            <polygon
              class="cls-15"
              points="65.06 28.61 76.14 31.58 76.14 42.66 65.06 39.69 65.06 28.61"
            />
            <polygon
              class="cls-15"
              points="76.14 20.5 87.22 23.47 87.22 34.55 76.14 31.58 76.14 20.5"
            />
            <polygon
              class="cls-15"
              points="65.06 17.53 76.14 20.5 76.14 31.58 65.06 28.61 65.06 17.53"
            />
          </g>
        </svg>
      </div>

      <div
        class="mt-8 overflow-hidden bg-white shadow dark:bg-gray-800 sm:rounded-lg"
      >
        <div class="grid grid-cols-1 md:grid-cols-2">
          <div class="p-6">
            <div class="flex items-center">
              <svg
                fill="none"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                viewBox="0 0 24 24"
                class="h-8 w-8 text-gray-500"
              >
                <path
                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                ></path>
              </svg>
              <div class="ml-4 text-lg font-semibold leading-7">
                <a
                  href="http://logo.corean.biz"
                  class="text-gray-900 underline dark:text-white"
                  >logo.corean.biz</a
                >
              </div>
            </div>

            <div class="ml-12">
              <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                현재 리뉴얼을 위해 열심히 작업 중입니다.
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-4 flex justify-center sm:items-center sm:justify-between">
        <div
          class="ml-4 text-center text-sm text-gray-500 sm:ml-0 sm:text-right"
        >
          Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.cls-1 {
  fill: #009de1;
}
.cls-1,
.cls-10,
.cls-11,
.cls-12,
.cls-13,
.cls-14,
.cls-15,
.cls-2,
.cls-3,
.cls-4,
.cls-5,
.cls-6,
.cls-7,
.cls-8,
.cls-9 {
  stroke: #fff;
  stroke-opacity: 0.5;
  stroke-linecap: round;
  stroke-linejoin: round;
  fill-rule: evenodd;
  stroke-width: 1;
}
.cls-2 {
  fill: #9fd9f6;
}
.cls-3 {
  fill: #00499f;
}
.cls-4 {
  fill: #f7c8d3;
}
.cls-5 {
  fill: #e5004b;
}
.cls-6 {
  fill: #e63082;
}
.cls-7,
.cls-9 {
  fill: #231815;
}
.cls-10,
.cls-8 {
  fill: #c9caca;
}
.cls-11,
.cls-12 {
  fill: #727171;
}
.cls-13 {
  fill: #f08300;
}
.cls-14 {
  fill: #fffaba;
}
.cls-15 {
  fill: #ffe200;
}
</style>
