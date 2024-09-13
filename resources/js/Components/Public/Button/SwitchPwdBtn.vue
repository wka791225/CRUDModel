<!-- 切換顯示/隱藏密碼按鈕 -->

<script setup>
import { twMerge } from 'tailwind-merge';

const model = defineModel({ type: Boolean, default: false });
defineProps({
  className: {
    type: String,
    default: '',
  },
});
</script>

<template>
  <button type="button" :class="twMerge('absolute bottom-[1px] right-2 h-[46px] px-2 bg-white', className)" @click="() => model = !model">
    <svg v-show="!model" width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
      <title>檢視密碼圖示</title>
      <path d="M10 0C5.45455 0 1.57273 2.82727 0 6.81818C1.57273 10.8091 5.45455 13.6364 10 13.6364C14.5455 13.6364 18.4273 10.8091 20 6.81818C18.4273 2.82727 14.5455 0 10 0ZM10 11.3636C7.49091 11.3636 5.45455 9.32727 5.45455 6.81818C5.45455 4.30909 7.49091 2.27273 10 2.27273C12.5091 2.27273 14.5455 4.30909 14.5455 6.81818C14.5455 9.32727 12.5091 11.3636 10 11.3636ZM10 4.09091C8.49091 4.09091 7.27273 5.30909 7.27273 6.81818C7.27273 8.32727 8.49091 9.54545 10 9.54545C11.5091 9.54545 12.7273 8.32727 12.7273 6.81818C12.7273 5.30909 11.5091 4.09091 10 4.09091Z" fill="#676767" />
    </svg>
    <svg v-show="model" width="16" height="7" viewBox="0 0 16 7" fill="none" xmlns="http://www.w3.org/2000/svg">
      <title>隱藏密碼圖示</title>
      <path d="M1 1C1.64396 1.78107 2.40257 2.46003 3.25 3.01375M14.5 1C13.856 1.78107 13.0974 2.46003 12.25 3.01375M6.25 4.23175L5.875 5.875M6.25 4.2325C7.24092 4.42307 8.25908 4.42307 9.25 4.2325M6.25 4.2325C5.18083 4.02329 4.16216 3.60946 3.25 3.01375M9.25 4.23175L9.625 5.875M9.25 4.2325C10.3192 4.02329 11.3378 3.60946 12.25 3.01375M12.25 3.01375L13.375 4.375M3.25 3.01375L2.125 4.375" stroke="#676767" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
  </button>
</template>
