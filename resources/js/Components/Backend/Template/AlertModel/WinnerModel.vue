<script setup>
import { useForm } from '@inertiajs/vue3';
import { sendRequest } from '@/Composables/useRequest';
// import { fileToBase64 } from '@/Composables/useFiles';

const props = defineProps({
  newsData: Object,
});

const winnerList = [
  { id: '6', name: '入圍作品' },
  { id: '1', name: '金獎' },
  { id: '2', name: '銀獎' },
  { id: '3', name: '銅獎' },
  { id: '4', name: '優選' },
  { id: '5', name: '入圍' },
];
const form = useForm({
  id: props.newsData?.id ?? 0,
  title: props.newsData?.title ?? '',
  author: props.newsData?.author ?? '',
  winner: props.newsData?.winner ?? '',
  content: props.newsData?.content ?? '',
  logo_path: props.newsData?.logo_path ?? '',
  logo_name: props.newsData?.logo_name ?? '',
  workPosterIllustrate: props.newsData.logo_path_one ?? '',
  workPosterIllustrateTwo: props.newsData.logo_path_two ?? '',
  workPosterIllustrateThree: props.newsData.logo_path_three ?? '',
});
// 將form裡面的winner利用winnerList的id轉換成name
form.winner = winnerList.find((item) => item.name === form.winner)?.id ?? '';

/**
 * 將圖片資料轉換成base64，並放入form的photo欄位
 * @param {Event} event 上傳圖片的事件
 */
// const handlePhoto = async (event, type) => {
//   const { files } = event.target;
//   const [img] = await fileToBase64(files, { maxLength: 1262 });
//   switch (type) {
//   case 'logo':
//     form.logo_path = img;
//     form.logo_name = files[0].name;
//     break;
//   case 'workPosterIllustrate':
//     form.workPosterIllustrate = { name: files[0].name, path: img };

//     break;
//   }
// };
/**
 * 將檔案放入tempFile中
 * @param {FileList} files 上傳的檔案
 */
const setFiles = (files, type) => {
  // 限制上傳檔案數量
  const file = files[0];
  switch (type) {
  case 1:
    form.logo_path = file ;
    form.logo_name = file.name ;
    break;
  case 2:

    form.workPosterIllustrate = { type: 2, name: file.name, path: file };
    break;
  case 3:

    form.workPosterIllustrateTwo = { type: 3, name: file.name, path: file };
    break;
  case 4:

    form.workPosterIllustrateThree = { type: 4, name: file.name, path: file };
    break;

  default:
    tempFiles.push({ type: type, name: file.name, path: file });
    break;
  }
};
// 設定確認彈跳視窗參數
const { useAlert } = useAlertStore();

const alertParam = Object.freeze({
  type: form.id ? 'update' : 'store',
  confirm: () => submit(),
});
const tempFiles = reactive([]);
/**
 * 發送請求
 */
const submit = () => {
  const url = props.newsData.id !== 0 ? 'b.winning-works.update' : 'b.winning-works.store';
  const type = props.newsData.id !== 0 ? 'put' : 'post';
  sendRequest(route(url), type, {
    data: form.data(),
    redirect: route('b.winning-works.index'),
  });
};
const emit = defineEmits(['closeInfo']);
</script>

