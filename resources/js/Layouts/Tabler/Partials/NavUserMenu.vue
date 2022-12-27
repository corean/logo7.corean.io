<template>
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
      <a href="{{--{{ route('profile.show') }}--}}" class="dropdown-item">{{
        __('Profile')
      }}</a>
      <div class="dropdown-divider"></div>
      <Link
        :href="route('logout')"
        method="post"
        as="button"
        class="dropdown-item"
        >{{ __('Log Out') }}
      </Link>
    </div>
  </div>
</template>
