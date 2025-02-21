import api from './api';

export const login = async (email, password) => {
  try { 
    const response = await api.post('/login', { email, password });
    localStorage.setItem('authToken', response.data.token);
    api.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
    return response.data;
  } catch (error) {
    throw error;
  }
};

export const logout = async () => {
  try {
    await api.post('/logout');
    localStorage.removeItem('authToken');
    delete api.defaults.headers.common['Authorization'];
  } catch (error) {
    throw error;
  }
};

export const register = async (name, email, password, { password_confirmation: passwordConfirmation }) => {
  try { 
    const response = await api.post('/register', { name, email, password, password_confirmation: passwordConfirmation});
    localStorage.setItem('authToken', response.data.token);
    api.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
    return response.data;
  } catch (error) {
    throw error;
  }
};

export const getUser = async () => {
  try {
    const response = await api.get('/user');
    return response.data;
  } catch (error) {
    throw error;
  }
};
