<script setup>
import lineIcon from '/images/logo/line_icon.webp';
const props = defineProps({
  voteName: String,
  voteId: String,
});
const voteId = props.voteId;

const emit = defineEmits(['closeInfo']);
</script>

<template>
  <div class="w-[360px]  py-6 px-4 bg-white rounded-2xl md:text-[28px] text-xl md:leading-[49px] leading-7 font-medium text-front-dark-gray">
    <p class="text-center md:text-[28px]  text-2xl text-black font-bold mb-4 md:leading-[33.6px]">投票確認</p>
    <p class="mb-4 text-xl"> 確定要投票給「{{ props.voteName }}」嗎？1個人只有1票，且投票後無法變更。</p>
    <div class="flex gap-3">
      <button type="button" class="w-1/2" @click="emit('closeInfo')">
        <div class="text-base text-center border border-front-yellow px-6 py-2 rounded-[34px] hover:opacity-90">取消</div>
      </button>
      <a class="w-full" :href="route('line.index', { id: voteId })" title="首頁(跳轉頁面)">
        <div class="text-center bg-[#00B900] py-2 rounded-[34px] hover:opacity-90 flex px-2 justify-center items-center gap-[10px] text-white ">
          <img class="w-[18px] h-[18px]" :src="lineIcon" alt="">
          <span class="text-base">投票，使用Line驗證</span>
        </div>
      </a>
    </div>
  </div>
</template>

<style>
</style>
