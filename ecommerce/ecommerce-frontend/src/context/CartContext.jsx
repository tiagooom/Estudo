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
        const response = await api.get('/cart');
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

  const addToCart = async (productId, quantity = 1) => {
    const token = localStorage.getItem('token');

    if (token) {
      try {
        await api.post('/cart', { product_id: productId, quantity });
        loadCart(); // Atualiza o carrinho após adicionar o produto
      } catch (error) {
        console.error("Erro ao adicionar ao carrinho:", error);
      }
    } else {
      setCart((prevCart) => {
        const updatedCart = prevCart.map((item) =>
          item.product_id === productId ? { ...item, quantity: item.quantity + quantity } : item
        );

        const itemExists = prevCart.some((item) => item.product_id === productId);
        if (!itemExists) {
          updatedCart.push({ product_id: productId, quantity });
        }

        saveCart(updatedCart);
        return updatedCart;
      });
    }
  };

  const decreaseQuantity = async (productId) => {
    const token = localStorage.getItem('token');

    if (token) {
      try {
        await api.put('/cart/decrease', { product_id: productId });
        loadCart();
      } catch (error) {
        console.error("Erro ao diminuir quantidade:", error);
      }
    } else {
      setCart((prevCart) => {
        const updatedCart = prevCart
          .map((item) =>
            item.product_id === productId ? { ...item, quantity: item.quantity - 1 } : item
          )
          .filter((item) => item.quantity > 0);

        saveCart(updatedCart);
        return updatedCart;
      });
    }
  };

  const removeFromCart = async (productId) => {
    const token = localStorage.getItem('token');

    if (token) {
      try {
        await api.delete(`/cart/${productId}`);
        loadCart();
      } catch (error) {
        console.error("Erro ao remover item do carrinho:", error);
      }
    } else {
      setCart((prevCart) => {
        const updatedCart = prevCart.filter((item) => item.product_id !== productId);
        saveCart(updatedCart);
        return updatedCart;
      });
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
    <CartContext.Provider value={{ cart, addToCart, decreaseQuantity, removeFromCart, clearCart }}>
      {children}
    </CartContext.Provider>
  );
};

export const useCart = () => useContext(CartContext);
