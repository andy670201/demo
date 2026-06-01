<template>
  <div>
    <HeroBanner />

    <!-- Services Section -->
    <section class="py-24 bg-gray-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">核心服務</h2>
          <p class="text-gray-400 max-w-2xl mx-auto">從雲端到 AI，從資安到 ERP，我們提供全方位的企業科技解決方案。</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <ServiceCard v-for="service in services.slice(0, 3)" :key="service.id" :service="service" />
        </div>
        <div class="text-center mt-10">
          <RouterLink to="/services" class="text-sky-400 hover:text-sky-300 font-medium transition-colors">
            查看所有服務 →
          </RouterLink>
        </div>
      </div>
    </section>

    <!-- Stats Section -->
    <section class="py-24 bg-gradient-to-r from-sky-900/30 to-blue-900/30">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
          <div v-for="stat in stats" :key="stat.label" class="group">
            <div class="text-5xl font-bold text-sky-400 mb-2">
              <CountUp :end="stat.value" :suffix="stat.suffix" />
            </div>
            <p class="text-gray-300 text-lg">{{ stat.label }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- News Section -->
    <section class="py-24 bg-gray-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">最新消息</h2>
          <p class="text-gray-400">掌握 NexCore 最新動態與技術趨勢</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <RouterLink v-for="item in newsList.slice(0, 3)" :key="item.id" :to="`/news/${item.slug}`"
            class="bg-gray-900 border border-gray-800 hover:border-sky-500/50 rounded-2xl p-6 transition-all hover:shadow-lg group">
            <div class="text-sky-400 text-sm mb-3">{{ formatDate(item.published_at) }}</div>
            <h3 class="text-white font-semibold mb-2 group-hover:text-sky-400 transition-colors line-clamp-2">{{ item.title }}</h3>
            <p class="text-gray-400 text-sm line-clamp-3">{{ item.summary }}</p>
          </RouterLink>
        </div>
        <div class="text-center mt-10">
          <RouterLink to="/news" class="text-sky-400 hover:text-sky-300 font-medium transition-colors">
            查看所有消息 →
          </RouterLink>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import HeroBanner from '@/components/public/HeroBanner.vue'
import ServiceCard from '@/components/public/ServiceCard.vue'
import { getServices } from '@/api/services'
import { getNews } from '@/api/news'

const services = ref([])
const newsList = ref([])

const stats = [
  { value: 10, suffix: '年', label: '深耕產業' },
  { value: 500, suffix: '+', label: '服務客戶' },
  { value: 50, suffix: '+', label: '專業團隊' },
]

const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('zh-TW', { year: 'numeric', month: 'long', day: 'numeric' })
}

onMounted(async () => {
  try {
    [services.value, newsList.value] = await Promise.all([getServices(), getNews()])
  } catch {}
})

// Simple CountUp component
const CountUp = {
  props: { end: Number, suffix: String },
  setup(props) {
    const current = ref(0)
    onMounted(() => {
      const step = Math.ceil(props.end / 60)
      const timer = setInterval(() => {
        current.value = Math.min(current.value + step, props.end)
        if (current.value >= props.end) clearInterval(timer)
      }, 30)
    })
    return () => `${current.value}${props.suffix || ''}`
  }
}
</script>
