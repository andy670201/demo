<template>
  <div class="space-y-6">
    <h2 class="text-xl font-semibold text-gray-800">聯絡詢問管理</h2>

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
      <DataTable :columns="columns" :data="contacts">
        <template #is_read="{ value }">
          <span :class="['px-2 py-1 rounded-full text-xs font-medium', value ? 'bg-gray-100 text-gray-500' : 'bg-red-100 text-red-600']">
            {{ value ? '已讀' : '未讀' }}
          </span>
        </template>
        <template #created_at="{ value }">{{ formatDate(value) }}</template>
        <template #actions="{ row }">
          <div class="flex gap-2">
            <button @click="viewContact(row)" class="text-sky-500 hover:text-sky-700 text-sm font-medium">查看</button>
            <button v-if="!row.is_read" @click="markRead(row)" class="text-green-500 hover:text-green-700 text-sm font-medium">標記已讀</button>
          </div>
        </template>
      </DataTable>
    </div>

    <!-- View Modal -->
    <div v-if="viewItem" class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
          <h3 class="font-semibold text-gray-800 text-lg">詢問詳情</h3>
          <button @click="viewItem = null" class="text-gray-400 hover:text-gray-600 text-xl">✕</button>
        </div>
        <div class="p-6 space-y-4">
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="text-xs text-gray-400 uppercase">姓名</label>
              <p class="text-gray-800 font-medium mt-1">{{ viewItem.name }}</p>
            </div>
            <div>
              <label class="text-xs text-gray-400 uppercase">Email</label>
              <p class="text-gray-800 font-medium mt-1">{{ viewItem.email }}</p>
            </div>
          </div>
          <div>
            <label class="text-xs text-gray-400 uppercase">主旨</label>
            <p class="text-gray-800 font-medium mt-1">{{ viewItem.subject }}</p>
          </div>
          <div>
            <label class="text-xs text-gray-400 uppercase">訊息內容</label>
            <p class="text-gray-700 mt-1 leading-relaxed whitespace-pre-line">{{ viewItem.message }}</p>
          </div>
          <div class="flex items-center justify-between pt-2">
            <span class="text-gray-400 text-sm">{{ formatDate(viewItem.created_at) }}</span>
            <button v-if="!viewItem.is_read" @click="markRead(viewItem)"
              class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors">
              標記已讀
            </button>
            <span v-else class="bg-gray-100 text-gray-500 px-4 py-2 rounded-xl text-sm">已讀</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import DataTable from '@/components/admin/DataTable.vue'
import { adminListContacts, markContactRead } from '@/api/contacts'

const contacts = ref([])
const viewItem = ref(null)

const columns = [
  { key: 'name', label: '姓名' },
  { key: 'email', label: 'Email' },
  { key: 'subject', label: '主旨' },
  { key: 'created_at', label: '時間' },
  { key: 'is_read', label: '狀態' },
]

const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('zh-TW')
}

const viewContact = (item) => { viewItem.value = item }

const markRead = async (item) => {
  try {
    await markContactRead(item.id)
    item.is_read = true
    if (viewItem.value?.id === item.id) viewItem.value.is_read = true
  } catch {}
}

onMounted(async () => {
  try { contacts.value = await adminListContacts() } catch {}
})
</script>
