<script setup>
import Layout from '@/Layouts/Default/Layout.vue'
import { Head } from '@inertiajs/inertia-vue3'
import Pagination from '@/Components/Pagination.vue'

defineProps({
  memberships: Object,
})
</script>

<template>
  <Head title="연간회원" />

  <Layout>
    <div class="py-12 text-slate-800">
      <!--
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">Membership/Index</div>
          <ul>
            <li v-for="membership in memberships.data" key="membership.no">
              {{ membership.chargename }}
            </li>
          </ul>
        </div>
      </div>
      -->

      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <table
            class="w-full text-left text-sm text-gray-800 dark:text-gray-400"
          >
            <thead
              class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400"
            >
              <tr>
                <th scope="col" class="py-3 px-6">no</th>
                <th scope="col" class="py-3">아이디</th>
                <th scope="col" class="py-3">등급</th>
                <th scope="col" class="py-3">입금자</th>
                <th scope="col" class="py-3">휴대폰</th>
                <th scope="col" class="py-3">거래시간</th>
                <th scope="col" class="py-3">횟수</th>
                <th scope="col" class="py-3">ACTION</th>
              </tr>
            </thead>
            <tbody>
              <tr
                class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600"
                v-for="membership in memberships.data"
                key="membership.no"
              >
                <td class="w-1 p-4">{{ membership.no }}</td>
                <td class="py-4">{{ membership.id }}</td>
                <td class="py-4">{{ membership.grade }}</td>
                <td class="py-4">
                  <strong v-if="membership.confirm">
                    {{ membership.charge_name }}
                  </strong>
                  <span v-else>
                    {{ membership.charge_name }}
                  </span>
                </td>
                <td class="py-4">{{ membership.mobile }}</td>
                <td class="py-4">{{ membership.diffForHumans }}</td>
                <td class="py-4">{{ membership.completedCount }}</td>
                <td class="py-4">Edit Delete 입금확인</td>
              </tr>
            </tbody>
          </table>
          <div class="p-3">
            <Pagination :data="memberships.meta" />
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>
