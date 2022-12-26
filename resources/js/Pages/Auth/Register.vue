<script setup>
import GuestLayout from '@/Layouts/Default/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'

const form = useForm({
  username: '',
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  terms: false,
})

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  })
}
</script>

<template>
  <GuestLayout>
    <Head :title="__('Register')" />

    <form @submit.prevent="submit">
      <div>
        <InputLabel for="username" :value="__('Username')" />

        <TextInput
          id="username"
          type="text"
          class="_mt-1 _block _w-full"
          v-model="form.username"
          required
          autofocus
          autocomplete="username"
        />

        <InputError class="_mt-2" :message="form.errors.username" />
      </div>

      <div class="mt-4">
        <InputLabel for="name" :value="__('Name')" />

        <TextInput
          id="name"
          type="text"
          class="_mt-1 _block _w-full"
          v-model="form.name"
          required
          autofocus
          autocomplete="name"
        />

        <InputError class="mt-2" :message="form.errors.name" />
      </div>

      <div class="_mt-4">
        <InputLabel for="email" :value="__('Email')" />

        <TextInput
          id="email"
          type="email"
          class="_mt-1 _block _w-full"
          v-model="form.email"
          required
          autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="_mt-4">
        <InputLabel for="password" :value="__('Password')" />

        <TextInput
          id="password"
          type="password"
          class="_mt-1 _block _w-full"
          v-model="form.password"
          required
          autocomplete="new-password"
        />

        <InputError class="_mt-2" :message="form.errors.password" />
      </div>

      <div class="_mt-4">
        <InputLabel
          for="password_confirmation"
          :value="__('Confirm Password')"
        />

        <TextInput
          id="password_confirmation"
          type="password"
          class="_mt-1 _block _w-full"
          v-model="form.password_confirmation"
          required
          autocomplete="new-password"
        />

        <InputError
          class="_mt-2"
          :message="form.errors.password_confirmation"
        />
      </div>

      <div class="_mt-4 _flex _items-center _justify-end">
        <Link
          :href="route('login')"
          class="_rounded-md _text-sm _text-gray-600 _underline hover:_text-gray-900 focus:_outline-none focus:_ring-2 focus:_ring-indigo-500 focus:_ring-offset-2"
        >
          {{ __('Already registered?') }}
        </Link>

        <PrimaryButton
          class="_ml-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          {{ __('Register') }}
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
