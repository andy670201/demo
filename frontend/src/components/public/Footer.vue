<template>
  <footer class="bg-gray-950 border-t border-gray-800 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
          <h3 class="text-xl font-bold text-white mb-4">
            <span class="text-sky-400">Nex</span>Core Technology
          </h3>
          <p class="text-gray-400 text-sm">創新驅動未來，科技賦能企業成長。</p>
        </div>
        <div>
          <h4 class="text-white font-semibold mb-4">快速連結</h4>
          <ul class="space-y-2">
            <li v-for="link in links" :key="link.to">
              <RouterLink :to="link.to" class="text-gray-400 hover:text-sky-400 text-sm transition-colors">
                {{ link.label }}
              </RouterLink>
            </li>
          </ul>
        </div>
        <div>
          <h4 class="text-white font-semibold mb-4">聯絡資訊</h4>
          <p class="text-gray-400 text-sm">info@nexcore.com</p>
          <p class="text-gray-400 text-sm mt-1">台北市信義區科技路 100 號</p>
        </div>
      </div>
      <div class="border-t border-gray-800 mt-8 pt-8 text-center">
        <p class="text-gray-500 text-sm">© 2024 NexCore Technology. All rights reserved.</p>
      </div>
    </div>
  </footer>
</template>

<script setup>
const links = [
  { to: '/', label: '首頁' },
  { to: '/about', label: '關於我們' },
  { to: '/services', label: '服務項目' },
  { to: '/news', label: '最新消息' },
  { to: '/contact', label: '聯絡我們' },
]
</script>
