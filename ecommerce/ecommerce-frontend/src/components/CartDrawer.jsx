import React from 'react';
import { Drawer, List, ListItem, ListItemText, Typography, IconButton, Badge, Button } from '@mui/material';
import { Link } from 'react-router-dom';
import ArrowForwardIcon from '@mui/icons-material/ArrowForward';
import ShoppingCartIcon from '@mui/icons-material/ShoppingCart';
import AddCircleOutlineIcon from '@mui/icons-material/AddCircleOutline';
import RemoveCircleOutlineIcon from '@mui/icons-material/RemoveCircleOutline';
import DeleteIcon from '@mui/icons-material/Delete';
import { useCart } from '../context/CartContext';

function CartDrawer({ isOpen, toggleDrawer, products }) {
  const { cart, addToCart, decreaseQuantity, removeFromCart, clearCart } = useCart();

  const cartItems = cart.map((cartItem) => {
    const product = products.find((p) => p.id === cartItem.product_id);
    return {
      ...cartItem,
      name: product ? product.name : "Produto não encontrado",
      price: product ? product.price : 0,
    };
  });

  const total = cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);

  return (
    <>
      <Drawer
        anchor="right"
        open={isOpen}
        onClose={toggleDrawer}
        sx={{
          '& .MuiDrawer-paper': { width: 300, padding: 2 },
        }}
      >
        <Typography variant="h6">Carrinho de Compras</Typography>
        <List>
          {cartItems.length === 0 ? (
            <ListItem>
              <ListItemText primary="Carrinho vazio" />
            </ListItem>
          ) : (
            cartItems.map((item) => (
              <ListItem key={item.product_id} sx={{ display: 'flex', alignItems: 'center' }}>
                <ListItemText
                  primary={`${item.name} - ${item.quantity}x`}
                  secondary={`R$ ${(item.price * item.quantity).toFixed(2)}`}
                />
                <IconButton onClick={() => decreaseQuantity(item.product_id)} size="small">
                  <RemoveCircleOutlineIcon />
                </IconButton>
                <IconButton onClick={() => addToCart(item.product_id, 1)} size="small">
                  <AddCircleOutlineIcon />
                </IconButton>
                <IconButton onClick={() => removeFromCart(item.product_id)} size="small" color="error">
                  <DeleteIcon />
                </IconButton>
              </ListItem>
            ))
          )}
        </List>
        
        <Typography variant="h6" sx={{ mt: 2 }}>
          Total: R$ {total.toFixed(2)}
        </Typography>

        <Button 
          variant="contained" 
          color="primary" 
          sx={{ width: '100%', mt: 2 }}
          component={Link}
          to={`/checkout`}
        >
          Finalizar Compra
        </Button>

        {/* Botão para limpar carrinho */}
        <Button 
          variant="outlined" 
          color="error" 
          sx={{ width: '100%', mt: 2 }}
          onClick={clearCart}
        >
          Limpar Carrinho
        </Button>

        <IconButton
          onClick={toggleDrawer}
          sx={{
            position: 'fixed',
            bottom: 20,
            right: 20,
            width: 60,
            height: 60,
            borderRadius: '50%',
            boxShadow: 3,
          }}
        >
          <ArrowForwardIcon fontSize="large" />
        </IconButton>
      </Drawer>

      <IconButton
        onClick={toggleDrawer}
        sx={{
          position: 'fixed',
          bottom: 20,
          right: 20,
          backgroundColor: '#ff3d00',
          color: 'white',
          width: 60,
          height: 60,
          borderRadius: '50%',
          boxShadow: 3,
          '&:hover': { backgroundColor: '#d32f2f' },
        }}
      >
        <Badge badgeContent={cart.length} color="secondary">
          <ShoppingCartIcon fontSize="large" />
        </Badge>
      </IconButton>
    </>
  );
}

export default CartDrawer;
