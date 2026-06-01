import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useUiStore = defineStore('ui', () => {
  const loading = ref(false)
  const notification = ref(null)

  function setLoading(val) {
    loading.value = val
  }

  function showNotification(msg, type = 'success') {
    notification.value = { msg, type }
    setTimeout(() => { notification.value = null }, 3000)
  }

  return { loading, notification, setLoading, showNotification }
})
