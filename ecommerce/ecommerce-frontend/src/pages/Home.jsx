import { Box, Container, Typography } from '@mui/material';

function Home() {
  return (
    <Container maxWidth="md">
      <Box sx={{ display: 'flex', flexDirection: 'column', alignItems: 'center', justifyContent: 'center', minHeight: '100vh' }}>
        <Typography variant="h4" component="h1">
          Bem-vindo à nossa loja!
        </Typography>
        <Typography variant="body1">
          Encontre os melhores produtos com os melhores preços.
        </Typography>
      </Box>
    </Container>
  );
}

export default Home;
