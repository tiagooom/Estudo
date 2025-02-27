import * as React from 'react';
import PropTypes from 'prop-types';
import List from '@mui/material/List';
import ListItem from '@mui/material/ListItem';
import ListItemText from '@mui/material/ListItemText';
import Typography from '@mui/material/Typography';

function Info({ totalPrice, cartItems }) {

  cartItems = cartItems.map(item => ({
    name: item.product.name,
    desc: item.product.description,
    price: item.product.price,
    quantity: item.quantity,
  }));

  return (
    <React.Fragment>
      <Typography variant="subtitle2" sx={{ color: 'text.secondary' }}>
        Total
      </Typography>
      <Typography variant="h4" gutterBottom>
        {totalPrice}
      </Typography>
      <List disablePadding>
        {cartItems.map((item) => (
          <ListItem key={item.name} sx={{ py: 1, px: 0 }}>
            <ListItemText
              sx={{ mr: 2 }}
              primary={item.name}
              secondary={item.desc}
            />
            <Typography variant="body1" sx={{ fontWeight: 'medium', whiteSpace: 'nowrap' }}>
            {item.quantity} x R$ {item.price}
            </Typography>
          </ListItem>
        ))}
      </List>
    </React.Fragment>
  );
}

Info.propTypes = {
  totalPrice: PropTypes.string.isRequired,
  cartItems: PropTypes.array.isRequired,
};

export default Info;
