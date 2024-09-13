<script setup>
import { useForm } from '@inertiajs/vue3';
import { sendRequest } from '@/Composables/useRequest';
import openEye from '/images/frontend/icon/open_eye_.webp';
import closeEye from '/images/frontend/icon/close_eye.webp';

const props = defineProps({
  newsData: Object,
});

const form = useForm({
  id: props.newsData?.id ?? 0,
  oldPassword: '',
  newPassword: '',
  checkPassword: '',
});

const newpasswordType = ref('password');
const nowpasswordType = ref('password');
const checknowpasswordType = ref('password');

const changeType = (value) => {
  if (value === 'newpasswordType') {
    newpasswordType.value = newpasswordType.value === 'password' ? 'text' : 'password';
  }
  if (value === 'nowpasswordType') {
    nowpasswordType.value = nowpasswordType.value === 'password' ? 'text' : 'password';
  }
  if (value === 'checknowpasswordType') {
    checknowpasswordType.value = checknowpasswordType.value === 'password' ? 'text' : 'password';
  }
};

// 設定確認彈跳視窗參數
const { useAlert } = useAlertStore();

const submitPassword = () => {
  // 檢查密碼是否符合規則 8
  if (form.oldPassword.length < 8 || form.newPassword.length < 8 || form.checkPassword.length < 8) {
    useAlert({
      type: 'error',
      title: '密碼長度不足',
      cancelContent: '',
    });
    return;
  }
  // 檢查新密碼是否相同
  if (form.newPassword !== form.checkPassword) {
    useAlert({
      type: 'error',
      title: '新密碼不相同',
      cancelContent: '',
    });
    return;
  }
  const url = 'b.user.update' ;
  const type = 'put';
  // 送置後臺並且關閉視窗
  useAlert({
    type: 'store',
    content: '確定要變更密碼嗎？',
    confirm: () => sendRequest(route(url), type, {
      data: form.data(),
      redirect: route('b.user.index'),
    }),
  });

};

const emit = defineEmits(['closeInfo']);
</script>

<template>
  <div id="news-model" class="bg-white w-[500px] h-[600px] p-5 rounded-xl">
    <div class=" w-full h-full  overflow-y-auto">
      <div class="text-4xl font-bold text-center border-b-[1px] border-main-white-gray pb-3">變更密碼</div>
      <div class="text-xl text-center border-b-[1px] border-main-white-gray p-3 mb-3">請依照規則重設您的密碼</div>
      <form @submit.prevent="submitPassword" class="space-y-6">
        <div class="mt-4">
          <div class="text-[28px] text-[#666666]">現有密碼 <span class="text-red-500">*</span></div>
          <label for="" class="flex px-[18px] py-3 text-base text-[#848484] tracking-[0.32px] leading-[19px] font-normal rounded border border-[#B7B7B7] cursor-text">
            <input :type="newpasswordType" v-model="form.oldPassword" class="w-full p-0 border-0 focus:ring-0 focus:border-0" placeholder="請輸入現有密碼">
            <div class="flex justify-center items-center cursor-pointer" @click="changeType('newpasswordType')" @keyup.enter="changeType('newpasswordType')">
              <img v-if="newpasswordType === 'text'" :src="openEye" alt="">
              <img v-else :src="closeEye" alt="">
            </div>
          </label>
        </div>
        <div class="mt-4">
          <div class="text-[28px] text-[#666666]">新密碼 <span class="text-red-500">*</span></div>
          <label for="" class="flex px-[18px] py-3 text-base text-[#848484] tracking-[0.32px] leading-[19px] font-normal rounded border border-[#B7B7B7] cursor-text">
            <input :type="nowpasswordType" v-model="form.newPassword" class="w-full p-0 border-0 focus:ring-0 focus:border-0" placeholder="請輸入8-12位,英數混和">
            <div class="flex justify-center items-center cursor-pointer" @click="changeType('nowpasswordType')" @keyup.enter="changeType('nowpasswordType')">
              <img v-if="nowpasswordType === 'text'" :src="openEye" alt="">
              <img v-else :src="closeEye" alt="">
            </div>
          </label>
        </div>
        <div class="mt-4">
          <div class="text-[28px] text-[#666666]">再次輸入新密碼 <span class="text-red-500">*</span></div>
          <label for="" class="flex px-[18px] py-3 text-base text-[#848484] tracking-[0.32px] leading-[19px] font-normal rounded border border-[#B7B7B7] cursor-text">
            <input :type="checknowpasswordType" v-model="form.checkPassword" class="w-full p-0 border-0 focus:ring-0 focus:border-0" placeholder="請輸入8-12位,英數混和">
            <div class="flex justify-center items-center cursor-pointer" @click="changeType('checknowpasswordType')" @keyup.enter="changeType('checknowpasswordType')">
              <img v-if="checknowpasswordType === 'text'" :src="openEye" alt="">
              <img v-else :src="closeEye" alt="">
            </div>
          </label>
        </div>
        <div class="w-full flex justify-start gap-4 pt-5">
          <PrimaryButton type="button" class="bg-black text-white w-20 " @click="emit('closeInfo')">
            取消
          </PrimaryButton>
          <PrimaryButton type="submit" class="bg-black text-white w-full ">
            確認
          </PrimaryButton>
        </div>
      </form>
    </div>
  </div>
</template>

<style scoped>
</style>
