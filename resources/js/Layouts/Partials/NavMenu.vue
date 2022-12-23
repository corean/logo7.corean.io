<script setup>
import NavLink from '@/Components/NavLink.vue'
</script>
<template>
  <div class="hidden space-x-8 sm:-my-px sm:flex">
    <NavLink :href="route('home')" :active="route().current('home')">
      Home
    </NavLink>
    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
      Dashboard
    </NavLink>
    <NavLink
      :href="route('admin.memberships.index')"
      :active="route().current('admin.memberships.index')"
    >
      연간회원
    </NavLink>
  </div>
</template>
