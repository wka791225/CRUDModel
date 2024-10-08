<!-- 分頁器 -->

<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { isObject } from '@/Composables/useFormVerification';

const props = defineProps({
  paginationData: {
    type: Object,
    required: true,
    default: () => {
      return {
        total: 1,
        current_page: 1,
        per_page: 10,
      };
    },
  },
  otherParam: {
    type: Object,
    required: false,
    default: () => ({}),
    validator: value => isObject(value),
  },
  keepState: {
    type: Boolean,
    required: false,
  },
});

const isBackend = computed(() => usePage()?.url?.includes('/admin'));
const textColor = ref(isBackend.value ? 'black' : '#848484');

// 計算總頁數
const totalPages = computed(() => {
  if (!props.paginationData.total) return 0;
  return Math.ceil(props.paginationData.total / props.paginationData.per_page);
});

// 計算分頁數量
const paginationNum = computed(() => {
  let arr = [];
  const show = 2;
  if (totalPages.value <= 4) {
    for (let i = 1; i <= totalPages.value; i++) {
      arr.push(i);
    }

    return arr;
  }

  if ((props.paginationData.current_page ?? 1) < show + 1) {
    const temp = show * 2 + 1;
    for (let i = 1; i <= temp; i++) {
      arr.push(i);
    }
    return arr;
  }

  if ((props.paginationData.current_page ?? 1) > totalPages.value - show) {
    const temp = totalPages.value - show * 2;
    for (let i = temp; i <= totalPages.value; i++) {
      arr.push(i);
    }
    return arr;
  }

  const tempStart = (props.paginationData.current_page ?? 1) - show;
  const tempNum = (props.paginationData.current_page ?? 1) + show;
  for (let i = tempStart; i <= tempNum; i++) {
    arr.push(i);
  }
  return arr;
});

/**
 * 點擊換頁
 * @param {string|number} page 點擊換頁的方向字串或是頁面數字(往前: prev, 往後: next)
 */
const changePage = (page) => {
  const { otherParam = {}, paginationData, keepState } = props;
  if (!paginationData?.first_page_url) return;
  if (!isObject(otherParam)) throw new TypeError('參數型別錯誤');
  if (page === 'prev') {
    if (paginationData.current_page === 1) return;
    paginationData.current_page--;
  } else if (page === 'next') {
    if (paginationData.current_page === totalPages.value || !totalPages.value) return;
    paginationData.current_page++;
  } else {
    if (paginationData.current_page === page || !totalPages.value) return;
    paginationData.current_page = page;
  }

  const [url, param] = paginationData.first_page_url.split('?');
  const [pageKey] = param.split('=');
  const query = route().params;
  const requestParam = structuredClone(otherParam);
  const fullParam = { ...query, ...requestParam };
  fullParam[pageKey] = paginationData.current_page;
  router.get(url, fullParam, {
    preserveState: keepState,
    preserveScroll: true,
  });
};
</script>

<template>
  <div class="print:hidden flex items-center gap-[15px] mx-auto">
    <div class="flex items-center gap-5 text-xl">
      <button type="button" class="btn-change-page" :class="{ disabled: paginationData.current_page === 1 }" :disabled="paginationData.current_page === 1" @click="changePage('prev')">
        <svg width="13" height="24" viewBox="0 0 13 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <title>到上一頁</title>
          <path d="M10.7959 2L2.00001 12L10.7959 22" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
        </svg>
      </button>
      <div v-if="paginationNum.length" class="flex gap-2">
        <button v-for="(page, key) in paginationNum" :key="key" type="button" :title="`到第${page}頁`" :disabled="page === paginationData.current_page" @click="changePage(page)">
          <div class="page" :class="{ current: page === paginationData.current_page }">{{ page }}</div>
        </button>
      </div>
      <div v-else class="page current">1</div>
      <button type="button" class="btn-change-page" :class="{ disabled: paginationData.current_page === totalPages || !totalPages }" :disabled="paginationData.current_page === totalPages || !totalPages" @click="changePage('next')">
        <svg width="13" height="24" viewBox="0 0 13 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <title>到下一頁</title>
          <path d="M2.2041 2L11 12L2.2041 22" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
        </svg>
      </button>
    </div>
  </div>
</template>

<style scoped>
.btn-change-page {
  @apply opacity-70 cursor-pointer text-[v-bind(textColor)];
}

.btn-change-page:not(.disabled):hover {
  @apply opacity-100;
}

.page {
  @apply md:min-w-[30px] min-w-6 md:leading-7 leading-6 text-center text-[v-bind(textColor)] cursor-pointer;
}

.page:not(.current):hover {
  @apply font-bold;
}

.current {
  @apply cursor-default text-[#848484] border-b-2 border-[#848484];
}

.disabled {
  @apply opacity-30 cursor-default;
}
</style>
