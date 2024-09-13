<script setup>
import { useForm } from '@inertiajs/vue3';
import { sendRequest } from '@/Composables/useRequest';
import FrontInputLabel from '@/Components/Frontend/InputTool/FrontInputLabel.vue';

const props = defineProps({
  newsData: Object,
});

const form = useForm({
  id: props.newsData?.id ?? 0,
  name: props.newsData?.name ?? '',
});

// 設定確認彈跳視窗參數
const { useAlert } = useAlertStore();

/**
 * 發送請求
 */
const submit = () => {
  const url = 'b.user.update' ;
  const type = 'put';
  useAlert({
    type: 'store',
    content: '確定要變更帳號名稱嗎？',
    confirm: () => sendRequest(route(url), type, {
      data: form.data(),
      redirect: route('b.user.index'),
    }),
  });
};
const emit = defineEmits(['closeInfo']);
</script>

<template>
  <div id="news-model" class="bg-white w-[738px] h-[300px] p-5 rounded-xl">
    <div class=" w-full h-full  overflow-y-auto">
      <div class="text-4xl font-bold text-center border-b-[1px] border-main-white-gray pb-3">變更帳號名稱</div>
      <form @submit.prevent="submit" class="space-y-6">
        <div class="mt-4">
          <FrontInputLabel for="name" value="變更帳號名稱" class="text-[28px] text-[#666666]" required />
          <TextInput
            id="name"
            type="name"
            class="mt-1 block w-full p-2 border"
            v-model="form.name"
            required
            autocomplete="current-name"
            placeholder="請輸入名稱"
          />
          <InputError class="mt-2" :message="form.errors.name" />
        </div>
        <div class="w-full flex justify-start gap-4 pt-5">
          <PrimaryButton type="button" class="bg-black text-white w-20 " @click="emit('closeInfo')">
            取消
          </PrimaryButton>
          <PrimaryButton type="button" class="bg-black text-white w-full " @click="submit">
            確認
          </PrimaryButton>
        </div>
      </form>
    </div>
  </div>
</template>

<style scoped>
</style>
