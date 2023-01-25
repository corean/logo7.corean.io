<script setup>
import GuestLayout from '@/Layouts/Default/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, useForm } from '@inertiajs/vue3'

defineProps({
  status: String,
})

const form = useForm({
  email: '',
})

const submit = () => {
  form.post(route('password.email'))
}
</script>

<template>
  <GuestLayout>
    <Head title="비밀번호 재설정" />

    <div class="_mb-4 _text-sm _text-gray-600">
      비밀번호를 잊어 버렸습니까? <br />
      이메일 주소를 알려주시면 새 비밀번호으로 변경할 수 있는 비밀번호 재설정
      링크를 이메일로 보내드립니다.
    </div>

    <div v-if="status" class="_mb-4 _text-sm _font-medium _text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <div>
        <InputLabel for="email" value="E-mail" />

        <TextInput
          id="email"
          type="email"
          class="_mt-1 _block _w-full"
          v-model="form.email"
          required
          autofocus
          autocomplete="username"
        />

        <InputError class="_mt-2" :message="form.errors.email" />
      </div>

      <div class="_mt-4 _flex _items-center _justify-end">
        <PrimaryButton
          :class="{ '_opacity-25': form.processing }"
          :disabled="form.processing"
        >
          비밀번호 재설정 이메일 요청
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
