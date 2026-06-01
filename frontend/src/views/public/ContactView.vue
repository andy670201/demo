<template>
  <div class="pt-16">
    <section class="py-24 bg-gray-950 min-h-screen">
      <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">聯絡<span class="text-sky-400">我們</span></h1>
          <p class="text-gray-400 text-lg">有任何問題或合作需求，歡迎與我們聯繫。</p>
        </div>

        <div v-if="submitted" class="bg-sky-500/10 border border-sky-500/30 rounded-2xl p-12 text-center">
          <div class="text-6xl mb-6">✅</div>
          <h2 class="text-2xl font-bold text-white mb-4">感謝您的聯繫！</h2>
          <p class="text-gray-400 mb-8">我們已收到您的訊息，將在 1-2 個工作天內與您聯繫。</p>
          <button @click="submitted = false"
            class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-3 rounded-xl transition-colors">
            再次聯絡
          </button>
        </div>

        <form v-else @submit.prevent="handleSubmit"
          class="bg-gray-900 border border-gray-800 rounded-2xl p-8 space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-gray-300 text-sm font-medium mb-2">姓名 *</label>
              <input v-model="form.name" type="text" required placeholder="請輸入您的姓名"
                class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-sky-500 transition-colors placeholder-gray-500" />
            </div>
            <div>
              <label class="block text-gray-300 text-sm font-medium mb-2">Email *</label>
              <input v-model="form.email" type="email" required placeholder="your@email.com"
                class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-sky-500 transition-colors placeholder-gray-500" />
            </div>
          </div>
          <div>
            <label class="block text-gray-300 text-sm font-medium mb-2">主旨 *</label>
            <input v-model="form.subject" type="text" required placeholder="請輸入聯絡主旨"
              class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-sky-500 transition-colors placeholder-gray-500" />
          </div>
          <div>
            <label class="block text-gray-300 text-sm font-medium mb-2">訊息內容 *</label>
            <textarea v-model="form.message" required rows="6" placeholder="請輸入您的訊息..."
              class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-sky-500 transition-colors placeholder-gray-500 resize-none"></textarea>
          </div>
          <div v-if="error" class="bg-red-500/10 border border-red-500/30 rounded-xl p-4 text-red-400 text-sm">
            {{ error }}
          </div>
          <button type="submit" :disabled="submitting"
            class="w-full bg-sky-500 hover:bg-sky-600 disabled:bg-sky-800 text-white py-4 rounded-xl font-semibold text-lg transition-colors flex items-center justify-center gap-2">
            <span v-if="submitting" class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
            {{ submitting ? '送出中...' : '送出訊息' }}
          </button>
        </form>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { submitContact } from '@/api/contacts'

const form = reactive({ name: '', email: '', subject: '', message: '' })
const submitted = ref(false)
const submitting = ref(false)
const error = ref('')

const handleSubmit = async () => {
  submitting.value = true
  error.value = ''
  try {
    await submitContact({ ...form })
    submitted.value = true
    Object.keys(form).forEach(k => form[k] = '')
  } catch (e) {
    error.value = e.response?.data?.message || '送出失敗，請稍後再試。'
  } finally {
    submitting.value = false
  }
}
</script>
