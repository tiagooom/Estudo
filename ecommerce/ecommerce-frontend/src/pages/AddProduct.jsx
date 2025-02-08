import React, { useState } from 'react';
import { Box, Container, Typography, TextField, Button, Grid } from '@mui/material';
import api from '../services/api';
import { useNavigate } from 'react-router-dom';

function AddProduct() {
  const [name, setName] = useState('');
  const [description, setDescription] = useState('');
  const [price, setPrice] = useState('');
  const [quantity, setQuantity] = useState('');
  const [categoryId, setCategoryId] = useState('');
  const [image, setImage] = useState('');
  const navigate = useNavigate();

  const handleSubmit = (e) => {
    e.preventDefault();

    const newProduct = {
      name,
      description,
      price,
      quantity,
      category_id: categoryId,
      image,
    };
    
    api.post('/products', newProduct)
      .then(() => {
        navigate('/products'); // Redireciona para a lista de produtos
      })
      .catch((error) => {
        console.error('Erro ao adicionar o produto', error);
      });
  };

  return (
    <Container maxWidth="sm">
      <Box sx={{ textAlign: 'center', my: 4 }}>
        <Typography variant="h4" component="h1" gutterBottom>
          Adicionar Novo Produto
        </Typography>
      </Box>
      
      <form onSubmit={handleSubmit}>
        <Grid container spacing={2}>
          <Grid item xs={12}>
            <TextField
              fullWidth
              label="Nome do Produto"
              variant="outlined"
              value={name}
              onChange={(e) => setName(e.target.value)}
              required
            />
          </Grid>

          <Grid item xs={12}>
            <TextField
              fullWidth
              label="Descrição"
              variant="outlined"
              multiline
              rows={4}
              value={description}
              onChange={(e) => setDescription(e.target.value)}
              required
            />
          </Grid>

          <Grid item xs={12}>
            <TextField
              fullWidth
              label="Preço"
              variant="outlined"
              type="number"
              value={price}
              onChange={(e) => setPrice(e.target.value)}
              required
            />
          </Grid>

          <Grid item xs={12}>
            <TextField
              fullWidth
              label="Quantidade"
              variant="outlined"
              type="number"
              value={quantity}
              onChange={(e) => setQuantity(e.target.value)}
              required
            />
          </Grid>

          <Grid item xs={12}>
            <TextField
              fullWidth
              label="Categoria (ID)"
              variant="outlined"
              value={categoryId}
              onChange={(e) => setCategoryId(e.target.value)}
              required
            />
          </Grid>

          <Grid item xs={12}>
            <TextField
              fullWidth
              label="URL da Imagem"
              variant="outlined"
              value={image}
              onChange={(e) => setImage(e.target.value)}
            />
          </Grid>

          <Grid item xs={12} sx={{ mt: 2 }}>
            <Button
              fullWidth
              type="submit"
              variant="contained"
              color="primary"
            >
              Adicionar Produto
            </Button>
          </Grid>
        </Grid>
      </form>
    </Container>
  );
}

export default AddProduct;
