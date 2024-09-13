import { defineStore } from 'pinia';

export const useElementStore = defineStore('element', {
  state: () => ({
    indexBanner: null,
    workInfo: null,
  }),
  actions: {
    putEl(el) {
      this.indexBanner = el;
    },
    putWork(work) {
      this.workInfo = work;
    },
  },
});
