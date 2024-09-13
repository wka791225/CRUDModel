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
    :class="twMerge('border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm', !isBackend && 'h-[48px] focus:border-main-purple focus:ring-main-purple')"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
    ref="input"
  />
</template>
