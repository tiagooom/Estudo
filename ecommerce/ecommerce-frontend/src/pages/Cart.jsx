import React, { useEffect, useState } from 'react';
import { useCart } from '../context/CartContext';
import api from '../services/api';
import { Button, Typography, Box, Grid } from '@mui/material';

const CartPage = () => {
  const { cart, clearCart } = useCart();
  const [products, setProducts] = useState([]);

  useEffect(() => {
    const fetchProducts = async () => {
      try {
        const productIds = cart.map(item => item.product_id);
        if (productIds.length === 0) return;
        const response = await api.get('/products', { params: { ids: productIds } });
        setProducts(response.data);
      } catch (error) {
        console.error("Erro ao buscar produtos:", error);
      }
    };

    fetchProducts();
  }, [cart]);

  const handleCheckout = async () => {
    try {
      await api.post('/checkout', { items: cart });
      alert('Compra finalizada com sucesso!');
      clearCart(); // Limpa o carrinho após finalizar a compra
    } catch (error) {
      console.error("Erro ao finalizar compra:", error);
      alert('Erro ao finalizar a compra. Tente novamente.');
    }
  };

  return (
    <Box sx={{ padding: '20px' }}>
      <Typography variant="h4" gutterBottom>Carrinho de Compras</Typography>
      {cart.length === 0 ? (
        <Typography variant="body1">Seu carrinho está vazio.</Typography>
      ) : (
        <div>
          {cart.map((item, index) => {
            const product = products.find(p => p.id === item.product_id);
            return (
              product && (
                <Box key={index} sx={{ marginBottom: '16px', borderBottom: '1px solid #ddd', paddingBottom: '16px' }}>
                  <Typography variant="h6">{product.name}</Typography>
                  <Typography variant="body1">Quantidade: {item.quantity}</Typography>
                  <Typography variant="body1">Preço: R$ {product.price * item.quantity} (R$ {product.price})</Typography>
                </Box>
              )
            );
          })}
          <Grid container spacing={2}>
            <Grid item>
              <Button variant="outlined" onClick={clearCart}>Limpar Carrinho</Button>
            </Grid>
            <Grid item>
              <Button variant="contained" onClick={handleCheckout}>Finalizar Compra</Button>
            </Grid>
          </Grid>
        </div>
      )}
    </Box>
  );
};

export default CartPage;
