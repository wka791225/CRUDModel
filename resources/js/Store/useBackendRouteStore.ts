import { defineStore } from 'pinia';

type NavLink = {
  id: string;
  name: string;
  right: number;
  path: string;
  params: any;
  lists?: [
    {
      id: string;
      name: string;
      right: number;
      path: string;
      params: any;
    },
  ];
};

export const useBackendRouteStore = defineStore('backend-routes', {
  state: () => ({
    navLinks: Object.freeze([
      {
        id: 'front-info',
        name: '前台資訊管理',
        right: 5,
        path: '',
        params: {},
        lists: Object.freeze([
          {
            id: 'news',
            name: '最新消息管理',
            right: 5,
            path: 'b.news.index',
            params: {},
            lists: Object.freeze([]),
          },
          {
          id: 'case-review',
          name: '社群媒體管理',
          right: 5,
          path: 'b.social-media.index',
          params: { themeId: 0 },
        },
          {
          id: 'case-review',
          name: '常見問題',
          right: 5,
          path: 'b.faq.index',
          params: { themeId: 0 },
        },
          {
          id: 'case-review',
          name: '線上展示',
          right: 5,
          path: 'b.winning-works.index',
          params: { themeId: 0 },
        },
        
      ]),
      },     
      {
        id: 'case-apply',
        name: '投稿數據',
        right: 2,
        path: 'b.articles.contribute',
        params: {},
        lists: Object.freeze([ ]),
      },
      {
        id: 'performances',
        name: '徵件管理',
        right: 2,
        path: 'b.articles.index',
        params: {},
        lists: Object.freeze([]),
      },
      {
        id: 'web-infos',
        name: '講座報名管理',
        right: 2,
        path: 'b.lecture.list',
        params: {},
        lists: Object.freeze([]),
      },
      {
        id: 'web-infos',
        name: '評審管理',
        right: 2,
        path: 'b.works.list',
        params: {},
        lists: Object.freeze([]),
      },
      {
        id: 'changed-records',
        name: '異動紀錄',
        right: 5,
        path: 'b.logs.index',
        params: {},
        lists: Object.freeze([]),
      },
      {
        id: 'account',
        name: '帳號管理',
        right: 1,
        path: 'b.user.index',
        params: { role: 1 },
        lists: Object.freeze([]),
      },
    ]),
  }),
  actions: {
    /**
     * 根據user的權限，過濾navLinks
     */
    navLinksByUser(user: any) {
      const { navLinks } = this;
      const { role } = user;
      const subLists = navLinks.reduce((acc: NavLink[], navLink: NavLink) => {
        // 如果navLink的權限小於user的權限，就不顯示
        if (navLink.right < role) return acc;

        // 如果navLink沒有lists，就直接顯示
        if (!navLink.lists.length) {
          acc.push(navLink);
          return acc;
        }

        // 如果navLink有lists，就過濾lists
        const lists = navLink.lists.filter((list: NavLink) => list.right >= role);
        acc.push(...lists);
        return acc;
      }, []);

      return subLists;
    },

    /**
     * 從navLinks組合出lists的路由陣列
     */
    getListsRoutes(user: any) {
      const { navLinks } = this;
      const { role } = user;
      const newNavLinks = navLinks.filter((navLink: NavLink) => navLink.right >= role);
      return newNavLinks;
    },

    /**
     * 透過目前的組件資料夾名稱，回傳對應的id
     * @param {string} folderName 組件資料夾名稱
     * @returns {string} id 路由區塊id
     */
    getNavIdByFolderName(folderName: string): string {
      const rule = [
        { folder: 'AccountFolder', id: 'account' },
        { folder: 'CaseApplyFolder', id: 'case-apply' },
      ];

      const ruleItem = rule.find((item) => folderName.includes(item.folder));
      return ruleItem?.id ?? '';
    },
  },
});
