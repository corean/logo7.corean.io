<script setup>
import Layout from '@/Layouts/Tabler/Layout.vue'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'
import Pagination from '@/Components/Pagination.vue'
import { numberFormat } from '@/helpers/filter'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
  title: {
    type: String,
    default: '연간회원',
  },
  memberships: Object,
  search: {
    type: String,
    default: '',
  },
})

const form = useForm({
  search: props.search,
})
const deleteMembership = (id) => {
  console.warn('deleteMembership()', id)
  if (confirm('삭제하시겠습니까?')) {
    Inertia.delete(route('admin.memberships.destroy', id), {
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => {
        toast.success('삭제되었습니다.')
      },
    })
  }
}
const cancelConfirmed = (id) => {
  console.warn('cancelConfirmed()', id)
  if (confirm('입금확인를 취소하시겠습니까??')) {
    Inertia.put(route('admin.memberships.confirm-cancel', id), {
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => {
        toast.success('취소되었습니다.')
      },
    })
  }
}
</script>

<template>
  <Head :title="props.title" />

  <Layout>
    <div class="container-xl pt-4">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">연간회원</h3>

              <div class="ms-auto text-muted">
                <form
                  @submit.prevent="form.get(route('admin.memberships.index'))"
                >
                  <div class="d-none d-md-block">
                    <div class="input-icon">
                      <span class="input-icon-addon">
                        <!-- Download SVG icon from https://tabler-icons.io/i/search -->
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="icon icon-tabler icon-tabler-search"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          stroke-width="1.5"
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
                          <circle cx="10" cy="10" r="7"></circle>
                          <line x1="21" y1="21" x2="15" y2="15"></line>
                        </svg>
                      </span>
                      <input
                        type="text"
                        v-model="form.search"
                        class="form-control"
                        placeholder="Search…"
                      />
                    </div>
                  </div>
                </form>
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
                      <i class="icon icon-sm icon-thick ti ti-chevron-down" />
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
                  <tr
                    v-for="membership in memberships.data"
                    key="membership.no"
                  >
                    <td>
                      <Link
                        :href="route('admin.memberships.edit', membership.no)"
                        >{{ membership.no }}
                      </Link>
                    </td>
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
                    <td>
                      <a :href="`sms:${membership.mobile}`">{{
                        membership.mobile
                      }}</a>
                    </td>
                    <td>{{ membership.diffForHumans }}</td>
                    <td class="text-end w-4">
                      {{ membership.completedCount }}
                    </td>
                    <td class="text-end">
                      <div
                        v-if="membership.confirmed_at"
                        class="btn-list flex-nowrap"
                      >
                        <button
                          type="button"
                          class="btn btn-outline"
                          @click="cancelConfirmed(membership.no)"
                        >
                          <i
                            class="icon ti ti-arrow-back-up text-red"
                          />입금취소
                        </button>
                      </div>
                      <div v-else class="btn-list flex-nowrap">
                        <Link
                          method="put"
                          as="button"
                          :href="
                            route('admin.memberships.confirm', membership.no)
                          "
                          class="btn btn-outline"
                        >
                          <i class="icon ti ti-check text-success" />입금확인
                        </Link>
                        <button
                          type="button"
                          class="btn btn-outline"
                          @click="deleteMembership(membership.no)"
                        >
                          <i class="icon ti ti-x text-danger" />{{ __('삭제') }}
                        </button>
                        <!--
                                            <div class="dropdown">
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
                                            </div>
                                            -->
                      </div>
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

              <Pagination
                v-if="memberships.meta.last_page > 1"
                :data="memberships.meta"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>
