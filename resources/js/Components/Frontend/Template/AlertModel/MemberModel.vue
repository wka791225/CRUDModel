<script setup>
import openEye from '/images/frontend/icon/open_eye_.webp';
import closeEye from '/images/frontend/icon/close_eye.webp';
import { useForm } from '@inertiajs/vue3';
const props = defineProps({
  remindName: String,
  user: Object,
});

const remindList = {
  'password': '變更密碼',
};
const newpasswordType = ref('password');
const nowpasswordType = ref('password');
const checknowpasswordType = ref('password');
const form = useForm({
  id: props.user.user ?? 0,
  oldPassword: '',
  newPassword: '',
  checkPassword: '',
});

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
  // 送置後臺並且關閉視窗
  useAlert({
    type: 'store',
    content: '確定要變更密碼嗎？',
    confirm: () => emit('closeInfo', form),
  });

};
const emit = defineEmits(['closeInfo']);
</script>

<template>
  <div class="bg-white w-full md:w-[600px] py-10 px-4 rounded-xl">
    <div class="flex flex-col gap-4 w-full h-full overflow-y-auto">

      <div v-if="props.remindName === 'password'">
        <h2 class="text-[28px] font-bold tracking-[1.4px]">{{ remindList[props.remindName] }}</h2>
        <p class="text-base md:text-xl tracking-[2px] text-[#848484]">請依照密碼規則重設您的密碼</p>
      </div>
      <label for="" class="flex px-[18px] py-3 text-base text-[#848484] tracking-[0.32px] leading-[19px] font-normal rounded border border-[#B7B7B7] cursor-text">
        <input :type="newpasswordType" v-model="form.oldPassword" class="w-full p-0 border-0 focus:ring-0 focus:border-0" placeholder="現有密碼/至少8碼">
        <div class="flex justify-center items-center cursor-pointer" @click="changeType('newpasswordType')" @keyup.enter="changeType('newpasswordType')">
          <img v-if="newpasswordType === 'text'" :src="openEye" alt="">
          <img v-else :src="closeEye" alt="">
        </div>
      </label>
      <label for="" class="flex px-[18px] py-3 text-base text-[#848484] tracking-[0.32px] leading-[19px] font-normal rounded border border-[#B7B7B7] cursor-text">
        <input :type="nowpasswordType" v-model="form.newPassword" class="w-full p-0 border-0 focus:ring-0 focus:border-0" placeholder="新密碼/至少8碼">
        <div class="flex justify-center items-center cursor-pointer" @click="changeType('nowpasswordType')" @keyup.enter="changeType('nowpasswordType')">
          <img v-if="nowpasswordType === 'text'" :src="openEye" alt="">
          <img v-else :src="closeEye" alt="">
        </div>
      </label>
      <label for="" class="flex px-[18px] py-3 text-base text-[#848484] tracking-[0.32px] leading-[19px] font-normal rounded border border-[#B7B7B7] cursor-text">
        <input :type="checknowpasswordType" v-model="form.checkPassword" class="w-full p-0 border-0 focus:ring-0 focus:border-0" placeholder="再次輸入新密碼">
        <div class="flex justify-center items-center cursor-pointer" @click="changeType('checknowpasswordType')" @keyup.enter="changeType('checknowpasswordType')">
          <img v-if="checknowpasswordType === 'text'" :src="openEye" alt="">
          <img v-else :src="closeEye" alt="">
        </div>
      </label>
      <div class="flex justify-center gap-[10px] text-base font-medium tracking-[0.8px] leading-[28px]">
        <button type="button" class="px-4 py-2 text-[#00908D] border border-[#00908D] flex justify-center" @click="emit('closeInfo')">取消</button>
        <button type="button" class="px-4 py-2 bg-[#00908D] text-[#FFFFFF] border border-[#00908D] flex justify-center" @click="submitPassword">送出</button>
      </div>

    </div>
  </div>
</template>

<style scoped>

</style>
