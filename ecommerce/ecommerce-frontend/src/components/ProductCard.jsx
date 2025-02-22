import React from 'react';
import { Card, CardContent, CardMedia, CardActions, Typography, Button } from '@mui/material';
import { Link } from 'react-router-dom';
import { useCart } from '../context/CartContext'; 

function ProductCard({ product, toggleDrawer }) {

  const { addToCart } = useCart();

  const handleBuy = () => {
    addToCart(product.id, 1);
    toggleDrawer(); 
  };

  return (
    <Card sx={{
      maxWidth: 345, 
      m: 2, 
      boxShadow: 3, 
      borderRadius: 2, 
      height: { xs: 'auto', sm: '200px' }, 
      display: 'flex', 
      flexDirection: 'column'
    }}>
      {product.image && (
        <CardMedia
          component="img"
          height="200"
          image={product.image}
          alt={product.name}
        />
      )}
      <CardContent sx={{ flex: 1 }}>
        <Typography variant="h6" component="div" gutterBottom>
          {product.name}
        </Typography>
        <Typography variant="body2" color="text.secondary" sx={{ mb: 2 }}>
          {product.description}
        </Typography>
        <Typography variant="subtitle1" component="div">
          R$ {product.price}
        </Typography>
      </CardContent>
      <CardActions sx={{ justifyContent: 'flex-end' }}>
        <Button size="small" variant="contained" component={Link} to={`/products/${product.id}`}>
          Ver detalhes
        </Button>
        <Button size="small" variant="contained" onClick={handleBuy}>
          Comprar
        </Button>
      </CardActions>
    </Card>
  );
}

export default ProductCard;