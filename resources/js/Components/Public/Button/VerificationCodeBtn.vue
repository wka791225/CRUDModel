<!-- 驗證碼按鈕組件 -->

<script setup>
import { twMerge } from 'tailwind-merge';
import { getVerificationCode, readVerificationCode } from '@/Composables/useFormVerification';

defineProps({
  className: {
    type: String,
    default: '',
  },
});

const verificationCanvas = ref(null);
const verificationCode = ref('');

// 設置並更新驗證碼
const setCanvasCode = () => {
  verificationCode.value = getVerificationCode(verificationCanvas.value);
};

onMounted(() => {
  setCanvasCode();
});

defineExpose({
  setCanvasCode,
  verificationCode,
});
</script>

<template>
  <div :class="twMerge('flex items-end gap-x-4', className)">
    <canvas ref="verificationCanvas" width="160" height="56" class="rounded-md"></canvas>
    <div class="flex sm:flex-row flex-col gap-y-2 gap-x-4">
      <button type="button" class="verification-code-btn" @click="setCanvasCode">
        <svg width="20" height="21" class="w-[14px] pb-1" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
          <title>更新驗證碼圖示</title>
          <path d="M17.0595 3.44061C15.0199 1.40349 12.1295 0.228702 8.95122 0.553643C4.35903 1.01606 0.580172 4.74038 0.0671484 9.32704C-0.621054 15.3884 4.07124 20.5 9.98978 20.5C13.9814 20.5 17.4099 18.1629 19.0115 14.801C19.4119 13.9637 18.8113 13.0014 17.8853 13.0014C17.4224 13.0014 16.9844 13.2513 16.7842 13.6637C15.3703 16.7007 11.9793 18.6253 8.27553 17.8005C5.49769 17.1881 3.25791 14.926 2.66981 12.1515C1.61873 7.30241 5.31 3.0032 9.98978 3.0032C12.0669 3.0032 13.9188 3.86554 15.2702 5.22779L13.3807 7.11494C12.5924 7.9023 13.143 9.25205 14.2566 9.25205H18.7487C19.4369 9.25205 20 8.68966 20 8.00228V3.5156C20 2.4033 18.6486 1.84091 17.8603 2.62826L17.0595 3.44061Z" fill="#676767" />
        </svg>
        更新驗證碼
      </button>
      <button type="button" class="verification-code-btn" @click="readVerificationCode(verificationCode)">
        <svg width="17" height="21" class="w-[14px] pb-1" viewBox="0 0 17 21" fill="none" xmlns="http://www.w3.org/2000/svg">
          <title>開啟語音圖示</title>
          <path d="M13.9901 7.63854C14.6638 8.43737 15.0225 9.45476 14.9988 10.4995C14.9751 11.5442 14.5707 12.5443 13.8615 13.3118L14.9119 14.2835C15.8571 13.2591 16.3954 11.9247 16.4257 10.5312C16.456 9.13776 15.976 7.78124 15.0762 6.71682L13.9901 7.63854ZM11.4322 20.4997C11.3376 20.4993 11.2441 20.4802 11.1571 20.4434C11.07 20.4066 10.9911 20.3529 10.9249 20.2854L5.4803 14.7836H0.714511C0.525011 14.7836 0.343272 14.7084 0.209276 14.5744C0.0752786 14.4404 0 14.2586 0 14.0691V6.92402C0 6.73452 0.0752786 6.55278 0.209276 6.41879C0.343272 6.28479 0.525011 6.20951 0.714511 6.20951H5.4803L10.9249 0.707775C11.0588 0.574696 11.2398 0.5 11.4286 0.5C11.6174 0.5 11.7985 0.574696 11.9323 0.707775C12.067 0.839695 12.144 1.01947 12.1467 1.20793V19.7852C12.1467 19.9747 12.0714 20.1565 11.9374 20.2905C11.8034 20.4245 11.6217 20.4997 11.4322 20.4997Z" fill="#676767" />
        </svg>
        開啟語音
      </button>
    </div>
  </div>
</template>

<style scoped>
.verification-code-btn {
  @apply flex items-end text-[#676767] gap-2 sm:text-lg hover:underline;
}
</style>
