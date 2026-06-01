<template>
  <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
    <h2 class="text-lg font-semibold text-gray-800">{{ pageTitle }}</h2>
    <div class="flex items-center gap-3">
      <div class="w-8 h-8 bg-sky-500 rounded-full flex items-center justify-center text-white text-sm font-semibold">
        {{ userInitial }}
      </div>
      <span class="text-sm text-gray-600">{{ authStore.user?.name || 'Admin' }}</span>
    </div>
  </header>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const route = useRoute()
const authStore = useAuthStore()

const titleMap = {
  'dashboard': 'Dashboard',
  'admin-news': '最新消息管理',
  'admin-services': '服務項目管理',
  'admin-contacts': '聯絡詢問管理',
}

const pageTitle = computed(() => titleMap[route.name] || 'NexCore 管理後台')
const userInitial = computed(() => (authStore.user?.name?.[0] || 'A').toUpperCase())
</script>
