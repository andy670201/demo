<template>
  <div class="min-h-screen bg-gray-950 flex items-center justify-center px-4">
    <div class="w-full max-w-md">
      <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-white">
          <span class="text-sky-400">Nex</span>Core
        </h1>
        <p class="text-gray-400 mt-2">管理後台登入</p>
      </div>

      <div class="bg-gray-900 border border-gray-800 rounded-2xl p-8">
        <form @submit.prevent="handleLogin" class="space-y-6">
          <div>
            <label class="block text-gray-300 text-sm font-medium mb-2">帳號</label>
            <input v-model="form.email" type="text" required placeholder="admin"
              class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-sky-500 transition-colors placeholder-gray-500" />
          </div>
          <div>
            <label class="block text-gray-300 text-sm font-medium mb-2">密碼</label>
            <input v-model="form.password" type="password" required placeholder="••••••••"
              class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-sky-500 transition-colors placeholder-gray-500" />
          </div>

          <div v-if="error" class="bg-red-500/10 border border-red-500/30 rounded-xl p-4 text-red-400 text-sm">
            {{ error }}
          </div>

          <button type="submit" :disabled="loading"
            class="w-full bg-sky-500 hover:bg-sky-600 disabled:bg-sky-800 text-white py-3 rounded-xl font-semibold transition-colors flex items-center justify-center gap-2">
            <span v-if="loading" class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
            {{ loading ? '登入中...' : '登入' }}
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const router = useRouter()
const authStore = useAuthStore()

const form = reactive({ email: '', password: '' })
const loading = ref(false)
const error = ref('')

const handleLogin = async () => {
  loading.value = true
  error.value = ''
  try {
    await authStore.login(form.email, form.password)
    router.push('/admin')
  } catch (e) {
    error.value = e.response?.data?.message || '登入失敗，請確認帳號密碼。'
  } finally {
    loading.value = false
  }
}
</script>
