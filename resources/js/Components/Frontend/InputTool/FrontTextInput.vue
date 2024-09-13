<script setup>
import { usePage } from '@inertiajs/vue3';
import { twMerge } from 'tailwind-merge';

defineProps({
  modelValue: {
    type: [String, Number],
    required: true,
  },
});

defineEmits(['update:modelValue']);

const isBackend = computed(() => usePage()?.component?.startsWith('Backend/'));
const input = ref(null);

onMounted(() => {
  if (input.value.hasAttribute('autofocus')) {
    input.value.focus();
  }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
  <input
    class="w-full text-base text-[#848484] px-4 py-3 border mt-2"
    :class="twMerge('border-[#666666] focus:border-black focus:ring-black', !isBackend && 'h-[48px] focus:border-black focus:ring-black')"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
    ref="input"
  />
</template>
