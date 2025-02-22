import React, { createContext, useContext, useState, useEffect } from 'react';
import api from '../services/api';

const CartContext = createContext();

export const CartProvider = ({ children }) => {
  const [cart, setCart] = useState([]);

  // Carrega o carrinho do backend se o usuário estiver autenticado
  const loadCart = async () => {
    const token = localStorage.getItem('token');
    
    if (token) {
      try {
        const response = await api.get('/cart'); // Ajuste conforme necessário
        setCart(response.data);
      } catch (error) {
        console.error("Erro ao carregar carrinho:", error);
      }
    }
  };

  // Carrega o carrinho do localStorage ao iniciar
  useEffect(() => {
    const savedCart = localStorage.getItem('cart');
    if (savedCart) {
      setCart(JSON.parse(savedCart));
    }

    loadCart(); // Busca carrinho do backend se o usuário estiver logado
  }, []);

  const saveCart = (newCart) => {
    setCart(newCart); 
    localStorage.setItem('cart', JSON.stringify(newCart));
  };

  const addToCart = async (productId, quantity) => {
    const token = localStorage.getItem('token');
    if (token) {
      try {
        await api.post('/cart', { product_id: productId, quantity });
        loadCart(); // Atualiza o carrinho após adicionar o produto
      } catch (error) {
        console.error("Erro ao adicionar ao carrinho:", error);
      }
    } else {
      const newCart = [...cart];  
      const itemIndex = newCart.findIndex((item) => item.product_id === productId);
      
      if (itemIndex !== -1) {
        newCart[itemIndex].quantity += quantity;
      } else {
        newCart.push({ product_id: productId, quantity });
      }

      saveCart(newCart);
    }
  };

  const clearCart = async () => {
    const token = localStorage.getItem('token');

    if (token) {
      try {
        await api.delete('/cart/clear');
        loadCart(); // Recarrega o carrinho vazio
      } catch (error) {
        console.error("Erro ao limpar carrinho:", error);
      }
    } else {
      localStorage.removeItem('cart');
      setCart([]);
    }
  };

  return (
    <CartContext.Provider value={{ cart, addToCart, clearCart }}>
      {children}
    </CartContext.Provider>
  );
};

export const useCart = () => useContext(CartContext);
