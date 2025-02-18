import React from "react";
import { BrowserRouter as Router, Routes, Route, useLocation } from "react-router-dom";
import { ThemeProvider, createTheme, CssBaseline } from "@mui/material";
import { AuthProvider } from "./context/AuthContext";

import Navbar from "./components/Navbar";
import Home from "./pages/Home";
import Login from "./pages/Login";
import Register from "./pages/Register";
import Products from "./pages/Products";
import ProductDetail from "./pages/ProductDetail";
import AddProduct from "./pages/AddProduct";
import Cart from "./pages/Cart";
import AdminCategoria from "./pages/AdminCategory";
import AdminProduct from "./pages/AdminProduct";
import AdminRoute from "./components/AdminRoute"; // 🔹 Importando a proteção de rota

const theme = createTheme({
  palette: {
    mode: "light",
  },
});

function App() {
  return (
    <ThemeProvider theme={theme}>
      <CssBaseline />
      <Router>
        <AuthProvider>
          <Layout />
        </AuthProvider>
      </Router>
    </ThemeProvider>
  );
}

function Layout() {
  const location = useLocation();
  const hideNavbarRoutes = ["/login", "/register"];

  return (
    <>
      {!hideNavbarRoutes.includes(location.pathname) && <Navbar />}
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/products" element={<Products />} />
        <Route path="/products/:id" element={<ProductDetail />} />
        <Route path="/products/add" element={<AddProduct />} />
        <Route path="/cart" element={<Cart />} />
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />

        {/* 🔹 Agrupando rotas protegidas dentro do AdminRoute */}
        <Route element={<AdminRoute />}>
          <Route path="/admin/categories" element={<AdminCategoria />} />
          <Route path="/admin/products" element={<AdminProduct />} />
        </Route>
      </Routes>
    </>
  );
}

export default App;
