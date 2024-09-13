<script setup>
import { twMerge } from 'tailwind-merge';

const props = defineProps({
  type: {
    type: String,
    default: 'submit',
  },
  color: {
    type: String,
    default: '',
  },
  disabled: {
    type: Boolean,
    default: false,
  },
  className: {
    type: String,
    default: '',
  },
});

const colorClass = computed(() => {
  const classList = {
    blue: 'border-blue-600 text-blue-600 hover:bg-blue-500 focus:ring-blue-500',
    green: 'border-green-600 text-green-600 hover:bg-green-500 focus:ring-green-500',
    red: 'border-red-600 text-red-600 hover:bg-red-500 focus:ring-red-500',
    gray: 'border-[#494949] text-[#494949] hover:bg-[#494949] focus:ring-[#494949]',
    orange: 'border-orange-500 text-orange-500 hover:bg-orange-400 focus:ring-orange-600',
  }[props.color] ?? '  hover:opacity-90 hover:bg-front-green-lake focus:ring-indigo-500';

  if (props.disabled) {
    return `${classList} opacity-50`;
  }

  return classList;
});
</script>

<template>
  <button
    :type="props.type"
    :class="twMerge('relative inline-flex items-center justify-center px-3 py-1 min-h-[38px] border border-transparent rounded-lg font-semibold text-base uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 hover:text-white', colorClass, props.className)"
  >
    <slot />
  </button>
</template>
