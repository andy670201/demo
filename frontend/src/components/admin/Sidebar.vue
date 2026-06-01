<template>
  <aside class="w-64 bg-gray-900 text-white flex flex-col shadow-xl">
    <div class="p-6 border-b border-gray-700">
      <h1 class="text-lg font-bold">
        <span class="text-sky-400">Nex</span>Core
      </h1>
      <p class="text-gray-400 text-xs mt-1">管理後台</p>
    </div>

    <nav class="flex-1 p-4 space-y-1">
      <RouterLink v-for="item in navItems" :key="item.to" :to="item.to"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-400 hover:bg-gray-800 hover:text-white transition-all text-sm"
        active-class="bg-sky-500/10 text-sky-400 border border-sky-500/30">
        <span class="text-lg">{{ item.icon }}</span>
        <span>{{ item.label }}</span>
        <span v-if="item.badge && unreadCount > 0"
          class="ml-auto bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
          {{ unreadCount }}
        </span>
      </RouterLink>
    </nav>

    <div class="p-4 border-t border-gray-700">
      <button @click="handleLogout"
        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-400 hover:bg-red-500/10 hover:text-red-400 transition-all text-sm">
        <span>🚪</span>
        <span>登出</span>
      </button>
    </div>
  </aside>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import api from '@/api/axios'

const router = useRouter()
const authStore = useAuthStore()
const unreadCount = ref(0)

const navItems = [
  { to: '/admin', icon: '📊', label: 'Dashboard', exact: true },
  { to: '/admin/news', icon: '📰', label: '最新消息' },
  { to: '/admin/services', icon: '💼', label: '服務項目' },
  { to: '/admin/contacts', icon: '✉️', label: '聯絡詢問', badge: true },
]

const handleLogout = async () => {
  await authStore.logout()
  router.push('/admin/login')
}

onMounted(async () => {
  try {
    const res = await api.get('/api/admin/dashboard')
    unreadCount.value = res.data.unread_contacts || 0
  } catch {}
})
</script>
