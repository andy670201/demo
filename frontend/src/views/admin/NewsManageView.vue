<template>
  <div class="space-y-6">
    <div class="flex items-center justify-between">
      <h2 class="text-xl font-semibold text-gray-800">最新消息管理</h2>
      <button @click="openCreate"
        class="bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors">
        + 新增文章
      </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
      <DataTable :columns="columns" :data="news">
        <template #is_published="{ value }">
          <span :class="['px-2 py-1 rounded-full text-xs font-medium', value ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500']">
            {{ value ? '已發布' : '草稿' }}
          </span>
        </template>
        <template #created_at="{ value }">{{ formatDate(value) }}</template>
        <template #actions="{ row }">
          <div class="flex gap-2">
            <button @click="openEdit(row)" class="text-sky-500 hover:text-sky-700 text-sm font-medium">編輯</button>
            <button @click="confirmDelete(row)" class="text-red-500 hover:text-red-700 text-sm font-medium">刪除</button>
          </div>
        </template>
      </DataTable>
    </div>

    <!-- Modal -->
    <div v-if="showModal" class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto shadow-2xl">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
          <h3 class="font-semibold text-gray-800 text-lg">{{ editItem ? '編輯文章' : '新增文章' }}</h3>
          <button @click="showModal = false" class="text-gray-400 hover:text-gray-600 text-xl">✕</button>
        </div>
        <form @submit.prevent="handleSave" class="p-6 space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">標題</label>
            <input v-model="form.title" required class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:border-sky-500 text-sm" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">摘要</label>
            <input v-model="form.summary" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:border-sky-500 text-sm" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">內容</label>
            <textarea v-model="form.content" required rows="8" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:border-sky-500 text-sm resize-none"></textarea>
          </div>
          <div class="flex items-center gap-2">
            <input v-model="form.is_published" type="checkbox" id="is_published" class="rounded" />
            <label for="is_published" class="text-sm text-gray-700">立即發布</label>
          </div>
          <div class="flex gap-3 pt-2">
            <button type="submit" :disabled="saving"
              class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition-colors">
              {{ saving ? '儲存中...' : '儲存' }}
            </button>
            <button type="button" @click="showModal = false" class="border border-gray-300 text-gray-700 px-6 py-2.5 rounded-xl text-sm font-medium hover:bg-gray-50 transition-colors">
              取消
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Delete Dialog -->
    <div v-if="deleteItem" class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-2xl w-full max-w-sm p-6 shadow-2xl">
        <h3 class="font-semibold text-gray-800 text-lg mb-3">確認刪除</h3>
        <p class="text-gray-500 text-sm mb-6">確定要刪除「{{ deleteItem.title }}」嗎？此操作無法復原。</p>
        <div class="flex gap-3">
          <button @click="handleDelete"
            class="bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-colors">
            確認刪除
          </button>
          <button @click="deleteItem = null" class="border border-gray-300 text-gray-700 px-5 py-2.5 rounded-xl text-sm font-medium hover:bg-gray-50 transition-colors">
            取消
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'
import DataTable from '@/components/admin/DataTable.vue'
import { adminGetNews, createNews, updateNews, deleteNews } from '@/api/news'

const news = ref([])
const showModal = ref(false)
const editItem = ref(null)
const deleteItem = ref(null)
const saving = ref(false)
const form = reactive({ title: '', summary: '', content: '', is_published: true })

const columns = [
  { key: 'title', label: '標題' },
  { key: 'is_published', label: '狀態' },
  { key: 'created_at', label: '建立日期' },
]

const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('zh-TW')
}

const openCreate = () => {
  editItem.value = null
  Object.assign(form, { title: '', summary: '', content: '', is_published: true })
  showModal.value = true
}

const openEdit = (item) => {
  editItem.value = item
  Object.assign(form, { title: item.title, summary: item.summary || '', content: item.content, is_published: item.is_published })
  showModal.value = true
}

const confirmDelete = (item) => {
  deleteItem.value = item
}

const handleSave = async () => {
  saving.value = true
  try {
    if (editItem.value) {
      await updateNews(editItem.value.id, { ...form })
    } else {
      await createNews({ ...form })
    }
    news.value = await adminGetNews()
    showModal.value = false
  } catch {} finally {
    saving.value = false
  }
}

const handleDelete = async () => {
  try {
    await deleteNews(deleteItem.value.id)
    news.value = await adminGetNews()
    deleteItem.value = null
  } catch {}
}

onMounted(async () => {
  try {
    news.value = await adminGetNews()
  } catch {}
})
</script>
