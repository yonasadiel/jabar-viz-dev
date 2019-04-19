import axios from 'axios'

export const apiConfig = {
  baseURL: 'http://localhost:8000/api/v1',
  withCredentials: true,
};

const apiClient = axios.create(apiConfig)

// apiClient.interceptors.response.use(
//   (response) => response,
//   (err) => {
//     // Handle 401 Unauthorized and 403 Forbidden errors by resetting Vuex state (force reload app),
//     // only if ignoreUnauthorizedError is not set or set to False in Axios request config
//     if (err.response && !err.response.config.ignoreUnauthorizedError && (err.response.status === 401 || err.response.status === 403)) {
//       location.reload(true)
//     }
//     return Promise.reject(err);
//   }
// )

export default apiClient;