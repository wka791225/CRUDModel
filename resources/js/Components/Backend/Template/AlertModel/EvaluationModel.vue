<script setup>
const props = defineProps({
  showData: Object,
});
const emit = defineEmits(['closeInfo']);
</script>

<template>
  <div id="news-model" class="bg-white max-w-[600px] w-full max-h-[90vh] py-10 overflow-hidden">
    <article class="px-10 pb-5">
      <button class="ml-auto flex items-center" type="button" @click="emit('closeInfo')">
        <span class="text-xl font-normal leading-[30px] tracking-[2px] text-[#7D0000]">關閉視窗</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 52 52" fill="none">
          <path
            d="M39 15.275L36.725 13L26 23.725L15.275 13L13 15.275L23.725 26L13 36.725L15.275 39L26 28.275L36.725 39L39 36.725L28.275 26L39 15.275Z"
            fill="#7D0000" />
        </svg>
      </button>
    </article>
    <div class="px-10 h-[calc(90vh-152px)] scrollbar overflow-y-auto">
      <section class="flex flex-col gap-5">
        <article class="border-b-2 border-[#B7B7B7]">
          <figure class="py-10">
            <img class="max-w-[360px] w-full mx-auto aspect-square shadow-[0_4px_4px_0_rgba(0,0,0,0.25)]" :src="props.showData.img_path" alt="">
          </figure>
        </article>
        <article>
          <p class="text-[28px] font-medium leading-[49px] tracking-[1.4px] text-[#7D0000]">{{ props.showData.title }}</p>
        </article>
        <article class="py-5">
          <p class="text-xl font-bold leading-[30px] tracking-[0.4px] text-[#3D3D3D] pb-[10px]">作品理念與說明</p>
          <p class="text-xl font-medium leading-[30px] tracking-[2px] text-[#3D3D3D]">{{ props.showData.concept }}</p>
        </article>
      </section>
    </div>
  </div>
</template>

<style scoped>
.scrollbar {
  /* 捲軸底色 */
  &::-webkit-scrollbar-track {
    background-color: #f8cad2;
  }

  /* 捲軸寬度 */
  &::-webkit-scrollbar {
    width: 6px;
    background-color: black;
  }

  /* 捲軸本體顏色 */
  &::-webkit-scrollbar-thumb {
    background-color: #bb6573;
  }
}
</style>
