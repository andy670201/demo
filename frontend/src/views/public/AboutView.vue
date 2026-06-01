<template>
  <div class="pt-16">
    <!-- Hero -->
    <section class="py-24 bg-gradient-to-b from-gray-900 to-gray-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
          <div>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">關於 <span class="text-sky-400">NexCore</span></h1>
            <p class="text-gray-400 text-lg mb-6 leading-relaxed">
              NexCore Technology 成立於 2014 年，是台灣領先的企業科技服務公司。我們專注於為企業提供雲端運算、人工智慧、資訊安全及企業軟體等全方位解決方案。
            </p>
            <p class="text-gray-400 text-lg leading-relaxed">
              十年來，我們已協助超過 500 家企業完成數位轉型，從初創公司到上市集團，NexCore 始終是企業最信賴的科技夥伴。
            </p>
          </div>
          <div class="bg-gradient-to-br from-sky-900/30 to-blue-900/30 rounded-2xl aspect-video flex items-center justify-center border border-sky-500/20">
            <span class="text-6xl">🏢</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Values -->
    <section class="py-24 bg-gray-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-3xl font-bold text-white mb-4">核心價值</h2>
          <p class="text-gray-400">驅動我們前進的信念</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div v-for="val in values" :key="val.title"
            class="bg-gray-900 border border-gray-800 rounded-2xl p-8 text-center hover:border-sky-500/50 transition-all">
            <div class="text-5xl mb-4">{{ val.icon }}</div>
            <h3 class="text-white font-bold text-xl mb-3">{{ val.title }}</h3>
            <p class="text-gray-400 text-sm leading-relaxed">{{ val.desc }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Team -->
    <section class="py-24 bg-gray-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-3xl font-bold text-white mb-4">核心團隊</h2>
          <p class="text-gray-400">匯聚頂尖科技人才</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
          <div v-for="member in team" :key="member.name"
            class="bg-gray-800 rounded-2xl p-6 text-center hover:bg-gray-750 transition-all">
            <div class="w-20 h-20 bg-gradient-to-br from-sky-500 to-blue-600 rounded-full flex items-center justify-center text-2xl font-bold text-white mx-auto mb-4">
              {{ member.name[0] }}
            </div>
            <h3 class="text-white font-semibold">{{ member.name }}</h3>
            <p class="text-sky-400 text-sm mt-1">{{ member.title }}</p>
            <p class="text-gray-500 text-xs mt-2">{{ member.desc }}</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
const values = [
  { icon: '💡', title: '持續創新', desc: '我們擁抱最新科技，持續研發創新解決方案，幫助客戶保持市場領先優勢。' },
  { icon: '🤝', title: '可靠夥伴', desc: '我們視客戶成功為己任，提供 7x24 全天候支援，確保系統穩定可靠運行。' },
  { icon: '🌐', title: '緊密協作', desc: '我們與客戶深度協作，深入了解業務需求，共同制定最適合的技術策略。' },
]

const team = [
  { name: '陳建宏', title: '創辦人兼執行長', desc: '前 Google 工程師，20年科技產業經驗' },
  { name: '林美玲', title: '技術長', desc: 'MIT 博士，AI 與雲端架構專家' },
  { name: '張志豪', title: '產品長', desc: '連續創業者，產品設計思維領導者' },
  { name: '王淑芬', title: '業務長', desc: '15年企業服務銷售經驗，深耕台灣市場' },
]
</script>
