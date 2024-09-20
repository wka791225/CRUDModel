<script setup>
import { sendRequest } from '@/Composables/useRequest';
const props = defineProps({
  response: Object,
});
const rtData = computed(() => props.response?.rt_data ?? {});
const modelData = computed(() => rtData.value.model ?? []);
const mainTable = ref([]);

const firstTable = ref([
  {
    id: 1,
    tableName: '',
    columns: [],
    related: 0,
  },
]);

modelData.value.forEach((item, index) => {
  if (item) {
    mainTable.value.push(
      {
        id: index + 1,
        name: item.modelName,
      },
    );
  } else {
    return;
  }
});

const columnList = (id) => {
  const table = firstTable.value.find((item) => item.id === id);
  if (!table) {
    return;
  }
  const tableData = modelData.value.find((item) => item.modelName === table.tableName);
  if (!tableData) {
    return;
  }
  table.columns = tableData.columns;
};

const addTable = () => {
  const arrCount = firstTable.value.length + 1;
  const arr = {
    id: arrCount,
    tableName: '',
    columns: [],
  };
  firstTable.value.push(arr);
};
const submitTable = async () => {
  const table = firstTable.value;
  const response = await sendRequest(route('data.createController'), 'post', {
    data: table,
  });
  downloadFile(response);
};
const downloadFile = (data) => {
  const blob = new Blob([data], { type: 'text/plain' });
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = 'download.txt';
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
  URL.revokeObjectURL(url);
};


</script>

<template>
  <section class="p-5">
    <div class="flex gap-3 justify-center">
      <button type="button" class="bg-amber-200 rounded-full p-3 hover:bg-amber-200/50 hidden" @click="addTable">
        <span class="text-xl font-bold p-3">加入其他表</span>
      </button>
      <button type="button" @click="submitTable">送出</button>
    </div>
    <div v-for="item in firstTable" :key="item.id" class="p-5">
      <div class="flex w-full justify-between">
        <div class="flex flex-col items-start">
          <span>資料表選擇</span>
          <select v-model="item.tableName" name="" id="" @change="columnList(item.id)">
            <option value="">請選擇</option>
            <option v-for="item in mainTable" :key="item.id" :value="item.name">{{ item.name }}</option>
          </select>
        </div>
      </div>
      <BackendTableList>
        <template #top>
          <div class="flex justify-end flex-wrap">
            <span class="text-4xl font-bold w-full ">
              資料欄位
            </span>
          </div>
          <span>檔案上傳欄位，名稱請填寫pathName，檔案路徑請填寫filePath</span>
          <div v-if="item && item.id !== 1" class="flex flex-col">
            <span>與哪張資料表關聯</span>
            <input type="text" name="" id="">
          </div>
        </template>

        <template #thead>
          <th scope="col" class="backend-table-th ">
            欄位/備註
          </th>
          <th scope="col" class="backend-table-th">
            欄位屬性
          </th>
          <th scope="col" class="backend-table-th ">
            欄位屬性是否空值
          </th>
          <th scope="col" class="backend-table-th ">
            前台validate
          </th>
          <th scope="col" class="backend-table-th ">
            前台資料名稱
          </th>
        </template>

        <template #tbody>
          <tr v-for=" (col, index) in item.columns" :key="index">
            <td class="backend-table-td break-all">
              {{ col.name }} / {{ col.comment }}
            </td>
            <td class="backend-table-td break-all">
              {{ col.type }}
            </td>
            <td class="backend-table-td w-[100px]">
              {{ col.nullable }}
            </td>
            <td class="backend-table-td ">
              <input type="checkbox" v-model="col.required" name="" id="">
            </td>
            <td class="backend-table-td">
              <input type="text" v-model="col.requestName" name="" id="">
            </td>
          </tr>
        </template>
      </BackendTableList>
    </div>
  </section>
</template>

<style scoped>
#frontend-index {
  @apply w-full h-full overflow-y-auto;
}

.title {
  @apply text-[6.25rem] text-center;
}

.btn-base {
  @apply p-1.5 border-2 rounded-md border-green-500 cursor-pointer;
}
</style>
