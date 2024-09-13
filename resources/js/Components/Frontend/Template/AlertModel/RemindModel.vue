<script setup>

const props = defineProps({
  remindName: String,
});

const remindList = {
  'warning': '注意事項!!',
  'success': '投稿成功!',
  'fail': '投稿失敗!',
};

</script>

<!-- 使用方法 -->
<!-- <div v-if="createOrEdit" class="absolute z-10 w-full h-full p-4 bg-black/50 flex justify-center items-center">
  <RemindModel @close-info=closeModel remind-name='success' />
</div> -->

<template>
  <div class="bg-white w-full md:w-[600px] py-10 px-4 rounded-xl">
    <div class="flex flex-col gap-4 w-full h-full overflow-y-auto">
      <h2 class="text-[28px] text-center font-bold tracking-[1.4px]">{{ remindList[props.remindName] }}</h2>
      <div v-if="props.remindName === 'warning'" class="text-[16px] md:text-[28px] font-medium tracking-[1.4px] leading-[24px] md:leading-[49px]">
        <div>提醒您報名前，請確認已詳閱並同意本專案簡章所有規範。</div>
        <div>成功投稿報名完即同意本專案簡章所有規範。</div>
      </div>
      <div v-if="props.remindName === 'success'" class="text-[16px] md:text-[28px] font-medium tracking-[1.4px] leading-[24px] md:leading-[49px]">
        <div>投稿報名截止前（2024年6月4日，星期二），您可透過會員中心編輯現有投稿後再重新投稿。</div>
        <br>
        <div>如需變更<span class="text-[#00908D]">個人或團隊報名資料</span>，請<span class="text-[#00908D]">先至會員中心取消原有的報名</span>，然後再重新提交新的報名資料。</div>
      </div>
      <div v-if="props.remindName === 'fail'" class="text-[16px] md:text-[28px] font-medium tracking-[1.4px] leading-[24px] md:leading-[49px]">
        <div>您好，您的團隊成員已經透過個人或團隊報名並成功投稿。若需變更，請聯繫相應的團隊成員登入會員中心並取消投稿。</div>
      </div>
      <div v-if="props.remindName === 'warning'" class="flex justify-center gap-4 text-[16px] md:text-[28px]">
        <Link :href="route('f.regulations')" class="w-1/2 flex justify-center items-center px-10 md:px-6 py-[18px] md:py-2 bg-[#F4E63F] rounded-full">取消，前往辦法</Link>
        <Link href="" class="w-1/2 flex justify-center items-center px-10 md:px-6 py-[18px] md:py-2 bg-[#F4E63F] rounded-full">確定，前往報名</Link>
      </div>
      <div v-if="props.remindName === 'success'" class="flex justify-center gap-4 text-[16px] md:text-[28px]">
        <Link :href="route('f.member.record')" class="w-[80%] flex justify-center items-center px-10 md:px-6 py-[18px] md:py-2 bg-[#F4E63F] rounded-full">確定，前往投稿紀錄</Link>
      </div>
      <div v-if="props.remindName === 'fail'" class="flex justify-center gap-4 text-[16px] md:text-[28px]">
        <Link href="" class="w-1/2 flex justify-center items-center px-10 md:px-6 py-[18px] md:py-2 bg-[#F4E63F] rounded-full">關閉視窗</Link>
      </div>
    </div>
  </div>
</template>

<style scoped>
</style>
