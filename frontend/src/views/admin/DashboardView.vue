<template>
  <div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
      <div v-for="card in statCards" :key="card.label"
        :class="['bg-white rounded-2xl p-6 border-l-4 shadow-sm', card.border]">
        <div class="flex items-center justify-between mb-4">
          <div :class="['w-12 h-12 rounded-xl flex items-center justify-center text-2xl', card.bg]">
            {{ card.icon }}
          </div>
        </div>
        <p class="text-gray-500 text-sm">{{ card.label }}</p>
        <p class="text-3xl font-bold text-gray-800 mt-1">
          {{ stats ? stats[card.key] : '...' }}
        </p>
      </div>
    </div>

    <!-- Recent Contacts -->
    <div class="bg-white rounded-2xl shadow-sm p-6">
      <h3 class="text-lg font-semibold text-gray-800 mb-4">最近詢問</h3>
      <div v-if="contacts.length === 0" class="text-center py-8 text-gray-400">暫無詢問</div>
      <div v-else class="space-y-3">
        <div v-for="contact in contacts.slice(0, 5)" :key="contact.id"
          class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
          <div>
            <p class="font-medium text-gray-800">{{ contact.name }}</p>
            <p class="text-gray-500 text-sm">{{ contact.subject }}</p>
          </div>
          <div class="text-right">
            <p class="text-gray-400 text-sm">{{ formatDate(contact.created_at) }}</p>
            <span :class="['text-xs px-2 py-1 rounded-full', contact.is_read ? 'bg-gray-100 text-gray-500' : 'bg-red-100 text-red-600']">
              {{ contact.is_read ? '已讀' : '未讀' }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '@/api/axios'
import { adminListContacts } from '@/api/contacts'

const stats = ref(null)
const contacts = ref([])

const statCards = [
  { key: 'news_count', label: '文章總數', icon: '📰', border: 'border-blue-500', bg: 'bg-blue-50' },
  { key: 'services_count', label: '服務項目', icon: '💼', border: 'border-green-500', bg: 'bg-green-50' },
  { key: 'unread_contacts', label: '未讀詢問', icon: '🔔', border: 'border-red-500', bg: 'bg-red-50' },
  { key: 'total_contacts', label: '總詢問數', icon: '✉️', border: 'border-gray-400', bg: 'bg-gray-50' },
]

const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('zh-TW', { month: 'short', day: 'numeric' })
}

onMounted(async () => {
  try {
    const [dashRes, contactsRes] = await Promise.all([
      api.get('/api/admin/dashboard'),
      adminListContacts(),
    ])
    stats.value = dashRes.data
    contacts.value = contactsRes
  } catch {}
})
</script>
