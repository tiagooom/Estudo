import React, { useEffect, useState } from 'react';
import {
  Box,
  Button,
  Dialog,
  DialogActions,
  DialogContent,
  DialogTitle,
  Paper,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
  TextField,
  Typography,
  MenuItem,
  IconButton,
} from '@mui/material';
import { styled } from '@mui/material/styles';
import { getProducts, createProduct, updateProduct, deleteProduct } from '../services/productService';
import { getCategories } from '../services/categoryService';
import DeleteIcon from '@mui/icons-material/Delete';
import EditIcon from '@mui/icons-material/Edit';

const Container = styled(Box)(({ theme }) => ({
  padding: theme.spacing(4),
}));

const initialFormData = {
  name: '',
  description: '',
  price: '',
  quantity: '',
  category_id: '',
};

export default function AdminProducts() {
  const [products, setProducts] = useState([]);
  const [categories, setCategories] = useState([]);
  const [openDialog, setOpenDialog] = useState(false);
  const [currentProduct, setCurrentProduct] = useState(null);
  const [formData, setFormData] = useState(initialFormData);

  const loadProducts = async () => {
    try {
      const data = await getProducts();
      setProducts(data.products || data);
    } catch (err) {
      console.error('Erro ao carregar produtos', err);
    }
  };

  const loadCategories = async () => {
    try {
      const data = await getCategories();
      setCategories(data.categories || data);
    } catch (err) {
      console.error('Erro ao carregar categorias', err);
    }
  };

  useEffect(() => {
    loadProducts();
    loadCategories();
  }, []);

  const handleOpenDialog = (product = null) => {
    setCurrentProduct(product);
    setFormData(
      product ? { 
        name: product.name, 
        description: product.description, 
        price: product.price, 
        quantity: product.quantity, 
        category_id: product.category_id 
      } : initialFormData
    );
    setOpenDialog(true);
  };

  const handleCloseDialog = () => {
    setOpenDialog(false);
  };

  const handleFormChange = (e) => {
    const { name, value } = e.target;
    setFormData((prev) => ({ ...prev, [name]: value }));
  };

  const handleSubmit = async () => {
    try {
      if (currentProduct) {
        await updateProduct(currentProduct.id, formData);
      } else {
        await createProduct(formData);
      }
      loadProducts();
      handleCloseDialog();
    } catch (error) {
      console.error('Erro ao salvar produto', error);
    }
  };

  const handleDelete = async (id) => {
    try {
      await deleteProduct(id);
      loadProducts();
    } catch (error) {
      console.error('Erro ao deletar produto', error);
    }
  };

  return (
    <Container>
      <Typography variant="h4" gutterBottom>
        Gerenciar Produtos
      </Typography>
      <Button variant="contained" color="primary" onClick={() => handleOpenDialog()}>
        Adicionar Produto
      </Button>
      <TableContainer component={Paper} sx={{ marginTop: 2 }}>
        <Table>
          <TableHead>
            <TableRow>
              <TableCell>ID</TableCell>
              <TableCell>Nome</TableCell>
              <TableCell>Descrição</TableCell>
              <TableCell>Preço</TableCell>
              <TableCell>Quantidade</TableCell>
              <TableCell>Categoria</TableCell>
              <TableCell align="right">Ações</TableCell>
            </TableRow>
          </TableHead>
          <TableBody>
            {products.map((product) => (
              <TableRow key={product.id}>
                <TableCell>{product.id}</TableCell>
                <TableCell>{product.name}</TableCell>
                <TableCell>{product.description}</TableCell>
                <TableCell>{product.price}</TableCell>
                <TableCell>{product.quantity}</TableCell>
                <TableCell>{categories.find((c) => c.id === product.category_id)?.name || 'Sem categoria'}</TableCell>
                <TableCell align="right">
                  <IconButton size="small" onClick={() => handleOpenDialog(product)}>
                    <EditIcon />
                  </IconButton>
                  <IconButton size="small" color="error" onClick={() => handleDelete(product.id)}>
                    <DeleteIcon />
                  </IconButton>
                </TableCell>
              </TableRow>
            ))}
          </TableBody>
        </Table>
      </TableContainer>
      <Dialog open={openDialog} onClose={handleCloseDialog} fullWidth maxWidth="sm">
        <DialogTitle>{currentProduct ? 'Editar Produto' : 'Adicionar Produto'}</DialogTitle>
        <DialogContent>
          <TextField name="name" label="Nome" fullWidth margin="dense" value={formData.name} onChange={handleFormChange} />
          <TextField name="description" label="Descrição" fullWidth multiline rows={3} margin="dense" value={formData.description} onChange={handleFormChange} />
          <TextField name="price" label="Preço" type="number" fullWidth margin="dense" value={formData.price} onChange={handleFormChange} />
          <TextField name="quantity" label="Quantidade" type="number" fullWidth margin="dense" value={formData.quantity} onChange={handleFormChange} />
          <TextField name="category_id" label="Categoria" select fullWidth margin="dense" value={formData.category_id} onChange={handleFormChange}>
            {categories.map((category) => (
              <MenuItem key={category.id} value={category.id}>{category.name}</MenuItem>
            ))}
          </TextField>
        </DialogContent>
        <DialogActions>
          <Button onClick={handleCloseDialog}>Cancelar</Button>
          <Button variant="contained" onClick={handleSubmit}>Salvar</Button>
        </DialogActions>
      </Dialog>
    </Container>
  );
}
