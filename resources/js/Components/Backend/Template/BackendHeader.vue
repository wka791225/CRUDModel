<!-- 後臺頁首組件 -->

<script setup>
import { usePage } from '@inertiajs/vue3';
import logoDigiPack from '/images/logo/logo-palace-museum.webp';
const { getListsRoutes } = useBackendRouteStore();
const user = computed(() => usePage().props.auth.user);
const showingNavigationDropdown = ref(false);
const openList = ref('');
const openSwitch = (name) => {
  openList.value = openList.value === '' ? name : '';
};
</script>

<template>
  <nav class="bg-white border-b border-gray-100 text-lg shadow-md shadow-main-white-gray">
    <!-- Primary Navigation Menu -->
    <div class="max-w-10xl mx-auto px-4 sm:px-6 lg:px-10">
      <div class="flex justify-between  py-6">
        <div class="flex  w-full justify-between">
          <!-- Logo -->
          <div class="flex items-center">
            <Link :href="route('f.home')" title="前往前臺首頁(跳轉頁面)">
              <img :src="logoDigiPack" alt="方塊LOGO" width="252" height="52">
            </Link>
          </div>
          <!-- Navigation Links -->
          <div class="flex w-[82%] justify-between items-center gap-6 " :class="{ '!justify-end': user.role === 3 }">
            <div v-if="user.role !== 3" class="flex gap-10 text-[28px] ">
              <span v-for="list in getListsRoutes(user)" :key="list.id" class="relative">
                <Link v-if="list.path" @click="openSwitch(list.name)" :href="route(list.path)" :title="`前往${list.name}(跳轉頁面)`">{{ list.name }}</Link>
                <button type="button" v-else @click="openSwitch(list.name)">{{ list.name }}</button>
                <div v-if="openList === list.name && !list.path " class="absolute z-10 top-12 w-[calc(100%+30px)] flex flex-col gap-4 p-2 bg-white ">
                  <span v-for="downList in list.lists" :key="downList.id" class="block">
                    <Link v-if="downList.path" :href="route(downList.path)" class="w-full inline-block" @click="openSwitch(list.name)" :title="`前往${list.name}(跳轉頁面)`">{{ downList.name }}</Link>
                    <div v-else>{{ downList.name }}</div>
                  </span>
                </div>
              </span>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ms-6">
              <!-- Settings Dropdown -->
              <div class="ms-3 relative">
                <BackendDropdown>
                  <template #trigger>
                    <span class="inline-flex rounded-md text-[28px] font-bold">
                      <button
                        type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent leading-4 font-medium rounded-md text-black bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                      >
                        {{ $page.props.auth.user.name }}

                        <svg
                          class="ms-2 -me-0.5 h-4 w-4"
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                          />
                        </svg>
                      </button>
                    </span>
                  </template>

                  <template #content>
                    <!-- <Link :href="route('b.password.edit')" title="前往修改密碼" class="dropdown-link text-[28px] font-bold">
                      修改密碼
                    </Link> -->
                    <Link :href="route('logout')" method="post" as="button" class="dropdown-link text-[28px] font-bold">
                      登出
                    </Link>
                  </template>
                </BackendDropdown>
              </div>
            </div>
          </div>
        </div>

        <!-- Hamburger -->
        <div class="-me-2 flex items-center sm:hidden">
          <button
            type="button"
            @click="showingNavigationDropdown = !showingNavigationDropdown"
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
          >
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
              <path
                :class="{
                  hidden: showingNavigationDropdown,
                  'inline-flex': !showingNavigationDropdown,
                }"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              />
              <path
                :class="{
                  hidden: !showingNavigationDropdown,
                  'inline-flex': showingNavigationDropdown,
                }"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div
      :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
      class="sm:hidden"
    >
      <div class="pt-2 pb-3 space-y-1">
        <ResponsiveNavLink :href="route('b.dashboard')" :active="route().current('b.dashboard')">
          Dashboard
        </ResponsiveNavLink>
      </div>

      <!-- Responsive Settings Options -->
      <div class="pt-4 pb-1 border-t border-gray-200">
        <div class="px-4">
          <div class="font-medium text-base text-gray-800">
            {{ $page.props.auth.user.name }}
          </div>
          <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
        </div>

        <div class="mt-3 space-y-1">
          <!-- <ResponsiveNavLink :href="route('b.password.edit')" method="post" as="button">
            修改密碼
          </ResponsiveNavLink> -->
          <ResponsiveNavLink :href="route('logout')" method="post" as="button">
            登出
          </ResponsiveNavLink>
        </div>
      </div>
    </div>
  </nav>
</template>

<style scoped>
.dropdown-link {
  @apply block w-full px-4 py-2 text-left leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out;
}
</style>
