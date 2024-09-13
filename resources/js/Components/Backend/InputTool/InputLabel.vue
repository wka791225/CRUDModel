<script setup>
import { twMerge } from 'tailwind-merge';

defineProps({
  value: {
    type: String,
    default: '',
  },
  required: {
    type: Boolean,
    default: false,
  },
  className: {
    type: String,
    required: false,
    default: '',
  },
});
</script>

<template>
  <label :class="twMerge('block font-medium min-h-[24px] leading-6', className)">
    <span v-if="value" v-html="value"></span>
    <em v-if="required" class="text-red-500" aria-label="必填">* </em>
    <span v-else>
      <slot />
    </span>
  </label>
</template>
