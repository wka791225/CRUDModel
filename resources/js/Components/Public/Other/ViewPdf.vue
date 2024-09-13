<script setup>
import { VuePDF, usePDF } from '@tato30/vue-pdf';
import '@tato30/vue-pdf/style.css';

const props = defineProps({
  pdfPath: {
    type: Text,
    default: '',
  },
});

const { pdf } = usePDF(window.location.origin + props.pdfPath);
</script>

<template>
  <VuePDF :pdf="pdf" fit-parent class="shadow-main" />
</template>
