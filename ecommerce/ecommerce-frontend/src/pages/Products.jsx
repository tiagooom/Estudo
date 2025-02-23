import React, { useEffect, useState } from 'react';
import { Box, Container, Typography, Grid } from '@mui/material';
import ProductCard from '../components/ProductCard';
import api from '../services/api';
import CartDrawer from '../components/CartDrawer';

function Products() {
  const [products, setProducts] = useState([]);
  const [isDrawerOpen, setIsDrawerOpen] = useState(false);
  
  useEffect(() => {
    api.get('/products')
      .then(response => setProducts(response.data))
      .catch(error => console.error("Erro ao buscar produtos:", error));
  }, []);

  const toggleDrawer = () => setIsDrawerOpen(!isDrawerOpen);

  return (
    <Box>
      {/* Carrinho como componente */}
      <CartDrawer isOpen={isDrawerOpen} toggleDrawer={toggleDrawer} />

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
