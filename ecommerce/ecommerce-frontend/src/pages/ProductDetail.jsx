import React, { useState, useEffect } from 'react';
import { Container, Typography, Button, Box } from '@mui/material';
import { useParams } from 'react-router-dom';
import api from '../services/api';

function ProductDetail() {
  const { id } = useParams();
  const [product, setProduct] = useState(null);

  useEffect(() => {
    api.get(`/products/${id}`)
      .then(response => setProduct(response.data))
      .catch(error => console.error('Erro ao carregar produto', error));
  }, [id]);

  if (!product) {
    return <Typography variant="h6">Carregando produto...</Typography>;
  }

  return (
    <Container>
      <Box sx={{ display: 'flex', flexDirection: 'column', alignItems: 'center', mt: 4 }}>
        {product.image && (
          <img src={product.image} alt={product.name} style={{ maxWidth: '100%', height: 'auto', marginBottom: '16px' }} />
        )}
        <Typography variant="h4">{product.name}</Typography>
        <Typography variant="body1" color="text.secondary" sx={{ mt: 2 }}>
          {product.description}
        </Typography>
        <Typography variant="h6" sx={{ mt: 2 }}>
          R$ {product.price}
        </Typography>
        <Button variant="contained" color="primary" sx={{ mt: 4 }}>
          Comprar
        </Button>
      </Box>
    </Container>
  );
}

export default ProductDetail;
