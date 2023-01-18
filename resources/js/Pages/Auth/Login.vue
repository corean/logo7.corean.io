<script setup>
import Checkbox from '@/Components/Checkbox.vue'
import GuestLayout from '@/Layouts/Default/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

defineProps({
  canResetPassword: Boolean,
  status: String,
})

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  })
}
</script>

<template>
  <GuestLayout>
    <Head :title="__('Log in')" />

    <div v-if="status" class="_mb-4 _text-sm _font-medium _text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <div>
        <InputLabel for="email" :value="__('username or email')" />
        <TextInput
          id="email"
          type="text"
          class="_mt-1 _block _w-full"
          v-model="form.email"
          required
          autofocus
          autocomplete="email"
        />
        <InputError class="_mt-2" :message="form.errors.email" />
      </div>

      <div class="mt-4">
        <InputLabel for="password" :value="__('Password')" />
        <TextInput
          id="password"
          type="password"
          class="_mt-1 _block _w-full"
          v-model="form.password"
          required
          autocomplete="current-password"
        />
        <InputError class="_mt-2" :message="form.errors.password" />
      </div>

      <div class="_mt-4 _block">
        <label class="_flex _items-center">
          <Checkbox name="remember" v-model:checked="form.remember" />
          <span class="_ml-2 _text-sm _text-gray-600">
            {{ __('Remember me') }}
          </span>
        </label>
      </div>

      <div class="_mt-4 _flex _items-center _justify-end">
        <Link
          v-if="canResetPassword"
          :href="route('password.request')"
          class="_rounded-md _text-sm _text-gray-600 _underline hover:_text-gray-900 focus:_outline-none focus:_ring-2 focus:_ring-indigo-500 focus:_ring-offset-2"
        >
          {{ __('Forgot your password?') }}
        </Link>

        <PrimaryButton
          class="_ml-4"
          :class="{ '_opacity-25': form.processing }"
          :disabled="form.processing"
        >
          {{ __('Log in') }}
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
