<template>
  <div class="bg-gray-900 border border-gray-800 hover:border-sky-500/50 rounded-2xl p-6 transition-all hover:shadow-lg hover:shadow-sky-500/10 group">
    <div class="w-12 h-12 bg-sky-500/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-sky-500/20 transition-colors">
      <span class="text-sky-400 text-2xl">{{ iconMap[service.icon] || '⚡' }}</span>
    </div>
    <h3 class="text-white font-semibold text-lg mb-2">{{ service.title }}</h3>
    <p class="text-gray-400 text-sm leading-relaxed">{{ service.description }}</p>
  </div>
</template>

<script setup>
defineProps({
  service: { type: Object, required: true },
})

const iconMap = {
  Cloud: '☁️',
  Brain: '🧠',
  Shield: '🛡️',
  Database: '🗄️',
  Smartphone: '📱',
  Users: '👥',
}
</script>
