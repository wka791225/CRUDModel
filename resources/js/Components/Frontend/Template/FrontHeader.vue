<!-- 前台header -->
<script setup>
import museumLogo from '/images/logo/logo-palace-museum.webp';
import menuIcon from '/images/frontend/icon/icon-menu.webp';
import closeIcon from '/images/frontend/icon/icon-close.webp';
import { usePage } from '@inertiajs/vue3';

const user = computed(() => usePage().props.auth.user);
const smm = computed(() => usePage().props.smm?.smm ?? '');
const showNav = ref(false);
const showMember = ref(false);
const navOpacity = ref(false);

const listButton = () => {
  showNav.value = !showNav.value;
};

const openMember = () => {
  showMember.value = !showMember.value;
};

onMounted(() => {
  nextTick(() => {
    const bannerEl = useElementStore().indexBanner;
    if (bannerEl) {
      const initObserverBanner = new IntersectionObserver((entries) => {
        const entryBanner = entries[0];
        navOpacity.value = entryBanner.isIntersecting;
      });
      initObserverBanner.observe(bannerEl);
    }
  });
});
</script>

<template>
  <div>
    <header class="fixed left-0 w-full z-[1]">
      <div class="w-full md:px-10 p-4 flex items-center justify-between bg-[#F8F8F8] shadow-main" :class="{ 'md:bg-[#F8F8F8]/0': navOpacity, 'md:shadow-transparent': navOpacity }">
        <a :href="route('f.home')" title="首頁(跳轉頁面)">
          <figure class="md:w-auto w-[187px]">
            <img :src="museumLogo" alt="國立故宮博物院標誌">
          </figure>
        </a>
        <div class="flex md:gap-5">
          <a v-show="smm?.live_stream_link ?? ''" :href="smm?.live_stream_link ?? ''" target="_blank">
            <NavButton class="bg-white/25 md:flex hidden duration-300">
              <span class="btn-text">Live</span>
            </NavButton>
          </a>
          <a v-show="smm?.fb_link ?? ''" :href="smm?.fb_link ?? ''" target="_blank">
            <span class="hidden">fb</span>
            <NavButton class="bg-white/25 md:flex hidden duration-300">
              <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M36 18.1103C36 8.1068 27.9405 -0.00219727 18 -0.00219727C8.055 5.27345e-05 -0.00450134 8.1068 -0.00450134 18.1126C-0.00450134 27.1508 6.579 34.6433 15.183 36.0023V23.3461H10.6155V18.1126H15.1875V14.1188C15.1875 9.58055 17.8762 7.07405 21.987 7.07405C23.958 7.07405 26.0167 7.4273 26.0167 7.4273V11.8823H23.7465C21.5122 11.8823 20.8147 13.2796 20.8147 14.7128V18.1103H25.8052L25.0087 23.3438H20.8125V36.0001C29.4165 34.6411 36 27.1486 36 18.1103Z" fill="#00908D" />
              </svg>
            </NavButton>
          </a>
          <a v-show="smm?.ig_link ?? ''" :href="smm?.ig_link ?? ''" target="_blank">
            <span class="hidden">ig</span>
            <NavButton class="bg-white/25 md:flex hidden duration-300">
              <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 0C13.1152 0 12.501 0.0225 10.5817 0.108C8.6625 0.198 7.35525 0.4995 6.21 0.945C5.00871 1.39684 3.92061 2.10561 3.02175 3.02175C2.10617 3.92107 1.39749 5.00904 0.945 6.21C0.4995 7.353 0.19575 8.6625 0.108 10.575C0.0225 12.4987 0 13.1108 0 18.0023C0 22.8893 0.0225 23.5013 0.108 25.4205C0.198 27.3375 0.4995 28.6447 0.945 29.79C1.40625 30.9735 2.0205 31.977 3.02175 32.9782C4.02075 33.9795 5.02425 34.596 6.20775 35.055C7.35525 35.5005 8.66025 35.8042 10.5773 35.892C12.4988 35.9775 13.1108 36 18 36C22.8892 36 23.499 35.9775 25.4205 35.892C27.3353 35.802 28.647 35.5005 29.7922 35.055C30.9928 34.6029 32.0801 33.8942 32.9782 32.9782C33.9795 31.977 34.5938 30.9735 35.055 29.79C35.4982 28.6447 35.802 27.3375 35.892 25.4205C35.9775 23.5013 36 22.8892 36 18C36 13.1108 35.9775 12.4988 35.892 10.5773C35.802 8.6625 35.4982 7.353 35.055 6.21C34.6026 5.00901 33.8939 3.92102 32.9782 3.02175C32.0797 2.10527 30.9915 1.39645 29.79 0.945C28.6425 0.4995 27.333 0.19575 25.4182 0.108C23.4967 0.0225 22.887 0 17.9955 0H18.0023H18ZM16.3867 3.2445H18.0023C22.8083 3.2445 23.3775 3.26025 25.2743 3.348C27.0292 3.42675 27.9832 3.7215 28.6178 3.96675C29.457 4.293 30.0578 4.6845 30.6877 5.3145C31.3177 5.9445 31.707 6.543 32.0333 7.3845C32.2808 8.01675 32.5732 8.97075 32.652 10.7257C32.7397 12.6225 32.7578 13.1918 32.7578 17.9955C32.7578 22.7992 32.7397 23.3707 32.652 25.2675C32.5732 27.0225 32.2785 27.9743 32.0333 28.6087C31.7447 29.3903 31.2841 30.097 30.6855 30.6765C30.0555 31.3065 29.457 31.6958 28.6155 32.022C27.9855 32.2695 27.0315 32.562 25.2743 32.643C23.3775 32.7285 22.8083 32.7487 18.0023 32.7487C13.1963 32.7487 12.6248 32.7285 10.728 32.643C8.973 32.562 8.02125 32.2695 7.38675 32.022C6.60487 31.7338 5.89753 31.2741 5.31675 30.6765C4.71769 30.0961 4.25638 29.3887 3.96675 28.6065C3.7215 27.9742 3.42675 27.0203 3.348 25.2653C3.2625 23.3685 3.2445 22.7992 3.2445 17.991C3.2445 13.185 3.2625 12.618 3.348 10.7212C3.429 8.96625 3.7215 8.01225 3.969 7.37775C4.29525 6.5385 4.68675 5.93775 5.31675 5.30775C5.94675 4.67775 6.54525 4.2885 7.38675 3.96225C8.02125 3.71475 8.973 3.42225 10.728 3.34125C12.3885 3.26475 13.032 3.24225 16.3867 3.24V3.2445ZM27.6097 6.2325C27.3261 6.2325 27.0452 6.28837 26.7832 6.39692C26.5211 6.50547 26.283 6.66457 26.0824 6.86515C25.8818 7.06572 25.7227 7.30384 25.6142 7.5659C25.5056 7.82797 25.4497 8.10884 25.4497 8.3925C25.4497 8.67616 25.5056 8.95703 25.6142 9.2191C25.7227 9.48116 25.8818 9.71928 26.0824 9.91985C26.283 10.1204 26.5211 10.2795 26.7832 10.3881C27.0452 10.4966 27.3261 10.5525 27.6097 10.5525C28.1826 10.5525 28.732 10.3249 29.1371 9.91985C29.5422 9.51477 29.7698 8.96537 29.7698 8.3925C29.7698 7.81963 29.5422 7.27023 29.1371 6.86515C28.732 6.46007 28.1826 6.2325 27.6097 6.2325ZM18.0023 8.757C16.7762 8.73787 15.5585 8.96284 14.4202 9.41882C13.2819 9.87479 12.2457 10.5527 11.3718 11.413C10.498 12.2732 9.80407 13.2988 9.33039 14.4298C8.85672 15.5609 8.61278 16.7749 8.61278 18.0011C8.61278 19.2274 8.85672 20.4414 9.33039 21.5724C9.80407 22.7035 10.498 23.729 11.3718 24.5893C12.2457 25.4496 13.2819 26.1275 14.4202 26.5834C15.5585 27.0394 16.7762 27.2644 18.0023 27.2453C20.429 27.2074 22.7435 26.2168 24.4462 24.4873C26.1489 22.7578 27.1033 20.4281 27.1033 18.0011C27.1033 15.5741 26.1489 13.2444 24.4462 11.5149C22.7435 9.78545 20.429 8.79486 18.0023 8.757ZM18.0023 11.9993C19.5937 11.9993 21.1201 12.6315 22.2454 13.7568C23.3708 14.8822 24.003 16.4085 24.003 18C24.003 19.5915 23.3708 21.1178 22.2454 22.2432C21.1201 23.3685 19.5937 24.0007 18.0023 24.0007C16.4108 24.0007 14.8844 23.3685 13.7591 22.2432C12.6337 21.1178 12.0015 19.5915 12.0015 18C12.0015 16.4085 12.6337 14.8822 13.7591 13.7568C14.8844 12.6315 16.4108 11.9993 18.0023 11.9993Z" fill="#00908D" />
              </svg>
            </NavButton>
          </a>
          <NavButton class="flex items-center gap-2 bg-white/25 duration-300" @click="listButton()" @keydown.enter="showNav = !showNav">
            <span class="btn-text">選單</span>
            <img :src="menuIcon" alt="menu圖示">
          </NavButton>
        </div>
      </div>
    </header>
    <!-- NAV(側邊選單)  -->
    <div v-show="showNav" class="fixed w-dvw h-dvh bg-black/40 z-10" @click="listButton()" @keydown.enter="showNav = !showNav">
      <nav class="flex flex-col justify-between max-w-[375px] w-full h-dvh  text-white md:text-[28px] text-base bg-front-green-lake absolute right-0">
        <figure class="flex items-center justify-end gap-[10px] px-5 py-2 text-end border-b-2 border-white md:leading-[49px] cursor-pointer md:h-[75px] h-[64px]" @click.stop="listButton()" @keydown.enter="showNav = !showNav">
          <span>關閉選單</span>
          <img :src="closeIcon" alt="關閉圖示">
        </figure>
        <div class="flex flex-col text-center h-[calc(100%-150px)] overflow-y-scroll items-scroll">
          <a :href="route('f.home')" title="回首頁(跳轉頁面)" class="nav-item" @click.stop="listButton()" @keydown.enter="showNav = !showNav">回首頁</a>
          <Link :href="route('f.news.index')" title="最新消息(跳轉頁面)" class="nav-item" @click.stop="listButton()" @keydown.enter="showNav = !showNav">最新消息</Link>
          <Link :href="route('f.about')" title="關於競賽(跳轉頁面)" class="nav-item" @click.stop="listButton()" @keydown.enter="showNav = !showNav">關於競賽</Link>
          <Link :href="route('f.regulations')" title="參賽辦法(跳轉頁面)" class="nav-item" @click.stop="listButton()" @keydown.enter="showNav = !showNav">參賽辦法</Link>
          <Link :href="route('f.apply')" title="報名參賽(跳轉頁面)" class="nav-item" @click.stop="listButton()" @keydown.enter="showNav = !showNav">報名參賽</Link>
          <Link :href="route('f.lecture.index')" title="美學設計講座(跳轉頁面)" class="nav-item" @click.stop="listButton()" @keydown.enter="showNav = !showNav">美學設計講座</Link>
          <Link :href="route('f.evaluation')" title="關於評選(跳轉頁面)" class="nav-item" @click.stop="listButton()" @keydown.enter="showNav = !showNav">關於評選</Link>
          <Link :href="route('f.review')" title="評審團隊(跳轉頁面)" class="nav-item" @click.stop="listButton()" @keydown.enter="showNav = !showNav">評審團隊</Link>
          <Link :href="route('f.online-display')" title="線上展示(跳轉頁面)" class="nav-item" @click.stop="listButton()" @keydown.enter="showNav = !showNav">線上展示</Link>
          <Link :href="route('google.design')" title="線上展示(跳轉頁面)" class="nav-item" @click.stop="listButton()" @keydown.enter="showNav = !showNav">說好話，選LOGO</Link>
          <button v-if="user?.role === 4" type="button" class="nav-item flex justify-end md:gap-20 gap-24" @click.stop="openMember()" @keydown.enter="showMember = !showMember">
            會員中心
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
              <path v-show="!showMember" d="M14.1211 4.45312H15.8789C16.0352 4.45312 16.1133 4.53125 16.1133 4.6875V25.3125C16.1133 25.4688 16.0352 25.5469 15.8789 25.5469H14.1211C13.9648 25.5469 13.8867 25.4688 13.8867 25.3125V4.6875C13.8867 4.53125 13.9648 4.45312 14.1211 4.45312Z" fill="white" />
              <path d="M5.15625 13.8867H24.8438C25 13.8867 25.0781 13.9648 25.0781 14.1211V15.8789C25.0781 16.0352 25 16.1133 24.8438 16.1133H5.15625C5 16.1133 4.92188 16.0352 4.92188 15.8789V14.1211C4.92188 13.9648 5 13.8867 5.15625 13.8867Z" fill="white" />
            </svg>
          </button>
          <Link v-show="showMember" :href="route('f.member.index')" title="個人資料(跳轉頁面)" class="md:text-xl text-base py-2 hover:text-front-yellow" @click.stop="listButton()" @keydown.enter="showNav = !showNav">個人資料</Link>
          <Link v-show="showMember" :href="route('f.member.record')" title="我的投稿紀錄(跳轉頁面)" class="md:text-xl text-base py-2 hover:text-front-yellow" @click.stop="listButton()" @keydown.enter="showNav = !showNav">我的投稿紀錄</Link>
          <Link v-if="user" :href="route('f.member.logout')" title="登出(跳轉頁面)" class="nav-item" @click.stop="listButton()" @keydown.enter="showNav = !showNav">
            帳號登出
          </Link>
          <Link v-else :href="route('f.member.login')" title="登入/註冊(跳轉頁面)" class="nav-item" @click.stop="listButton()" @keydown.enter="showNav = !showNav">登入/註冊</Link>
        </div>
        <div class="flex justify-center w-full gap-3 border-t-2 border-white py-2 md:h-[75px] h-[64px]">
          <a v-show="smm?.live_stream_link ?? ''" :href="smm?.live_stream_link ?? ''" target="_blank">
            <NavButton class="border-[1.6px] border-white hover:border-front-dark-green-lake text-white hover:text-front-dark-green-lake duration-300 font-bold">
              <span>Live</span>
            </NavButton>
          </a>
          <a v-show="smm?.fb_link ?? ''" :href="smm?.fb_link ?? ''" target="_blank">
            <span class="hidden">fb</span>
            <NavButton class="nav-button border-[1.6px] border-white hover:border-front-dark-green-lake duration-300">
              <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M36 18.1103C36 8.1068 27.9405 -0.00219727 18 -0.00219727C8.055 5.27345e-05 -0.00450134 8.1068 -0.00450134 18.1126C-0.00450134 27.1508 6.579 34.6433 15.183 36.0023V23.3461H10.6155V18.1126H15.1875V14.1188C15.1875 9.58055 17.8762 7.07405 21.987 7.07405C23.958 7.07405 26.0167 7.4273 26.0167 7.4273V11.8823H23.7465C21.5122 11.8823 20.8147 13.2796 20.8147 14.7128V18.1103H25.8052L25.0087 23.3438H20.8125V36.0001C29.4165 34.6411 36 27.1486 36 18.1103Z" fill="#fff" />
              </svg>
            </NavButton>
          </a>
          <a v-show="smm?.ig_link ?? ''" :href="smm?.ig_link ?? ''" target="_blank">
            <span class="hidden">ig</span>
            <NavButton class="nav-button border-[1.6px] border-white hover:border-front-dark-green-lake duration-300">
              <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 0C13.1152 0 12.501 0.0225 10.5817 0.108C8.6625 0.198 7.35525 0.4995 6.21 0.945C5.00871 1.39684 3.92061 2.10561 3.02175 3.02175C2.10617 3.92107 1.39749 5.00904 0.945 6.21C0.4995 7.353 0.19575 8.6625 0.108 10.575C0.0225 12.4987 0 13.1108 0 18.0023C0 22.8893 0.0225 23.5013 0.108 25.4205C0.198 27.3375 0.4995 28.6447 0.945 29.79C1.40625 30.9735 2.0205 31.977 3.02175 32.9782C4.02075 33.9795 5.02425 34.596 6.20775 35.055C7.35525 35.5005 8.66025 35.8042 10.5773 35.892C12.4988 35.9775 13.1108 36 18 36C22.8892 36 23.499 35.9775 25.4205 35.892C27.3353 35.802 28.647 35.5005 29.7922 35.055C30.9928 34.6029 32.0801 33.8942 32.9782 32.9782C33.9795 31.977 34.5938 30.9735 35.055 29.79C35.4982 28.6447 35.802 27.3375 35.892 25.4205C35.9775 23.5013 36 22.8892 36 18C36 13.1108 35.9775 12.4988 35.892 10.5773C35.802 8.6625 35.4982 7.353 35.055 6.21C34.6026 5.00901 33.8939 3.92102 32.9782 3.02175C32.0797 2.10527 30.9915 1.39645 29.79 0.945C28.6425 0.4995 27.333 0.19575 25.4182 0.108C23.4967 0.0225 22.887 0 17.9955 0H18.0023H18ZM16.3867 3.2445H18.0023C22.8083 3.2445 23.3775 3.26025 25.2743 3.348C27.0292 3.42675 27.9832 3.7215 28.6178 3.96675C29.457 4.293 30.0578 4.6845 30.6877 5.3145C31.3177 5.9445 31.707 6.543 32.0333 7.3845C32.2808 8.01675 32.5732 8.97075 32.652 10.7257C32.7397 12.6225 32.7578 13.1918 32.7578 17.9955C32.7578 22.7992 32.7397 23.3707 32.652 25.2675C32.5732 27.0225 32.2785 27.9743 32.0333 28.6087C31.7447 29.3903 31.2841 30.097 30.6855 30.6765C30.0555 31.3065 29.457 31.6958 28.6155 32.022C27.9855 32.2695 27.0315 32.562 25.2743 32.643C23.3775 32.7285 22.8083 32.7487 18.0023 32.7487C13.1963 32.7487 12.6248 32.7285 10.728 32.643C8.973 32.562 8.02125 32.2695 7.38675 32.022C6.60487 31.7338 5.89753 31.2741 5.31675 30.6765C4.71769 30.0961 4.25638 29.3887 3.96675 28.6065C3.7215 27.9742 3.42675 27.0203 3.348 25.2653C3.2625 23.3685 3.2445 22.7992 3.2445 17.991C3.2445 13.185 3.2625 12.618 3.348 10.7212C3.429 8.96625 3.7215 8.01225 3.969 7.37775C4.29525 6.5385 4.68675 5.93775 5.31675 5.30775C5.94675 4.67775 6.54525 4.2885 7.38675 3.96225C8.02125 3.71475 8.973 3.42225 10.728 3.34125C12.3885 3.26475 13.032 3.24225 16.3867 3.24V3.2445ZM27.6097 6.2325C27.3261 6.2325 27.0452 6.28837 26.7832 6.39692C26.5211 6.50547 26.283 6.66457 26.0824 6.86515C25.8818 7.06572 25.7227 7.30384 25.6142 7.5659C25.5056 7.82797 25.4497 8.10884 25.4497 8.3925C25.4497 8.67616 25.5056 8.95703 25.6142 9.2191C25.7227 9.48116 25.8818 9.71928 26.0824 9.91985C26.283 10.1204 26.5211 10.2795 26.7832 10.3881C27.0452 10.4966 27.3261 10.5525 27.6097 10.5525C28.1826 10.5525 28.732 10.3249 29.1371 9.91985C29.5422 9.51477 29.7698 8.96537 29.7698 8.3925C29.7698 7.81963 29.5422 7.27023 29.1371 6.86515C28.732 6.46007 28.1826 6.2325 27.6097 6.2325ZM18.0023 8.757C16.7762 8.73787 15.5585 8.96284 14.4202 9.41882C13.2819 9.87479 12.2457 10.5527 11.3718 11.413C10.498 12.2732 9.80407 13.2988 9.33039 14.4298C8.85672 15.5609 8.61278 16.7749 8.61278 18.0011C8.61278 19.2274 8.85672 20.4414 9.33039 21.5724C9.80407 22.7035 10.498 23.729 11.3718 24.5893C12.2457 25.4496 13.2819 26.1275 14.4202 26.5834C15.5585 27.0394 16.7762 27.2644 18.0023 27.2453C20.429 27.2074 22.7435 26.2168 24.4462 24.4873C26.1489 22.7578 27.1033 20.4281 27.1033 18.0011C27.1033 15.5741 26.1489 13.2444 24.4462 11.5149C22.7435 9.78545 20.429 8.79486 18.0023 8.757ZM18.0023 11.9993C19.5937 11.9993 21.1201 12.6315 22.2454 13.7568C23.3708 14.8822 24.003 16.4085 24.003 18C24.003 19.5915 23.3708 21.1178 22.2454 22.2432C21.1201 23.3685 19.5937 24.0007 18.0023 24.0007C16.4108 24.0007 14.8844 23.3685 13.7591 22.2432C12.6337 21.1178 12.0015 19.5915 12.0015 18C12.0015 16.4085 12.6337 14.8822 13.7591 13.7568C14.8844 12.6315 16.4108 11.9993 18.0023 11.9993Z" fill="#fff" />
              </svg>
            </NavButton>
          </a>
        </div>
      </nav>
    </div>
  </div>
</template>

<style scoped>
.btn-text {
  @apply text-front-dark-green-lake md:text-[28px] text-xl md:leading-[33.6px] font-bold;
}

.nav-item {
  @apply md:text-[28px] text-xl font-bold px-5 py-3 hover:text-front-yellow;
}

.nav-button:hover svg path {
  fill: #00908D;
}

.items-scroll::-webkit-scrollbar {
  width: 7px;
}

.items-scroll::-webkit-scrollbar-button {
  background: transparent;
  border-radius: 4px;
}

.items-scroll::-webkit-scrollbar-track-piece {
  background: transparent;
}

.items-scroll::-webkit-scrollbar-thumb {
  border-radius: 4px;
  background-color: rgba(0, 0, 0, 0.4);
  border: 1px solid slategrey;
}

.items-scroll::-webkit-scrollbar-track {
  box-shadow: transparent;
}
</style>
