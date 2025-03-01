import React, { useState, useEffect } from 'react';
import Checkbox from '@mui/material/Checkbox';
import FormControlLabel from '@mui/material/FormControlLabel';
import FormLabel from '@mui/material/FormLabel';
import Grid from '@mui/material/Grid2';
import OutlinedInput from '@mui/material/OutlinedInput';
import { styled } from '@mui/material/styles';
import TextField from '@mui/material/TextField';

const FormGrid = styled(Grid)(() => ({
  display: 'flex',
  flexDirection: 'column',
}));
const address = JSON.parse(sessionStorage.getItem("addressData")) || {};


console.log(address.firstName); // Agora você tem os dados de endereço disponíveis

export default function AddressForm( {  } ) {
  const [firstNameError, setFirstNameError] = useState(false);
  const [firstNameErrorMessage, setFirstNameErrorMessage] = useState(false);
  
  return (
    <Grid container spacing={3}>
      <FormGrid size={{ xs: 12, md: 6 }}>
        <FormLabel htmlFor="first-name" required>
          Nome
        </FormLabel>
        <TextField
          error={firstNameError}
          helperText={firstNameErrorMessage}
          id="first-name"
          name="first-name"
          type="text"
          placeholder="João"
          autoComplete="given-name"
          required
          size="small"
          defaultValue={address.firstName || ""}
          variant="outlined"
          color={firstNameError ? 'error' : 'primary'}
        />
      </FormGrid>
      <FormGrid size={{ xs: 12, md: 6 }}>
        <FormLabel htmlFor="last-name" required>
          Sobrenome
        </FormLabel>
        <OutlinedInput
          id="last-name"
          name="last-name"
          type="text"
          placeholder="Silva"
          autoComplete="family-name"
          required
          size="small"
        />
      </FormGrid>
      <FormGrid size={{ xs: 12 }}>
        <FormLabel htmlFor="address" required>
          Endereço
        </FormLabel>
        <OutlinedInput
          id="address"
          name="address"
          type="text"
          placeholder="Nome da rua e número"
          autoComplete="shipping address-line1"
          required
          size="small"
        />
      </FormGrid>
      <FormGrid size={{ xs: 6 }}>
        <FormLabel htmlFor="city" required>
          Cidade
        </FormLabel>
        <OutlinedInput
          id="city"
          name="city"
          type="text"
          placeholder="São Paulo"
          autoComplete="address-level2"
          required
          size="small"
        />
      </FormGrid>
      <FormGrid size={{ xs: 6 }}>
        <FormLabel htmlFor="state" required>
          Estado
        </FormLabel>
        <OutlinedInput
          id="state"
          name="state"
          type="text"
          placeholder="SP"
          autoComplete="address-level1"
          required
          size="small"
        />
      </FormGrid>
      <FormGrid size={{ xs: 6 }}>
        <FormLabel htmlFor="zip" required>
          CEP
        </FormLabel>
        <OutlinedInput
          id="zip"
          name="zip"
          type="text"
          placeholder="12345-678"
          autoComplete="postal-code"
          required
          size="small"
        />
      </FormGrid>
      <FormGrid size={{ xs: 6 }}>
        <FormLabel htmlFor="country" required>
          País
        </FormLabel>
        <OutlinedInput
          id="country"
          name="country"
          type="text"
          placeholder="Brasil"
          autoComplete="country"
          required
          size="small"
        />
      </FormGrid>
      <FormGrid size={{ xs: 12 }}>
        <FormControlLabel
          control={<Checkbox name="saveAddress" value="yes" />}
          label="Usar este endereço para detalhes de pagamento"
        />
      </FormGrid>
    </Grid>
  );
}
