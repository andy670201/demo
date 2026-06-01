import api from './axios'

export const getServices = () =>
  api.get('/api/services').then(r => r.data)

export const createService = (data) =>
  api.post('/api/admin/services', data).then(r => r.data)

export const updateService = (id, data) =>
  api.put(`/api/admin/services/${id}`, data).then(r => r.data)

export const deleteService = (id) =>
  api.delete(`/api/admin/services/${id}`).then(r => r.data)
