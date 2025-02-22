import React, { useEffect, useState } from 'react';
import { Box, Container, Typography, Grid, Button, Drawer, List, ListItem, ListItemText, Badge, IconButton } from '@mui/material';
import ShoppingCartIcon from '@mui/icons-material/ShoppingCart';
import ArrowForwardIcon from '@mui/icons-material/ArrowForward';
import ProductCard from '../components/ProductCard';
import api from '../services/api';
import { useCart } from '../context/CartContext'; 

function Products() {
  const [products, setProducts] = useState([]);
  const { cart } = useCart();
  const [isDrawerOpen, setIsDrawerOpen] = useState(false);
  console.log(cart);
  useEffect(() => {
    api.get('/products')
      .then(response => setProducts(response.data))
      .catch(error => console.error("Erro ao buscar produtos:", error));
  }, []);

  const toggleDrawer = () => setIsDrawerOpen(!isDrawerOpen);

  return (
    <Box>
      {/* Drawer do carrinho */}
      <Drawer
        anchor="right"
        open={isDrawerOpen}
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
        {/* Botão flutuante para diminuir drawer*/}
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

      {/* Botão flutuante para expandir drawer */}
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

      {/* Conteúdo principal */}
      <Container maxWidth="lg">
        <Box sx={{ textAlign: 'center', my: 4 }}>
          <Typography variant="h4">Nossos Produtos</Typography>
          <Typography variant="body1">Confira nossa seleção exclusiva de produtos.</Typography>
        </Box>

        <Grid container spacing={3} justifyContent="center">
          {products.map((product) => (
            <Grid item xs={12} sm={6} md={4} key={product.id}>
              <ProductCard product={product} toggleDrawer={toggleDrawer} />
            </Grid>
          ))}
        </Grid>
      </Container>
    </Box>
  );
}

export default Products;
