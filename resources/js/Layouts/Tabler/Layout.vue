<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import { Link } from '@inertiajs/inertia-vue3'
import { useDark, useToggle } from '@vueuse/core'
import Navigation from '@/Layouts/Tabler/Partials/Navigation.vue'

const isDark = useDark()
const toggleDark = useToggle(isDark)
</script>
<template>
  <div class="page">
    <div class="sticky-top">
      <header
        class="navbar navbar-expand-md navbar-light sticky-top d-print-none"
      >
        <div class="container-xl">
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbar-menu"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1
            class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3"
          >
            <Link :href="route('landing')">
              <ApplicationLogo
                class="_block _h-9 _w-auto _fill-current _text-gray-800"
              />
            </Link>
          </h1>
          <div
            v-if="$page.props.auth.user !== null"
            class="navbar-nav flex-row order-md-last"
          >
            <div class="nav-item dropdown">
              <a
                href="#"
                class="nav-link d-flex lh-1 text-reset p-0"
                data-bs-toggle="dropdown"
                aria-label="Open user menu"
              >
                <span
                  class="avatar avatar-sm"
                  :style="{
                    'background-image': `url(https://eu.ui-avatars.com/api/?name=${$page.props.auth.user.name}`,
                  }"
                >
                </span>
                <div class="d-none d-xl-block ps-2">
                  {{ $page.props.auth.user.name }}
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a
                  href="{{--{{ route('profile.show') }}--}}"
                  class="dropdown-item"
                  >{{ __('Profile') }}</a
                >
                <div class="dropdown-divider"></div>
                <Link
                  href="route('logout')"
                  method="post"
                  as="button"
                  class="dropdown-item"
                  >{{ __('Log Out') }}
                </Link>
              </div>
            </div>
          </div>
        </div>
      </header>

      <Navigation />
    </div>
    <div class="page-wrapper">
      <slot />

      <footer class="footer footer-transparent d-print-none">
        <div class="container-xl">
          <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-lg-auto ms-lg-auto">
              <ul class="list-inline list-inline-dots mb-0">
                <li class="list-inline-item">
                  <a
                    href="https://preview.tabler.io"
                    target="_blank"
                    class="link-secondary"
                    rel="noopener"
                    >Tabler Demo</a
                  >
                </li>
                <li class="list-inline-item">
                  <a
                    href="https://preview.tabler.io/docs/index.html"
                    target="_blank"
                    class="link-secondary"
                    rel="noopener"
                    >Tabler Doc.</a
                  >
                </li>
                <li class="list-inline-item">
                  <a
                    href="https://preview.tabler.io/license.html"
                    target="_blank"
                    class="link-secondary"
                    rel="noopener"
                    >Tabler License</a
                  >
                </li>
                <li class="list-inline-item">
                  <a
                    href="https://github.com/tabler/tabler"
                    target="_blank"
                    class="link-secondary"
                    rel="noopener"
                    >Tabler Source code</a
                  >
                </li>
                <li class="list-inline-item">
                  <a
                    href="https://github.com/sponsors/codecalm"
                    target="_blank"
                    class="link-secondary"
                    rel="noopener"
                  >
                    <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="icon text-pink icon-filled icon-inline"
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
                      <path
                        d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"
                      />
                    </svg>
                    Sponsor
                  </a>
                </li>
              </ul>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
              <ul class="list-inline list-inline-dots mb-0">
                <li class="list-inline-item">
                  &copy; 2022
                  <a href="https://logo.corean.io" class="link-secondary"
                    >logo.corean.io</a
                  >
                </li>
                <li class="list-inline-item">Version 1.0.0</li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
</template>
