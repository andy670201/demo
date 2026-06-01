<template>
  <nav :class="['fixed top-0 left-0 right-0 z-50 transition-all duration-300', scrolled ? 'bg-gray-950/95 backdrop-blur-md shadow-lg' : 'bg-transparent']">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <RouterLink to="/" class="text-xl font-bold text-white">
          <span class="text-sky-400">Nex</span>Core Technology
        </RouterLink>

        <div class="hidden md:flex items-center space-x-8">
          <RouterLink v-for="link in navLinks" :key="link.to" :to="link.to"
            class="text-gray-300 hover:text-sky-400 transition-colors text-sm font-medium"
            active-class="text-sky-400">
            {{ link.label }}
          </RouterLink>
        </div>

        <RouterLink to="/admin/login"
          class="bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
          登入後台
        </RouterLink>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const scrolled = ref(false)

const navLinks = [
  { to: '/', label: '首頁' },
  { to: '/about', label: '關於' },
  { to: '/services', label: '服務' },
  { to: '/news', label: '最新消息' },
  { to: '/contact', label: '聯絡' },
]

const onScroll = () => { scrolled.value = window.scrollY > 20 }
onMounted(() => window.addEventListener('scroll', onScroll))
onUnmounted(() => window.removeEventListener('scroll', onScroll))
</script>
