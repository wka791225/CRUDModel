<script setup>
import { useForm } from '@inertiajs/vue3';
import { sendRequest } from '@/Composables/useRequest';
import FrontInputLabel from '@/Components/Frontend/InputTool/FrontInputLabel.vue';

const props = defineProps({
  newsData: Object,
});

const form = useForm({
  id: props.newsData?.id ?? 0,
  title: props.newsData?.title ?? '',
  content: props.newsData?.content ?? '',
});

// 設定確認彈跳視窗參數
const { useAlert } = useAlertStore();

const alertParam = Object.freeze({
  type: form.id ? 'update' : 'store',
  confirm: () => submit(),
});

/**
 * 發送請求
 */
const submit = () => {
  const url = props.newsData.id !== 0 ? 'b.faq.update' : 'b.faq.store';
  const type = props.newsData.id !== 0 ? 'put' : 'post';
  sendRequest(route(url), type, {
    data: form.data(),
    redirect: route('b.faq.index'),
  });
};
const emit = defineEmits(['closeInfo']);
</script>

<template>
  <div id="news-model" class="bg-white w-[738px] h-[600px] p-5 rounded-xl">
    <div class=" w-full h-full  overflow-y-auto">
      <div class="text-4xl font-bold text-center border-b-[1px] border-main-white-gray pb-3">{{ form.id === 0 ? '新增' : '編輯' }}常見問題</div>
      <form @submit.prevent="useAlert(alertParam)" class="text-[28px] leading-[49px] text-[#666666] space-y-6">
        <div class="mt-4">
          <FrontInputLabel for="title" value="標題(建議20字內)" required />
          <TextInput
            id="title"
            type="title"
            class="text-xl mt-1 block w-full p-2 border"
            v-model="form.title"
            required
            autocomplete="current-title"
            placeholder="請輸入標題"
          />
          <InputError class="mt-2" :message="form.errors.title" />
        </div>
        <div>
          <FrontInputLabel for="content" value="內容(建議300字內)" required />
          <div class="h-[600px] mt-1">
            <Editor
              id="content"
              v-model="form.content"
            />
          </div>
          <InputError :message="form.errors.content" class="mt-2" />
        </div>
        <div class="w-full flex justify-start gap-4 pt-5">
          <PrimaryButton type="button" class="bg-main-block-red text-white w-20" @click="emit('closeInfo')">
            取消
          </PrimaryButton>
          <PrimaryButton type="submit" class="bg-main-block-red text-white w-full">
            儲存送出
          </PrimaryButton>
        </div>
      </form>
    </div>
  </div>
</template>

<style scoped>
</style>
