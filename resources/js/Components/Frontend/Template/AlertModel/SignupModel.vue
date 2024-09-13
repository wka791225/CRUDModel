<script setup>
const emit = defineEmits(['closeInfo', 'fetchInfo']);
</script>

<!-- 使用方法 -->
<!-- password / sendemail / register -->
<!-- <div v-if="createOrEdit" class="absolute z-10 w-full h-full p-4 bg-black/50 flex justify-center items-center">
  <RemindModel @close-info=closeModel remind-name='password' />
</div> -->

<template>
  <div class="bg-white w-full md:w-[360px] py-10 px-4 rounded-xl">
    <div class="flex flex-col gap-4 w-full h-full overflow-y-auto">
      <h2 class="text-[28px] font-bold tracking-[1.4px] text-center">取消報名!</h2>

      <p class="text-[28px] tracking-[1.4px] text-[#3D3D3D]">取消報名無法復原，若是想再參與本競賽，請重新投稿報名。</p>

      <div class="flex justify-center gap-4 md:text-[28px] md:leading-[49px] text-[16px] font-medium">
        <button type="button" class="w-1/2 flex justify-center items-center py-2 bg-[#F4E63F] rounded-full" @click="emit('closeInfo')">不取消</button>
        <button type="button" class="w-1/2 flex justify-center items-center py-2 bg-[#F4E63F] rounded-full" @click="emit('closeInfo'), emit('fetchInfo')">確定取消</button>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
