<script setup>
import { router } from '@inertiajs/vue3';
const props = defineProps({
  workId: String,
});
const submitVote = (workId) => {
  router.post(route('b.evalution.vote'), { vote: workId });

};
const submitLike = (workId) => {
  router.post(route('b.evalution.vote'), { like: workId });
};
</script>

<!-- 收藏的顏色0C0C0C、投票的顏色F4E63F -->
<template>
  <div class="flex flex-col gap-2">
    <slot name="portfolio"></slot>
    <div class="flex justify-between gap-1">
      <button type="button" class="px-[5px] py-1 grow flex gap-1 items-center border" :class="{ 'bg-[#F4E63F] border-[1px] border-black': props.workId.vote === 1 }" @click="submitVote(props.workId.id)">
        <svg v-if="props.workId.vote === 1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 32 32" fill="none">
          <path
            d="M16.3333 23.36L24.5733 28.3333L22.3867 18.96L29.6667 12.6533L20.08 11.8267L16.3333 3L12.5867 11.8267L3 12.6533L10.2667 18.96L8.09333 28.3333L16.3333 23.36Z"
            fill="#000000" />
        </svg>
        <svg v-else xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
          <path
            d="M7.99967 10.26L5.49301 11.7734L6.15301 8.92004L3.93967 7.00004L6.85967 6.75337L7.99967 4.06004L9.13967 6.75337L12.0597 7.00004L9.84634 8.92004L10.5063 11.7734M14.6663 6.16004L9.87301 5.75337L7.99967 1.33337L6.12634 5.75337L1.33301 6.16004L4.96634 9.31337L3.87967 14L7.99967 11.5134L12.1197 14L11.0263 9.31337L14.6663 6.16004Z"
            fill="#666666" />
        </svg>
        <span type="button">
          <span>投票  </span>
          (<span>{{ props.workId.vote }}</span>/<span>60</span>)
        </span>
      </button>
      <button type="button" class="px-[5px] py-1 flex gap-1 items-center border" @click="submitLike(props.workId.id)" :class="{ 'bg-[#0C0C0C] border-[1px] border-white text-white': props.workId.like === 1 }">

        <svg v-if="props.workId.like === 1" xmlns="http://www.w3.org/2000/svg" width="11" height="14" viewBox="0 0 20 25" fill="none">
          <path
            d="M0.666992 24.5V3.16667C0.666992 2.43333 0.928325 1.80578 1.45099 1.284C1.97366 0.762222 2.60121 0.500889 3.33366 0.5H16.667C17.4003 0.5 18.0283 0.761333 18.551 1.284C19.0737 1.80667 19.3345 2.43422 19.3337 3.16667V24.5L10.0003 20.5L0.666992 24.5Z"
            fill="#ffffff" />
        </svg>
        <svg v-else xmlns="http://www.w3.org/2000/svg" width="11" height="14" viewBox="0 0 11 14" fill="none">
          <path
            d="M0.111328 14V1.55556C0.111328 1.12778 0.263772 0.761704 0.568661 0.457333C0.87355 0.152963 1.23962 0.000518519 1.66688 0H9.44466C9.87244 0 10.2388 0.152444 10.5437 0.457333C10.8486 0.762222 11.0007 1.1283 11.0002 1.55556V14L5.55577 11.6667L0.111328 14ZM1.66688 11.6278L5.55577 9.95556L9.44466 11.6278V1.55556H1.66688V11.6278Z"
            fill="#666666" />
        </svg>
        <span>加收藏</span>
      </button>
    </div>
  </div>
</template>
