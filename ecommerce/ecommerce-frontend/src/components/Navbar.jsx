import React, { useContext, useState } from 'react';
import { AppBar, Toolbar, Typography, Button, Box, Menu, MenuItem } from '@mui/material';
import { Link, useNavigate } from 'react-router-dom';
import { AuthContext } from '../context/AuthContext';

function Navbar() {
  const { user, logout } = useContext(AuthContext);
  const navigate = useNavigate();
  
  const [anchorEl, setAnchorEl] = useState(null);
  const handleMenuOpen = (event) => setAnchorEl(event.currentTarget);
  const handleMenuClose = () => setAnchorEl(null);

  const handleLogout = () => {
    console.log('Chamando logout do AuthContext...');
    logout();
    navigate('/login');
  };

  return (
    <AppBar position="static">
      <Toolbar>
        <Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
          Ecommerce
        </Typography>

        <Box sx={{ flexGrow: 1 }}>
          <Button color="inherit" component={Link} to="/">
            Home
          </Button>
          <Button color="inherit" component={Link} to="/products">
            Produtos
          </Button>
          <Button color="inherit" component={Link} to="/cart">
            Carrinho
          </Button>

          {/* Dropdown do Admin */}
          {user && user && (
            <>
              <Button color="inherit" onClick={handleMenuOpen}>
                Admin
              </Button>
              <Menu anchorEl={anchorEl} open={Boolean(anchorEl)} onClose={handleMenuClose}>
                <MenuItem component={Link} to="/admin/categories" onClick={handleMenuClose}>
                  Categorias
                </MenuItem>
                <MenuItem component={Link} to="/admin/products" onClick={handleMenuClose}>
                  Produtos
                </MenuItem>
              </Menu>
            </>
          )}
        </Box>

        {/* Exibe informações do usuário se estiver logado */}
        {user ? (
          <>
            <Button color="inherit" onClick={handleMenuOpen}>
              Admin
            </Button>
            <Menu anchorEl={anchorEl} open={Boolean(anchorEl)} onClose={handleMenuClose}>
              <MenuItem component={Link} to="/admin/categories" onClick={handleMenuClose}>
                Categorias
              </MenuItem>
              <MenuItem component={Link} to="/admin/products" onClick={handleMenuClose}>
                Produtos
              </MenuItem>
            </Menu>
            <Typography variant="body1" sx={{ marginRight: 2 }}>
              Olá, {user.name || 'Usuário'}
            </Typography>
            <Button color="inherit" onClick={handleLogout}>
              Logout
            </Button>
          </>
        ) : (
          <>
            <Button color="inherit" component={Link} to="/login">
              Login
            </Button>
            <Button color="inherit" component={Link} to="/register">
              Registrar
            </Button>
          </>
        )}
      </Toolbar>
    </AppBar>
  );
}

export default Navbar;
