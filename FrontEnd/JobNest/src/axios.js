import axios from 'axios'
import store from './store'

const axiosClient = axios.create({
  baseURL : 'http://127.0.0.1:8000/api',
  headers: {
    "Content-Type": "application/json",
    "Accept": "application/json",
  }
})
axiosClient.interceptors.request.use(config => {
  if(store.state.user.token) {
    config.headers.Authorization = `Bearer ${store.state.user.token}`
  }
  return config;
})
export default  axiosClient;
