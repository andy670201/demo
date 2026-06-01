<template>
  <div class="pt-16">
    <section class="py-24 bg-gray-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">最新<span class="text-sky-400">消息</span></h1>
          <p class="text-gray-400 text-lg">掌握 NexCore 最新動態與科技資訊</p>
        </div>

        <div v-if="loading" class="text-center py-16">
          <div class="inline-block w-8 h-8 border-2 border-sky-500 border-t-transparent rounded-full animate-spin"></div>
        </div>

        <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <RouterLink v-for="item in news" :key="item.id" :to="`/news/${item.slug}`"
            class="bg-gray-900 border border-gray-800 hover:border-sky-500/50 rounded-2xl overflow-hidden transition-all hover:shadow-xl hover:shadow-sky-500/5 group">
            <div class="bg-gradient-to-br from-sky-900/30 to-blue-900/30 aspect-video flex items-center justify-center">
              <span class="text-5xl">📰</span>
            </div>
            <div class="p-6">
              <p class="text-sky-400 text-sm mb-3">{{ formatDate(item.published_at) }}</p>
              <h3 class="text-white font-semibold text-lg mb-3 group-hover:text-sky-400 transition-colors line-clamp-2">
                {{ item.title }}
              </h3>
              <p class="text-gray-400 text-sm line-clamp-3">{{ item.summary }}</p>
              <p class="text-sky-400 text-sm mt-4 group-hover:text-sky-300 transition-colors">閱讀更多 →</p>
            </div>
          </RouterLink>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getNews } from '@/api/news'

const news = ref([])
const loading = ref(true)

const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('zh-TW', { year: 'numeric', month: 'long', day: 'numeric' })
}

onMounted(async () => {
  try {
    news.value = await getNews()
  } finally {
    loading.value = false
  }
})
</script>
