import * as React from 'react';
import Divider from '@mui/material/Divider';
import Grid from '@mui/material/Grid';
import List from '@mui/material/List';
import ListItem from '@mui/material/ListItem';
import ListItemText from '@mui/material/ListItemText';
import Stack from '@mui/material/Stack';
import Typography from '@mui/material/Typography';
import { useCart } from '../../context/CartContext';
import { useCheckout } from "../../context/CheckoutContext";

export default function Review() {
  const { checkoutData } = useCheckout();

  const payments = [
    { name: 'Tipo do cartão:', detail: 'Visa' },
    { name: 'Titular do cartão:', detail: checkoutData.payment.cardName },
    { name: 'Número do cartão:', detail: checkoutData.payment.cardNumber },
    { name: 'Data de expiração:', detail: checkoutData.payment.expirationDate },
  ];

  const { cart } = useCart();
    
  const total = cart.reduce((acc, item) => acc + Number(item.product.price) * Number(item.quantity), 0);

  return (
    <Stack spacing={2}>
      <List disablePadding>
        <ListItem sx={{ py: 1, px: 0 }}>
          <ListItemText primary="Produtos" secondary={`${cart.length} selecionados`} />
          <Typography variant="body2">R$ { (total).toFixed(2) }</Typography>
        </ListItem>
        <ListItem sx={{ py: 1, px: 0 }}>
          <ListItemText primary="Frete" secondary="Mais impostos" />
          <Typography variant="body2">R$ 9,99</Typography>
        </ListItem>
        <ListItem sx={{ py: 1, px: 0 }}>
          <ListItemText primary="Total" />
          <Typography variant="subtitle1" sx={{ fontWeight: 700 }}>
          R$ { (total+9.99).toFixed(2) }
          </Typography>
        </ListItem>
      </List>

      <Divider />
      <Stack
        direction="column"
        divider={<Divider flexItem />}
        spacing={2}
        sx={{ my: 2 }}
      >
        <div>
          <Typography variant="subtitle2" gutterBottom>
            Detalhes do envio
          </Typography>
          <Typography gutterBottom>{`${checkoutData.address.firstName || ''} ${checkoutData.address.lastName || ''}`.trim()}</Typography>
          <Typography gutterBottom sx={{ color: 'text.secondary' }}>
            {[checkoutData.address.address, checkoutData.address.city, checkoutData.address.state, checkoutData.address.zip, checkoutData.address.country]
              .filter(Boolean)
              .join(', ')}
          </Typography>
        </div>
        <div>
          <Typography variant="subtitle2" gutterBottom>
            Detalhes do pagamento
          </Typography>
          <Grid container>
            {payments.map((payment) => (
              <React.Fragment key={payment.name}>
                <Stack
                  direction="row"
                  spacing={1}
                  useFlexGap
                  sx={{ width: '100%', mb: 1 }}
                >
                  <Typography variant="body1" sx={{ color: 'text.secondary' }}>
                    {payment.name}
                  </Typography>
                  <Typography variant="body2">{payment.detail}</Typography>
                </Stack>
              </React.Fragment>
            ))}
          </Grid>
        </div>
      </Stack>
    </Stack>
  );
}
