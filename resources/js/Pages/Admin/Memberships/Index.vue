<script setup>
import Layout from '@/Layouts/Layout.vue'
import { Head } from '@inertiajs/inertia-vue3'

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
          <div
            class="flex items-center justify-between bg-gray-200 p-4 dark:bg-gray-800"
          >
            <div>
              <button
                id="dropdownRadioButton"
                data-dropdown-toggle="dropdownRadio"
                class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm font-medium text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:hover:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                type="button"
              >
                <svg
                  class="mr-2 h-4 w-4 text-gray-400"
                  aria-hidden="true"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                Last 30 days
                <svg
                  class="ml-2 h-3 w-3"
                  aria-hidden="true"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 9l-7 7-7-7"
                  ></path>
                </svg>
              </button>
              <!-- Dropdown menu -->
              <div
                id="dropdownRadio"
                class="z-10 hidden w-48 divide-y divide-gray-100 rounded bg-white shadow dark:divide-gray-600 dark:bg-gray-700"
                data-popper-reference-hidden=""
                data-popper-escaped=""
                data-popper-placement="top"
                style="
                  position: absolute;
                  inset: auto auto 0px 0px;
                  margin: 0px;
                  transform: translate3d(522.5px, 3847.5px, 0px);
                "
              >
                <ul
                  class="space-y-1 p-3 text-sm text-gray-700 dark:text-gray-200"
                  aria-labelledby="dropdownRadioButton"
                >
                  <li>
                    <div
                      class="flex items-center rounded p-2 hover:bg-gray-100 dark:hover:bg-gray-600"
                    >
                      <input
                        id="filter-radio-example-1"
                        type="radio"
                        value=""
                        name="filter-radio"
                        class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"
                      />
                      <label
                        for="filter-radio-example-1"
                        class="ml-2 w-full rounded text-sm font-medium text-gray-900 dark:text-gray-300"
                        >Last day</label
                      >
                    </div>
                  </li>
                  <li>
                    <div
                      class="flex items-center rounded p-2 hover:bg-gray-100 dark:hover:bg-gray-600"
                    >
                      <input
                        checked=""
                        id="filter-radio-example-2"
                        type="radio"
                        value=""
                        name="filter-radio"
                        class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"
                      />
                      <label
                        for="filter-radio-example-2"
                        class="ml-2 w-full rounded text-sm font-medium text-gray-900 dark:text-gray-300"
                        >Last 7 days</label
                      >
                    </div>
                  </li>
                  <li>
                    <div
                      class="flex items-center rounded p-2 hover:bg-gray-100 dark:hover:bg-gray-600"
                    >
                      <input
                        id="filter-radio-example-3"
                        type="radio"
                        value=""
                        name="filter-radio"
                        class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"
                      />
                      <label
                        for="filter-radio-example-3"
                        class="ml-2 w-full rounded text-sm font-medium text-gray-900 dark:text-gray-300"
                        >Last 30 days</label
                      >
                    </div>
                  </li>
                  <li>
                    <div
                      class="flex items-center rounded p-2 hover:bg-gray-100 dark:hover:bg-gray-600"
                    >
                      <input
                        id="filter-radio-example-4"
                        type="radio"
                        value=""
                        name="filter-radio"
                        class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"
                      />
                      <label
                        for="filter-radio-example-4"
                        class="ml-2 w-full rounded text-sm font-medium text-gray-900 dark:text-gray-300"
                        >Last month</label
                      >
                    </div>
                  </li>
                  <li>
                    <div
                      class="flex items-center rounded p-2 hover:bg-gray-100 dark:hover:bg-gray-600"
                    >
                      <input
                        id="filter-radio-example-5"
                        type="radio"
                        value=""
                        name="filter-radio"
                        class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"
                      />
                      <label
                        for="filter-radio-example-5"
                        class="ml-2 w-full rounded text-sm font-medium text-gray-900 dark:text-gray-300"
                        >Last year</label
                      >
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
              <div
                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
              >
                <svg
                  class="h-5 w-5 text-gray-500 dark:text-gray-400"
                  aria-hidden="true"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </div>
              <input
                type="text"
                id="table-search"
                class="block w-80 rounded-lg border border-gray-300 bg-gray-50 p-2 pl-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                placeholder="Search for items"
              />
            </div>
          </div>

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
        </div>
      </div>
    </div>
  </Layout>
</template>
