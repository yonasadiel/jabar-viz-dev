import axios from 'axios';

export const apiConfig = {
  baseURL: 'http://localhost:8000/api/v1',
  withCredentials: true,
};

const apiClient = axios.create(apiConfig);

export default apiClient;
