<template>
  <div class="pt-16 min-h-screen bg-gray-950">
    <div v-if="loading" class="flex items-center justify-center py-32">
      <div class="w-8 h-8 border-2 border-sky-500 border-t-transparent rounded-full animate-spin"></div>
    </div>

    <div v-else-if="article" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <RouterLink to="/news" class="inline-flex items-center text-sky-400 hover:text-sky-300 mb-8 transition-colors">
        ← 返回列表
      </RouterLink>

      <article>
        <div class="text-sky-400 text-sm mb-4">{{ formatDate(article.published_at) }}</div>
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-8">{{ article.title }}</h1>

        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-8 mb-8">
          <p class="text-gray-300 text-lg font-medium">{{ article.summary }}</p>
        </div>

        <div class="prose prose-invert max-w-none">
          <p class="text-gray-300 leading-relaxed text-lg whitespace-pre-line">{{ article.content }}</p>
        </div>
      </article>
    </div>

    <div v-else class="text-center py-32 text-gray-400">
      <p class="text-2xl mb-4">找不到此篇文章</p>
      <RouterLink to="/news" class="text-sky-400 hover:text-sky-300">返回新聞列表</RouterLink>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { getNewsDetail } from '@/api/news'

const route = useRoute()
const article = ref(null)
const loading = ref(true)

const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('zh-TW', { year: 'numeric', month: 'long', day: 'numeric' })
}

onMounted(async () => {
  try {
    article.value = await getNewsDetail(route.params.slug)
  } catch {
    article.value = null
  } finally {
    loading.value = false
  }
})
</script>
