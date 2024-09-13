<script setup>
const props = defineProps({
  itemName: String,
});
const checked = ref(false);

</script>

<template>
  <div class="w-full shadow-[0_0_5px_0_rgba(19,59,91,0.3)]">
    <label class="p-4 cursor-pointer transition-all flex justify-between items-center text-[#3CB8B7]">
      <input type="checkbox" class="sr-only" v-model="checked" />
      <div class="flex items-center gap-[10px]">
        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
          <rect x="0.5" y="8" width="20" height="4" fill="#3CB8B7" />
          <rect v-if="!checked" x="8.5" width="4" height="20" fill="#3CB8B7" />
        </svg>
        <span>{{ props.itemName }}</span>
      </div>
    </label>
    <div :class="[checked ? 'flex' : 'hidden', 'w-[calc(100%-32px)] h-[1px] bg-[#3CB8B7] mx-auto']"></div>
    <div
      :class="[checked ? 'max-h-[1000px]' : 'max-h-0', 'overflow-hidden transition-all']">
      <slot name="itemContent">
        <div class="p-4">
          <slot name="itemText"></slot>
        </div>
      </slot>
    </div>
  </div>
</template>
