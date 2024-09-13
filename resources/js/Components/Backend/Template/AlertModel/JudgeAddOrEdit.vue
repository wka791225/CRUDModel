<script setup>
import { useForm } from '@inertiajs/vue3';
import { sendRequest } from '@/Composables/useRequest';
const props = defineProps({
  judgeData: Object,
});

const form = useForm({
  id: props.judgeData?.id ?? 0,
  name: props.judgeData.name ?? '',
  phone: props.judgeData.phone ?? '',
  email: props.judgeData.email ?? '',
  idNumber: props.judgeData.idNumber ?? '',
  bankAccount: props.judgeData.bankAccount ?? '',

});
// 設定確認彈跳視窗參數
const { useAlert } = useAlertStore();

const alertParam = Object.freeze({
  type: 'store',
  content: '是否要新增評審資料？',
  confirm: () => submit(),
});

/**
 * 發送請求
 */
const submit = () => {
  const url = form.id === 0 ? 'b.works.store' : 'b.works.update';
  const method = form.id === 0 ? 'post' : 'put';
  sendRequest(route(url), method, {
    data: form.data(),
  });
};
const emit = defineEmits(['closeInfo']);
</script>

<template>

  <div class="max-w-[562px] p-10 bg-white rounded-2xl text-front-dark-gray">
    <p class="text-center text-4xl text-black font-bold pb-6 border-b border-[#B7B7B7]">{{ form.id === 0 ? '新增' : '編輯' }}評審資料</p>
    <div class=" modal-scroll">
      <p class="text-xl tracking-[2px] py-6 border-b border-[#B7B7B7] mb-6">您好，請先新增評審基本資料後，再寄送邀請連結。</p>
      <form @submit.prevent="useAlert(alertParam)">
        <div class="mt-4">
          <InputLabel for="name" value="姓名" class="text-[28px] text-[#B7B7B7]]" required />
          <TextInput
            id="name"
            type="name"
            class="mt-4 block w-full p-2 border"
            v-model="form.name"
            required
            autocomplete="current-name"
            placeholder="請輸入姓名"
          />
          <InputError class="mt-2" :message="form.errors.name" />
        </div>
        <div class="mt-4">
          <InputLabel for="tel" value="電話" class="text-[28px] text-[#B7B7B7]]" required />
          <TextInput
            id="tel"
            type="tel"
            class="mt-4 block w-full p-2 border"
            v-model="form.phone"
            required
            autocomplete="current-tel"
            placeholder="請輸入評審電話"
          />
          <InputError class="mt-2" :message="form.errors.name" />
        </div>
        <div v-if="form.id === 0" class="mt-4">
          <InputLabel for="email" value="電子信箱" class="text-[28px] text-[#B7B7B7]]" required />
          <TextInput
            id="email"
            type="email"
            class="mt-4 block w-full p-2 border"
            v-model="form.email"
            required
            autocomplete="current-email"
            placeholder="請輸入評審的電子信箱"
          />
          <InputError class="mt-2" :message="form.errors.name" />
        </div>
        <div v-if="form.id !== 0">
          <div class="flex flex-col mb-6">
            <label class="text-[28px] leading-[49px] mb-1">電子信箱</label>
            <div class="bg-[#D6D6D6] p-3 border-[1px] border-black"> {{ form.email }}</div>
          </div>
          <div class="flex flex-col mb-6">
            <label class="text-[28px] leading-[49px] mb-1">身分證字號</label>
            <div class="bg-[#D6D6D6] p-3 border-[1px] border-black"> {{ form.idNumber }}</div>
          </div>
          <div class="flex flex-col mb-6">
            <label class="text-[28px] leading-[49px] mb-1">核銷帳戶</label>
            <div class="bg-[#D6D6D6] p-3 border-[1px] border-black"> {{ form.bankAccount }}</div>
          </div>
        </div>
        <div class="grid grid-cols-4 gap-4 pt-10">
          <button type="button" class="py-2 bg-main-block-red text-white" @click="emit('closeInfo')">取消</button>
          <button type="submit" class="col-span-3 py-2 bg-main-block-red text-white">確認</button>
        </div>
      </form>
    </div>
  </div>
</template>

<style scope>
</style>
