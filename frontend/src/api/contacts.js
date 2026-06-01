import api from './axios'

export const submitContact = (data) =>
  api.post('/api/contacts', data).then(r => r.data)

export const adminListContacts = () =>
  api.get('/api/admin/contacts').then(r => r.data)

export const markContactRead = (id) =>
  api.patch(`/api/admin/contacts/${id}/read`).then(r => r.data)
