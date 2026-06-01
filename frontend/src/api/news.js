import api from './axios'

export const getNews = () =>
  api.get('/api/news').then(r => r.data)

export const getNewsDetail = (slug) =>
  api.get(`/api/news/${slug}`).then(r => r.data)

export const adminGetNews = () =>
  api.get('/api/admin/news').then(r => r.data)

export const createNews = (data) =>
  api.post('/api/admin/news', data).then(r => r.data)

export const updateNews = (id, data) =>
  api.put(`/api/admin/news/${id}`, data).then(r => r.data)

export const deleteNews = (id) =>
  api.delete(`/api/admin/news/${id}`).then(r => r.data)
