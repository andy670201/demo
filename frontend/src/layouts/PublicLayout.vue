<template>
  <div class="min-h-screen bg-gray-950 text-white flex flex-col">
    <Navbar />
    <main class="flex-1">
      <RouterView />
    </main>
    <Footer />
  </div>
</template>

<script setup>
import Navbar from '@/components/public/Navbar.vue'
import Footer from '@/components/public/Footer.vue'
</script>
