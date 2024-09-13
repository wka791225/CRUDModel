<script setup>
import { useForm } from '@inertiajs/vue3';
import { sendRequest } from '@/Composables/useRequest';
import { fileToBase64 } from '@/Composables/useFiles';
import FrontInputLabel from '@/Components/Frontend/InputTool/FrontInputLabel.vue';

const props = defineProps({
  newsData: Object,
});

const form = useForm({
  id: props.newsData?.id ?? 0,
  title: props.newsData?.title ?? '',
  content: props.newsData?.content ?? '',
  date: props.newsData?.date ?? '',
  photo_path: props.newsData?.photo_path ?? '',
});

/**
 * 將圖片資料轉換成base64，並放入form的photo欄位
 * @param {Event} event 上傳圖片的事件
 */
const handlePhoto = async (event) => {
  const { files } = event.target;
  const [img] = await fileToBase64(files, { maxLength: 1262 });
  form.photo_path = img;
};

// 設定確認彈跳視窗參數
const { useAlert } = useAlertStore();

const alertParam = Object.freeze({
  type: form.id ? 'update' : 'store',
  confirm: () => submit(),
});

// 日期選擇器其他參數
const otherOption = Object.freeze({
  'auto-apply': true,
});

/**
 * 發送請求
 */
const submit = () => {
  const url = props.newsData.id !== 0 ? 'b.news.update' : 'b.news.store';
  const type = props.newsData.id !== 0 ? 'put' : 'post';
  sendRequest(route(url), type, {
    data: form.data(),
    redirect: route('b.news.index'),
  });
};
const emit = defineEmits(['closeInfo']);
</script>

<template>
  <div id="news-model" class="bg-white w-[738px] h-[600px] p-5 rounded-xl">
    <div class=" w-full h-full  overflow-y-auto">
      <div class="text-4xl font-bold text-center border-b-[1px] border-main-white-gray pb-3">{{ form.id === 0 ? '新增' : '編輯' }}最新消息</div>
      <form @submit.prevent="useAlert(alertParam)" class="space-y-6">
        <div class="mt-4">
          <FrontInputLabel for="title" value="消息標題(建議20字內)" class="text-[28px] text-[#666666]" required />
          <TextInput
            id="title"
            type="title"
            class="mt-1 block w-full p-2 border"
            v-model="form.title"
            required
            autocomplete="current-title"
            placeholder="請輸入標題"
          />
          <InputError class="mt-2" :message="form.errors.title" />
        </div>
        <div class="mt-4">
          <div class="relative">
            <FrontInputLabel for="date" value="發布日期" class="text-[28px] text-[#666666]" required />
            <DatePicker
              :init-date="form.date"
              :other-option="otherOption"
              class="mt-1"
              v-model="form.date"
              required
            />
            <input v-model="form.date" type="text" class="absolute z-[-1] bottom-0 left-1/2 w-px h-px opacity-0">
            <InputError :message="form.errors.type" class="mt-2" />
          </div>
        </div>
        <div>
          <FrontInputLabel for="content" value="內文(所見及所得)" class="text-[28px] text-[#666666]" required />
          <div class="h-[600px] mt-1">
            <Editor
              id="content"
              v-model="form.content"
            />
          </div>
          <InputError :message="form.errors.content" class="mt-2" />
        </div>
        <!-- 圖片欄位 -->
        <div class="mt-4">
          <FrontInputLabel for="photo" value="消息圖片" class="text-[28px] text-[#666666]" required />
          <label class="relative block w-full h-[500px] mt-1 border border-gray-300 rounded-md shadow-sm cursor-pointer">
            <input type="file" id="photo" class="w-px h-px opacity-0" accept="image/*" @change="handlePhoto">
            <img
              v-if="form.photo_path"
              :src="form.photo_path"
              alt="相片"
              class="absolute inset-0 object-contain w-full h-full rounded-md bg-gray-100"
            >
            <div v-else class="absolute text-3xl inset-0 flex items-center justify-center w-full h-full text-gray-400 bg-gray-100 rounded-md">
              <span>檔案大小限定15mb以內</span>
            </div>
          </label>
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
