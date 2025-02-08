import React from 'react'
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'
import { ThemeProvider, createTheme, CssBaseline } from '@mui/material'

import Navbar from './components/Navbar'
import Home from './pages/Home'
import Products from './pages/Products'
import ProductDetail from './pages/ProductDetail'
import AddProduct from './pages/AddProduct'
import Cart from './pages/Cart'

// Criação do tema com Material UI
const theme = createTheme({
  palette: {
    mode: 'light', // Você pode mudar para 'dark' se preferir
  },
})

function App() {
  return (
    <ThemeProvider theme={theme}>
      <CssBaseline />
      <Router>
        <Navbar />
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/products" element={<Products />} />
          <Route path="/products/:id" element={<ProductDetail />} />
          <Route path="/products/add" element={<AddProduct />} />
          <Route path="/cart" element={<Cart />} />
        </Routes>
      </Router>
    </ThemeProvider>
  )
}

export default App
