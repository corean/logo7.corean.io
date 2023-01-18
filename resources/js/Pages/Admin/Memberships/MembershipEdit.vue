<script setup>
import BsModal from '@/Components/BsModal.vue'
import { computed } from 'vue'
import { router, useForm } from '@inertiajs/vue3'
import { numberFormat } from '@/helpers/filter'
import moment from 'moment'
import 'moment/locale/ko'

const props = defineProps({
  membership: Object,
  queryString: Object,
})

const form = useForm({
  no: props.membership.data.no,
  id: props.membership.data.id,
  chargename: props.membership.data.chargename,
  mobile: props.membership.data.mobile,
  created_at: numberFormat(props.membership.data.created_at),
  confirmed_at: props.membership.data.confirmed_at,
  page: props.queryString.page,
})

const onSubmit = () => {
  router.put(
    route('admin.memberships.update', props.membership.data.no),
    form,
    {
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => {
        // closeModal()
      },
    }
  )
}

const isOpen = computed(() => !!props.membership)

const closeModal = () => {
  // console.log('closeModal()')
  router.get(route('admin.memberships.index', { _query: props.queryString }))
}
</script>

<template>
  <BsModal :show="isOpen" max-width="lg" :closeable="true" @close="closeModal">
    <template #modal-header>
      <h5 class="modal-title">연간회원 신청</h5>
    </template>

    <div class="row mb-2">
      <label class="offset-sm-1 col-2 col-form-label">번호</label>
      <div class="col-7 pt-1">
        {{ props.membership.data.no }}
      </div>
    </div>
    <div class="row mb-2">
      <label class="offset-sm-1 col-2 col-form-label">유저 ID</label>
      <div class="col-7">
        <input
          type="text"
          class="form-control"
          name="id"
          placeholder="유저ID"
          v-model="props.membership.data.id"
          disabled
        />
      </div>
    </div>
    <div class="row mb-2">
      <label class="offset-sm-1 col-2 col-form-label">입금자명</label>
      <div class="col-7">
        <input
          type="text"
          class="form-control"
          name="chargename"
          placeholder="입금자명"
          v-model="form.chargename"
        />
      </div>
    </div>

    <div class="row mb-2">
      <label class="offset-sm-1 col-2 col-form-label">연락처</label>
      <div class="col-7">
        <input
          type="text"
          class="form-control"
          name="mobile"
          placeholder="연락처"
          v-model="form.mobile"
        />
      </div>
    </div>

    <div class="row mb-2">
      <label class="offset-sm-1 col-2 col-form-label">거래시간</label>
      <div class="col-7">
        <input
          type="text"
          class="form-control"
          name="created_at"
          placeholder="거래등록시간"
          v-model="props.membership.data.created_at"
          disabled
        />
      </div>
    </div>

    <div class="row mb-2">
      <label class="offset-sm-1 col-2 col-form-label">확인시간</label>
      <div class="col-7">
        <input
          type="text"
          class="form-control"
          name="created_at"
          placeholder="확인시간"
          v-model="props.membership.data.confirmed_at"
          disabled
        />
      </div>
    </div>

    <template #modal-body>
      <div class="row">
        <div class="offset-sm-1 col-2">연간회원이력</div>
        <div class="col">
          <ul v-if="membership.data.completedCount" cl>
            <li v-for="(item, key) in membership.data.completedList" :key="key">
              {{ moment(item.created_at).format('YYYY-MM-DD') }}
              {{ item.chargename }}
              {{ item.mobile }}
            </li>
          </ul>
        </div>
      </div>
    </template>

    <template #modal-footer>
      <a
        href="#"
        @click="onSubmit"
        class="btn btn-primary ms-auto"
        data-bs-dismiss="modal"
      >
        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
        <i class="icon icon-thick ti ti-edit me-2"></i>
        수정하기
      </a>
    </template>
  </BsModal>
</template>
