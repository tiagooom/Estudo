import React from 'react'
import { AppBar, Toolbar, Typography, Button, Box } from '@mui/material'
import { Link } from 'react-router-dom'

function Navbar() {
  return (
    <AppBar position="static">
      <Toolbar>
        {/* Título da aplicação */}
        <Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
          Ecommerce
        </Typography>

        {/* Botões de navegação centralizados */}
        <Box sx={{ flexGrow: 1}}>
          <Button color="inherit" component={Link} to="/">
            Home
          </Button>
          <Button color="inherit" component={Link} to="/products">
            Produtos
          </Button>
          <Button color="inherit" component={Link} to="/cart">
            Carrinho
          </Button>
        </Box>

        {/* Botões de login e registro à direita */}
        <Button color="inherit" component={Link} to="/login">
          Login
        </Button>
        <Button color="inherit" component={Link} to="/register">
          Registrar
        </Button>
      </Toolbar>
    </AppBar>
  )
}

export default Navbar