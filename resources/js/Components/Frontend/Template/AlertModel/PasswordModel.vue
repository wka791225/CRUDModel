<script setup>
const props = defineProps({
  remindName: String,
  remindColor: String,
});

const emit = defineEmits(['closeInfo']);
</script>

<!-- 使用方法 -->
<!-- password / sendemail / register -->
<!-- <div v-if="createOrEdit" class="absolute z-10 w-full h-full p-4 bg-black/50 flex justify-center items-center">
  <RemindModel @close-info=closeModel remind-name='password' />
</div> -->

<template>
  <div class="bg-white w-full md:w-[360px] py-10 px-4 rounded-xl">
    <div class="flex flex-col gap-4 w-full h-full overflow-y-auto">
      <h2 v-if="props.remindName === 'sendemail'" class="text-[28px] font-bold tracking-[1.4px] text-center">已寄送變更密碼信件!</h2>
      <h2 v-if="props.remindName === 'password'" class="text-[28px] font-bold tracking-[1.4px] text-center">已成功變更密碼!</h2>
      <h2 v-if="props.remindName === 'register'" class="text-[28px] font-bold tracking-[1.4px] text-center">已成功註冊!</h2>

      <p v-if="props.remindName === 'sendemail'" class="text-[28px] tracking-[1.4px] text-[#3D3D3D]">請至註冊時填寫的E-mail收取變更密碼信件。</p>
      <p v-if="props.remindName === 'password'" class="text-[28px] tracking-[1.4px] text-[#3D3D3D]">請重新登入!</p>

      <div v-if="props.remindName === 'sendemail'" class="flex justify-center gap-4 text-[16px] md:text-[28px]">
        <button type="button" class="w-full flex justify-center items-center px-10 md:px-6 py-[18px] md:py-2 bg-[#F4E63F] rounded-full" :class="{ '!bg-[#7D0000] text-white': props.remindColor === 'admin' }" @click="emit('closeInfo')">確定</button>
      </div>
      <div v-if="props.remindName === 'password'" class="flex justify-center gap-4 text-[16px] md:text-[28px]">
        <Link v-if="props.remindName === 'password' && props.remindColor === 'frontend'" :href="route('f.member.login')" class="w-full flex justify-center items-center px-10 md:px-6 py-[18px] md:py-2 bg-[#F4E63F] rounded-full">確定</Link>
        <Link v-if="props.remindColor === 'admin'" :href="route('j.judgeLogin.index')" class="w-full flex justify-center items-center px-10 md:px-6 py-[18px] md:py-2 bg-[#F4E63F] rounded-full" :class="{ '!bg-[#7D0000] text-white': props.remindColor === 'admin' }">確定</Link>
      </div>
      <div v-if="props.remindName === 'register'" class="flex justify-center gap-4 text-[16px] md:text-[28px]">
        <Link :href="route('f.home')" class="w-full flex justify-center items-center px-10 md:px-6 py-[18px] md:py-2 bg-[#F4E63F] rounded-full">確定，返回首頁</Link>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
