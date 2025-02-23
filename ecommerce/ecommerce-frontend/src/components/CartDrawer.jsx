import React from 'react';
import { Drawer, List, ListItem, ListItemText, Typography, IconButton, Badge } from '@mui/material';
import ArrowForwardIcon from '@mui/icons-material/ArrowForward';
import ShoppingCartIcon from '@mui/icons-material/ShoppingCart';
import { useCart } from '../context/CartContext';

function CartDrawer({ isOpen, toggleDrawer }) {
  const { cart } = useCart();

  return (
    <>
      {/* Drawer do carrinho */}
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
          {cart.length === 0 ? (
            <ListItem>
              <ListItemText primary="Carrinho vazio" />
            </ListItem>
          ) : (
            cart.map((item, index) => (
              <ListItem key={index}>
                <ListItemText primary={`Produto ${item.product_id}, Quantidade: ${item.quantity}`} />
              </ListItem>
            ))
          )}
        </List>

        {/* Botão para fechar o drawer */}
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

      {/* Botão flutuante para abrir drawer */}
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
