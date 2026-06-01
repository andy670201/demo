import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const routes = [
  {
    path: '/',
    component: () => import('@/layouts/PublicLayout.vue'),
    children: [
      { path: '', name: 'home', component: () => import('@/views/public/HomeView.vue') },
      { path: 'about', name: 'about', component: () => import('@/views/public/AboutView.vue') },
      { path: 'services', name: 'services', component: () => import('@/views/public/ServicesView.vue') },
      { path: 'news', name: 'news', component: () => import('@/views/public/NewsView.vue') },
      { path: 'news/:slug', name: 'news-detail', component: () => import('@/views/public/NewsDetailView.vue') },
      { path: 'contact', name: 'contact', component: () => import('@/views/public/ContactView.vue') },
    ],
  },
  {
    path: '/admin/login',
    name: 'admin-login',
    component: () => import('@/views/admin/LoginView.vue'),
  },
  {
    path: '/admin',
    component: () => import('@/layouts/AdminLayout.vue'),
    meta: { requiresAuth: true },
    children: [
      { path: '', name: 'dashboard', component: () => import('@/views/admin/DashboardView.vue') },
      { path: 'news', name: 'admin-news', component: () => import('@/views/admin/NewsManageView.vue') },
      { path: 'services', name: 'admin-services', component: () => import('@/views/admin/ServicesManageView.vue') },
      { path: 'contacts', name: 'admin-contacts', component: () => import('@/views/admin/ContactsManageView.vue') },
    ],
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to, from, next) => {
  const authStore = useAuthStore()

  if (to.meta.requiresAuth && !authStore.isLoggedIn) {
    next('/admin/login')
  } else if (to.name === 'admin-login' && authStore.isLoggedIn) {
    next('/admin')
  } else {
    next()
  }
})

export default router
