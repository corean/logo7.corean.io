<script setup>
import Layout from '@/Layouts/Tabler/Layout.vue'
import { Head } from '@inertiajs/inertia-vue3'
import Pagination from '@/Components/Pagination.vue'
import { numberFormat} from '@/helpers/filter'

defineProps({
  memberships: Object,
})

</script>

<template>
  <Head title="연간회원" />

  <Layout>
    <div class="container-xl pt-4">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">연간회원</h3>

                <div class="ms-auto text-muted">
                Search:
                <div class="ms-2 d-inline-block">
                    <input
                        type="text"
                        class="form-control form-control-sm"
                        aria-label="Search invoice"
                    />
                </div>
            </div>
            </div>
            <div class="table-responsive">
              <table
                class="table card-table table-vcenter text-nowrap datatable"
              >
                <thead>
                  <tr>
                    <th class="w-1">
                      No.
                      <!-- Download SVG icon from http://tabler-icons.io/i/chevron-down -->
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-sm icon-thick"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path
                          stroke="none"
                          d="M0 0h24v24H0z"
                          fill="none"
                        ></path>
                        <polyline points="6 9 12 15 18 9"></polyline>
                      </svg>
                    </th>
                    <th scope="col">아이디</th>
                    <th scope="col">등급</th>
                    <th scope="col">입금자</th>
                    <th scope="col">휴대폰</th>
                    <th scope="col">거래시간</th>
                    <th scope="col">횟수</th>
                    <th scope="col" class="w-1"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="membership in memberships.data" key="membership.no">
                    <td>{{ membership.no }}</td>
                    <td>{{ membership.id }}</td>
                    <td>{{ membership.grade }}</td>
                    <td>
                      <strong v-if="membership.confirm">
                        {{ membership.charge_name }}
                      </strong>
                      <span v-else>
                        {{ membership.charge_name }}
                      </span>
                    </td>
                    <td>{{ membership.mobile }}</td>
                    <td>{{ membership.diffForHumans }}</td>
                    <td class='text-end w-4'>{{ membership.completedCount }}</td>
                    <td class="text-end">
                      <span class="dropdown">
                        <button
                          class="btn dropdown-toggle align-text-top"
                          data-bs-boundary="viewport"
                          data-bs-toggle="dropdown"
                        >
                          Actions
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a class="dropdown-item" href="#"> Action </a>
                          <a class="dropdown-item" href="#"> Another </a>
                        </div>
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="card-footer d-flex align-items-center">
              <p class="m-0 text-muted">
                <span>{{ numberFormat(memberships.meta.total) }}</span
                >항목 중 <span>{{ numberFormat(memberships.meta.from) }}</span
                >에서 <span>{{ numberFormat(memberships.meta.to) }}</span
                >까지
              </p>

              <Pagination :data="memberships.meta" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>
