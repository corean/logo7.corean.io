<script setup>
import { ref } from 'vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import { Link } from '@inertiajs/inertia-vue3'
import UserMenu from '@/Layouts/Default/Partials/UserMenu.vue'
import NavMenu from '@/Layouts/Default/Partials/NavMenu.vue'
import { useDark, useToggle } from '@vueuse/core'

const showingNavigationDropdown = ref(false)
const isDark = useDark()
const toggleDark = useToggle(isDark)
</script>

<template>
  <div>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
      <nav
        class="border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-900"
      >
        <!-- Primary Navigation Menu -->
        <div
          class="mx-auto max-w-7xl border-b border-gray-200 px-4 dark:border-gray-700 dark:bg-gray-800 sm:px-6 lg:px-8"
        >
          <div class="flex h-14 justify-between">
            <div class="flex">
              <!-- Logo -->
              <div class="flex shrink-0 items-center">
                <Link :href="route('dashboard')">
                  <ApplicationLogo
                    class="block h-9 w-auto fill-current text-gray-800"
                  />
                </Link>
              </div>
            </div>

            <div class="flex items-center">
              <button
                @click="toggleDark()"
                type="button"
                class="inline-flex items-center rounded-lg p-2.5 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
              >
                <svg
                  v-if="isDark"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  aria-hidden="true"
                  class="h-5 w-5"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                    clip-rule="evenodd"
                  ></path>
                </svg>

                <svg
                  v-else
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  aria-hidden="true"
                  class="h-5 w-5"
                >
                  <path
                    d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                  ></path>
                </svg>
                <!-- dark mode button -->
              </button>
              <UserMenu />
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
              <button
                @click="showingNavigationDropdown = !showingNavigationDropdown"
                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
              >
                <svg
                  class="h-6 w-6"
                  stroke="currentColor"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <path
                    :class="{
                      hidden: showingNavigationDropdown,
                      'inline-flex': !showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                  />
                  <path
                    :class="{
                      hidden: !showingNavigationDropdown,
                      'inline-flex': showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>
        <!-- Navigation Links -->
        <NavMenu />

        <!-- Responsive Navigation Menu -->
        <div
          v-if="$page.props.auth.user !== null"
          :class="{
            block: showingNavigationDropdown,
            hidden: !showingNavigationDropdown,
          }"
          class="sm:hidden"
        >
          <div class="space-y-1 pt-2 pb-3">
            <ResponsiveNavLink
              :href="route('dashboard')"
              :active="route().current('dashboard')"
            >
              Dashboard
            </ResponsiveNavLink>
          </div>

          <!-- Responsive Settings Options -->
          <div>
            <div class="border-t border-gray-200 pt-4 pb-1">
              <div class="px-4">
                <div class="text-base font-medium text-gray-800">
                  {{ $page.props.auth.user.name }}
                </div>
                <div class="text-sm font-medium text-gray-500">
                  {{ $page.props.auth.user.email }}
                </div>
              </div>

              <div class="mt-3 space-y-1">
                <ResponsiveNavLink :href="route('profile.edit')">
                  Profile
                </ResponsiveNavLink>
                <ResponsiveNavLink
                  :href="route('logout')"
                  method="post"
                  as="button"
                >
                  Log Out
                </ResponsiveNavLink>
              </div>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Heading -->
      <header class="bg-white shadow" v-if="$slots.header">
        <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header" />
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <slot />
      </main>
    </div>
  </div>
</template>
