import api from './api';

export const getCategories = async () => {
  try {
    const response = await api.get('/categories');
    return response.data; 
  } catch (error) {
    throw error;
  }
};

export const createCategory = async (categoryData) => {
  try {
    const response = await api.post('/categories', categoryData);
    return response.data;
  } catch (error) {
    throw error;
  }
};

export const updateCategory = async (categoryId, categoryData) => {
  try {
    const response = await api.put(`/categories/${categoryId}`, categoryData);
    return response.data;
  } catch (error) {
    throw error;
  }
};

export const deleteCategory = async (categoryId) => {
  try {
    await api.delete(`/categories/${categoryId}`);
  } catch (error) {
    throw error;
  }
};
