import { router } from '@inertiajs/vue3';
import { utils, writeFile } from 'xlsx';

/**
 * 向後端發送請求獲取資料後匯出
 * @param {string} url 發送請求的路徑
 * @param {string} title 匯出的檔名
 * @param {string} ext 附檔名(預設為xlsx)
 */
const exportData = (url, title, ext = 'xlsx') => {

  if (!url || !title) {
    return;
  }

  router.post(url, {}, {
    preserveState: true,
    preserveScroll: true,
    onSuccess: ({ props: { flash: { message = {} } = {} } = {} } = {}) => {
      if (!message?.rt_code) return;
      const { rt_data: rtData } = message;
      const padZero = (count) => `${count}`.padStart(2, '0');
      const date = `${new Date().getFullYear()}${padZero(new Date().getMonth() + 1)}${padZero(new Date().getDate())}`;
      const time = `${padZero(new Date().getHours())}${padZero(new Date().getMinutes())}`;

      // const wb = utils.book_new();
      // for (const [index, sheetData] of rtData.entries()) {
      //   const ws = utils.json_to_sheet(sheetData);
      //   utils.book_append_sheet(wb, ws, `工作表${index + 1}`);
      // }
      const ws = utils.json_to_sheet(rtData);
      const wb = utils.book_new();
      utils.book_append_sheet(wb, ws, title);
      writeFile(wb, `${title}_${date}_${time}.${ext}`, { bookType: ext });
    },
  });
};

export { exportData };
