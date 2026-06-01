<template>
  <div class="pt-16">
    <section class="py-24 bg-gray-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">我們的<span class="text-sky-400">服務</span></h1>
          <p class="text-gray-400 text-lg max-w-2xl mx-auto">全方位企業科技解決方案，從規劃到落地，我們與您並肩同行。</p>
        </div>

        <div v-if="loading" class="text-center py-16">
          <div class="inline-block w-8 h-8 border-2 border-sky-500 border-t-transparent rounded-full animate-spin"></div>
        </div>

        <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <ServiceCard v-for="service in services" :key="service.id" :service="service" />
        </div>
      </div>
    </section>

    <section class="py-24 bg-gradient-to-r from-sky-900/30 to-blue-900/30">
      <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-6">準備好開始了嗎？</h2>
        <p class="text-gray-400 text-lg mb-8">聯絡我們的專業顧問，獲得量身訂製的解決方案。</p>
        <RouterLink to="/contact"
          class="bg-sky-500 hover:bg-sky-600 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all hover:scale-105 inline-block">
          免費諮詢
        </RouterLink>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import ServiceCard from '@/components/public/ServiceCard.vue'
import { getServices } from '@/api/services'

const services = ref([])
const loading = ref(true)

onMounted(async () => {
  try {
    services.value = await getServices()
  } finally {
    loading.value = false
  }
})
</script>
