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
  IconButton,
} from '@mui/material';
import { styled } from '@mui/material/styles';
import { getCategories, createCategory, updateCategory, deleteCategory } from '../services/categoryService';
import DeleteIcon from '@mui/icons-material/Delete';
import EditIcon from '@mui/icons-material/Edit';


const Container = styled(Box)(({ theme }) => ({
  padding: theme.spacing(4),
}));

export default function AdminCategories() {
  const [categories, setCategories] = useState([]);
  const [openDialog, setOpenDialog] = useState(false);
  const [currentCategory, setCurrentCategory] = useState(null);
  const [formData, setFormData] = useState({ name: '', description: '' });

  const loadCategories = async () => {
    try {
      const data = await getCategories();
      setCategories(data.categories || data);
    } catch (err) {
      setError(err);
    }
  };
  
  useEffect(() => {
    loadCategories();
  }, []);

  const handleOpenDialog = (category = null) => {
    if (category) {
      setCurrentCategory(category);
      setFormData({ 
        name: category.name, 
        description: category.description || ''
      });
    } else {
      setCurrentCategory(null);
      setFormData({ name: '', description: '' });
    }
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
      if (currentCategory) {
        await updateCategory(currentCategory.id, formData);
      } else {
        await createCategory(formData);
      }
      loadCategories();
      handleCloseDialog();
    } catch (error) {
      console.error('Erro ao salvar categoria', error);
    }
  };

  const handleDelete = async (id) => {
    try {
      await deleteCategory(id);
      loadCategories();
    } catch (error) {
      console.error('Erro ao deletar categoria', error);
    }
  };

  return (
    <Container>
      <Typography variant="h4" gutterBottom>
        Gerenciar Categorias
      </Typography>
      <Button variant="contained" color="primary" onClick={() => handleOpenDialog()}>
        Adicionar Categoria
      </Button>
      <TableContainer component={Paper} sx={{ marginTop: 2 }}>
        <Table>
          <TableHead>
            <TableRow>
              <TableCell>ID</TableCell>
              <TableCell>Nome</TableCell>
              <TableCell>Descrição</TableCell>
              <TableCell align="right">Ações</TableCell>
            </TableRow>
          </TableHead>
          <TableBody>
            {categories.map((category) => (
              <TableRow key={category.id}>
                <TableCell>{category.id}</TableCell>
                <TableCell>{category.name}</TableCell>
                <TableCell>{category.description}</TableCell>
                <TableCell align="right">
                  <IconButton size="small" onClick={() => handleOpenDialog(category)}>
                    <EditIcon />
                  </IconButton>
                  <IconButton size="small" color="error" onClick={() => handleDelete(category.id)}>
                    <DeleteIcon />
                  </IconButton>
                </TableCell>
              </TableRow>
            ))}
          </TableBody>
        </Table>
      </TableContainer>
      <Dialog open={openDialog} onClose={handleCloseDialog}>
        <DialogTitle>{currentCategory ? 'Editar Categoria' : 'Adicionar Categoria'}</DialogTitle>
        <DialogContent>
          <TextField
            margin="dense"
            name="name"
            label="Nome"
            fullWidth
            value={formData.name}
            onChange={handleFormChange}
          />
          <TextField
            margin="dense"
            name="description"
            label="Descrição"
            fullWidth
            multiline
            rows={4} // Ajuste o número de linhas conforme necessário
            value={formData.description}
            onChange={handleFormChange}
          />
        </DialogContent>
        <DialogActions>
          <Button onClick={handleCloseDialog}>Cancelar</Button>
          <Button variant="contained" onClick={handleSubmit}>
            Salvar
          </Button>
        </DialogActions>
      </Dialog>
    </Container>
  );
}
