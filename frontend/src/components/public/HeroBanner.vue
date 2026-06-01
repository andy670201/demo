<template>
  <section class="min-h-screen flex items-center justify-center relative overflow-hidden bg-gray-950">
    <div class="absolute inset-0 bg-gradient-to-br from-sky-900/20 via-gray-950 to-blue-900/20"></div>
    <div class="absolute inset-0">
      <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-sky-500/10 rounded-full blur-3xl animate-pulse"></div>
      <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>
    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
      <div class="inline-block bg-sky-500/10 border border-sky-500/30 rounded-full px-4 py-1 text-sky-400 text-sm mb-6">
        創新科技解決方案
      </div>
      <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
        創新驅動<span class="text-sky-400">未來</span>
      </h1>
      <p class="text-xl text-gray-400 mb-10 max-w-2xl mx-auto">
        NexCore Technology 提供企業級雲端、AI 及資安解決方案，協助您的企業突破技術瓶頸，邁向數位轉型新紀元。
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <RouterLink to="/services"
          class="bg-sky-500 hover:bg-sky-600 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all hover:scale-105 hover:shadow-lg hover:shadow-sky-500/25">
          探索服務
        </RouterLink>
        <RouterLink to="/contact"
          class="border border-sky-500/50 hover:border-sky-400 text-sky-400 hover:text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all hover:bg-sky-500/10">
          聯絡我們
        </RouterLink>
      </div>
    </div>
  </section>
</template>
