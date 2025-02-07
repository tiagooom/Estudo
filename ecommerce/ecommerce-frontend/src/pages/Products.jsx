import React, { useEffect, useState } from 'react';
import { Box, Container, Typography, Grid2 } from '@mui/material';
import ProductCard from '../components/ProductCard';
import api from '../services/api';

function Products() {
  const [products, setProducts] = useState([]);

  useEffect(() => {
    api.get('/products')
      .then(response => {
        setProducts(response.data);
      })
      .catch(error => {
        console.error("Erro ao buscar produtos:", error);
      });
  }, []);

  return (
    <Container maxWidth="lg">
      <Box sx={{ textAlign: 'center', my: 4 }}>
        <Typography variant="h4" component="h1">
          Nossos Produtos
        </Typography>
        <Typography variant="body1">
          Confira nossa seleção exclusiva de produtos.
        </Typography>
      </Box>

      <Grid2 container spacing={3} justifyContent="center">
        {products.map((product) => (
          <Grid2 item xs={12} sm={6} md={4} key={product.id}>
            <ProductCard product={product} />
          </Grid2>
        ))}
      </Grid2>
    </Container>
  );
}

export default Products;
