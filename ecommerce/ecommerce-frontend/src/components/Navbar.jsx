import React from 'react'
import { AppBar, Toolbar, Typography, Button } from '@mui/material'
import { Link } from 'react-router-dom'

function Navbar() {
  return (
    <AppBar position="static">
      <Toolbar>
        {/* Título da aplicação */}
        <Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
          Ecommerce
        </Typography>
        {/* Botões de navegação */}
        <Button color="inherit" component={Link} to="/">
          Home
        </Button>
        <Button color="inherit" component={Link} to="/products">
          Produtos
        </Button>
        <Button color="inherit" component={Link} to="/cart">
          Carrinho
        </Button>
      </Toolbar>
    </AppBar>
  )
}

export default Navbar

