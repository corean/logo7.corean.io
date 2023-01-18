<script setup>
import { computed } from 'vue'
import { Head, Link, router, useForm } from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination.vue'
import Alert from '@/Components/Alert.vue'
import { numberFormat } from '@/helpers/filter'
import Layout from '@/Layouts/Tabler/Layout.vue'
import MembershipEdit from '@/Pages/Admin/Memberships/MembershipEdit.vue'

const props = defineProps({
  title: {
    type: String,
    default: '연간회원',
  },
  memberships: Object,
  membership: Object,
  form: Object,
})

const form = useForm({
  keyword: props.form.keyword,
})

// 페이지 이동시 쿼리 스트링 유지
const query = computed(() => {
  const queryString = {}
  if (form.keyword) {
    queryString.keyword = form.keyword
  }
  if (props.memberships.meta.current_page > 1) {
    queryString.page = props.memberships.meta.current_page
  }
  return queryString
})

const deleteMembership = (id, name) => {
  // console.warn('deleteMembership()', id)
  if (confirm(`[${name}] 정말 삭제하시겠습니까?`)) {
    router.delete(route('admin.memberships.destroy', id))
  }
}
const cancelConfirmed = (id, name) => {
  // console.warn('cancelConfirmed()', id)
  if (confirm(`[${name}] 입금확인를 취소하시겠습니까?`)) {
    router.put(route('admin.memberships.confirm-cancel', id))
  }
}

const confirmMembership = (id, name) => {
  // console.warn('cancelConfirmed()', id)
  if (confirm(`[${name}] 입금처리하시겠습니까?`)) {
    router.put(route('admin.memberships.confirm', id))
  }
}
</script>

<template>
  <Head :title="props.title" />

  <MembershipEdit
    v-if="!!membership"
    :membership="membership"
    :query-string="query"
  />
  <!--<Modal
      :show="showModal"
      max-width="2xl"
      :closeable="true"
      @close="closeModal"
    >
      <div class="p-3">Test</div>
    </Modal>-->

  <Layout>
    <div class="container-xl pt-4">
      <Alert />

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
                        v-model="form.keyword"
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
                        :href="
                          route(
                            'admin.memberships.index',
                            { membership: membership.no, _query: query },
                            { preserveState: true, replace: true }
                          )
                        "
                        >{{ membership.no }}
                      </Link>
                    </td>
                    <td>{{ membership.id }}</td>
                    <td>{{ membership.grade }}</td>
                    <td>
                      <strong v-if="membership.confirm">
                        {{ membership.chargename }}
                      </strong>
                      <span v-else>
                        {{ membership.chargename }}
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
                          @click="
                            cancelConfirmed(
                              membership.no,
                              membership.chargename
                            )
                          "
                        >
                          <i
                            class="icon ti ti-arrow-back-up text-red"
                          />입금취소
                        </button>
                      </div>
                      <div v-else class="btn-list flex-nowrap">
                        <button
                          type="button"
                          class="btn btn-outline"
                          @click="
                            confirmMembership(
                              membership.no,
                              membership.chargename
                            )
                          "
                        >
                          <i class="icon ti ti-check text-success" />입금확인
                        </button>
                        <button
                          type="button"
                          class="btn btn-outline"
                          @click="
                            deleteMembership(
                              membership.no,
                              membership.chargename
                            )
                          "
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
