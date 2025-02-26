import React, { createContext, useState, useEffect, useContext } from 'react';
import { login as authLogin, logout as authLogout, register as authRegister, getUser } from '../services/authService';
import { useCart } from '../context/CartContext';
import api from '../services/api';

export const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
  const [user, setUser] = useState(null);
  const { clearCart, syncCart } = useCart();

  useEffect(() => {
    const loadUser = async () => {
      const token = localStorage.getItem('authToken');
      if (token) {
        api.defaults.headers.Authorization = `Bearer ${token}`;
        try {
          const response = await getUser();
          if (response && response.user) {
            setUser(response.user);
          } else {
            setUser(null);
          }
        } catch (error) {
          if (error.response?.status === 401) {
            localStorage.removeItem('authToken');
            setUser(null);
          }
          console.error('Erro ao carregar usuário:', error);
        }        
      } else {
        setUser(null);
      }
    };
    loadUser();
  }, []);

  const login = async (email, password) => {
    try {
      const response = await authLogin(email, password);
      if (response && response.token) {
        localStorage.setItem('authToken', response.token);
        api.defaults.headers.Authorization = `Bearer ${response.token}`;
        const userData = await getUser();
        setUser(userData.user);
        syncCart();
      }
    } catch (error) {
      console.error('Erro no login:', error);
      throw error;
    }
  };

  const register = async (name, email, password, passwordConfirmation) => {
    try {
      const response = await authRegister(name, email, password, { password_confirmation: passwordConfirmation });
      if (response && response.token) {
        localStorage.setItem('authToken', response.token);
        api.defaults.headers.Authorization = `Bearer ${response.token}`;
        const userData = await getUser();
        setUser(userData.user);
      }
    } catch (error) {
      console.error('Erro no login:', error);
      throw error;
    }
  };


  const logout = async () => {
    try {
      await authLogout();
      localStorage.removeItem('authToken');
      delete api.defaults.headers.common['Authorization'];
      setUser(null);
      clearCart();
    } catch (error) {
      console.error('Erro no logout:', error);
    }
  };

  return (
    <AuthContext.Provider value={{ user, register, login, logout }}>
      {children}
    </AuthContext.Provider>
  );
};

export const useAuth = () => useContext(AuthContext);