<template>
  <div id="news-model" class="bg-white w-[738px] h-[600px] p-5 rounded-xl">
    <div class=" w-full h-full  overflow-y-auto">
      <div class="text-4xl font-bold text-center border-b-[1px] border-main-white-gray pb-3">{{ form.id === 0 ? '新增' : '編輯' }}入圍作品</div>
      <form @submit.prevent="useAlert(alertParam)" class="space-y-6">
        <div class="mt-4">
          <InputLabel for="news-type" value="類別" required class="text-[28px] text-[#666666]" />
          <SelectOption
            id="news-type"
            v-model="form.winner"
            class="mt-1 block w-full"
            required
          >
            <option value="" hidden>請選擇類別</option>
            <option v-for="newsType in winnerList" :key="newsType.id" :value="newsType.id">
              {{ newsType.name }}
            </option>
          </SelectOption>
          <InputError :message="form.errors.type" class="mt-2" />
        </div>
        <div class="mt-4">
          <InputLabel for="author" value="作品作者" class="text-[28px] text-[#666666]" />
          <TextInput
            id="author"
            v-model="form.author"
            type="text"
            class="mt-1 block w-full"
            maxlength="12"
            placeholder="姓名"
          />
          <InputError :message="form.errors.author" class="mt-2" />
        </div>
        <div class="mt-4">
          <InputLabel for="title" value="作品名稱(建議12字內)" class="text-[28px] text-[#666666]" required />
          <TextInput
            id="title"
            v-model="form.title"
            type="text"
            class="mt-1 block w-full"
            required
            placeholder="作品名稱"
          />
          <InputError :message="form.errors.title" class="mt-2" />
        </div>
        <div>
          <InputLabel for="content" value="作品理念(建議200-300字)" class="text-[28px] text-[#666666]" />
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
          <InputLabel for="photo" value="作品無文字純LOGO圖片(圖片尺寸600*600px)" class="text-[28px] text-[#666666]" />
          <label class="relative block w-full h-[500px] mt-1 border border-gray-300 rounded-md shadow-sm cursor-pointer">
            <!-- <input type="file" id="photo" class="w-px h-px opacity-0" accept="image/*" @change="(e) => setFiles(e, 1)"> -->
          </label>
          <FileInput for-id="photo" class="mt-1  " need-clear accept="file"
            @update="files => setFiles(files, 1)" />
          <InputError :message="form.errors.files" class="mt-2" />
        </div>
        <div class="mt-4 w-full flex flex-col gap-2">
          <InputLabel for="isNumber" value="作品說明海報-1.pdf" class="text-base md:text-[28px] text-[#848484]" required />
          <div class="flex gap-2">
            <div class="text-base md:text-[20px]  w-full p-2 border border-[#3D3D3D] bg-[#ffffff] text-[#848484]">{{ form.workPosterIllustrate ? form.workPosterIllustrate.name : 'A3格式(直式或橫式)，5MB以內、300dpi' }}</div>
            <InputLabel for="files"
              class=" text-[28px] w-1/2 bg-main-block-red  cursor-pointer leading-normal text-white  flex justify-center items-center"
              value="選擇檔案" />
            <div class=" w-full md:w-1/3 hidden">
              <FileInput for-id="files" class="mt-1  " need-clear accept="file"
                @update="files => setFiles(files, 2)" />
              <InputError :message="form.errors.files" class="mt-2" />
            </div>
          </div>
        </div>
        <div class="mt-4 w-full flex flex-col gap-2">
          <InputLabel for="isNumber" value="作品說明海報-2.pdf" class="text-base md:text-[28px] text-[#848484]" />
          <div class="flex gap-2">
            <div class="text-base md:text-[20px]  w-full p-2 border border-[#3D3D3D] bg-[#ffffff] text-[#848484]">{{ form.workPosterIllustrateTwo ? form.workPosterIllustrateTwo.name : 'A3格式(直式或橫式)，5MB以內、300dpi' }}</div>
            <InputLabel for="files-2"
              class=" text-[28px] w-1/2 bg-main-block-red  cursor-pointer leading-normal text-white  flex justify-center items-center"
              value="選擇檔案" />
            <div class=" w-full md:w-1/3 hidden">
              <FileInput for-id="files-2" class="mt-1  " need-clear accept="pdf"
                @update="files => setFiles(files, 3)" />
              <InputError :message="form.errors.files" class="mt-2" />
            </div>
          </div>
        </div>
        <div class="mt-4 w-full flex flex-col gap-2">
          <InputLabel for="isNumber" value="作品說明海報-3.pdf" class="text-base md:text-[28px] text-[#848484]" />
          <div class="flex gap-2">
            <div class="text-base md:text-[20px]  w-full p-2 border border-[#3D3D3D] bg-[#ffffff] text-[#848484]">{{ form.workPosterIllustrateThree ? form.workPosterIllustrateThree.name : 'A3格式(直式或橫式)，5MB以內、300dpi' }}</div>
            <InputLabel for="files-3"
              class=" text-[28px] w-1/2 bg-main-block-red  cursor-pointer leading-normal text-white  flex justify-center items-center"
              value="選擇檔案" />
            <div class=" w-full md:w-1/3 hidden">
              <FileInput for-id="files-3" class="mt-1  " need-clear accept="pdf"
                @update="files => setFiles(files, 4)" />
              <InputError :message="form.errors.files" class="mt-2" />
            </div>
          </div>
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
