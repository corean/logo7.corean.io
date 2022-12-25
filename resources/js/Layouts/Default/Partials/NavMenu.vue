<script setup>
import NavLink from '@/Components/NavLink.vue'
</script>
<template>
  <div class="mx-auto max-w-7xl bg-white px-4 dark:bg-gray-800 sm:px-6 lg:px-8">
    <div class="flex h-14 justify-between">
      <div class="hidden space-x-8 sm:-my-px sm:flex">
        <NavLink :href="route('home')" :active="route().current('home')">
          Home
        </NavLink>
        <NavLink
          :href="route('dashboard')"
          :active="route().current('dashboard')"
        >
          Dashboard
        </NavLink>
        <NavLink
          :href="route('admin.memberships.index')"
          :active="route().current('admin.memberships.index')"
        >
          연간회원
        </NavLink>
      </div>
    </div>
  </div>
</template>
