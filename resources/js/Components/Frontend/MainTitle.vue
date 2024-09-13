<script setup>
import starImg from '/images/frontend/star.webp';
</script>

<template>
  <div class="flex items-center justify-center gap-4">
    <img class="md:w-20 w-8" :src="starImg" alt="星星圖示">
    <span class="md:text-5xl text-[28px] font-bold text-front-green-lake tracking-widest">
      <slot />
    </span>
    <img class="md:w-20 w-8" :src="starImg" alt="星星圖示">
  </div>
</template>

<style>

</style>
