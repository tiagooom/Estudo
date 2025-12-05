import React, { useState, useEffect, useRef } from "react";
import Checkbox from '@mui/material/Checkbox';
import FormControlLabel from '@mui/material/FormControlLabel';
import FormLabel from '@mui/material/FormLabel';
import Grid from '@mui/material/Grid2';
import { styled } from '@mui/material/styles';
import TextField from '@mui/material/TextField';
import { useCheckout } from "../../context/CheckoutContext";

const FormGrid = styled(Grid)(() => ({
  display: 'flex',
  flexDirection: 'column',
}));

export default function AddressForm({ onNext, onValidate }) {
  const { checkoutData, updateAddress } = useCheckout();

  const [formData, setFormData] = useState(checkoutData.address || {});

  const [firstNameError, setFirstNameError] = useState(false);
  const [firstNameErrorMessage, setFirstNameErrorMessage] = useState("");
  const [lastNameError, setLastNameError] = useState(false);
  const [lastNameErrorMessage, setLastNameErrorMessage] = useState("");
  const [addressError, setAddressError] = useState(false);
  const [addressErrorMessage, setAddressErrorMessage] = useState("");
  const [cityError, setCityError] = useState(false);
  const [cityErrorMessage, setCityErrorMessage] = useState("");
  const [stateError, setStateError] = useState(false);
  const [stateErrorMessage, setStateErrorMessage] = useState("");
  const [zipError, setZipError] = useState(false);
  const [zipErrorMessage, setZipErrorMessage] = useState("");
  const [countryError, setCountryError] = useState(false);
  const [countryErrorMessage, setCountryErrorMessage] = useState("");

  const firstNameRef = useRef(null);
  const lastNameRef = useRef(null);
  const addressRef = useRef(null);
  const cityRef = useRef(null);
  const stateRef = useRef(null);
  const zipRef = useRef(null);
  const countryRef = useRef(null);

  useEffect(() => {

    setFormData(checkoutData.address || {});

    if (onNext) {
      let isValid = true;

      const name = firstNameRef.current?.value;
      if (!name) {
        setFirstNameError(true);
        setFirstNameErrorMessage("Por favor, insira um nome válido.");
        isValid = false;
      } else {
        setFirstNameError(false);
        setFirstNameErrorMessage("");
      }

      const lastName = lastNameRef.current?.value;
      if (!lastName) {
        setLastNameError(true);
        setLastNameErrorMessage("Por favor, insira um sobrenome válido.");
        isValid = false;
      } else {
        setLastNameError(false);
        setLastNameErrorMessage("");
      }

      const address = addressRef.current?.value;
      if (!address) {
        setAddressError(true);
        setAddressErrorMessage("Por favor, insira um endereço válido.");
        isValid = false;
      } else {
        setAddressError(false);
        setAddressErrorMessage("");
      }

      const city = cityRef.current?.value;
      if (!city) {
        setCityError(true);
        setCityErrorMessage("Por favor, insira uma cidade válida.");
        isValid = false;
      } else {
        setCityError(false);
        setCityErrorMessage("");
      }

      const state = stateRef.current?.value;
      if (!state) {
        setStateError(true);
        setStateErrorMessage("Por favor, insira um estado válido.");
        isValid = false;
      } else {
        setStateError(false);
        setStateErrorMessage("");
      }

      const zip = zipRef.current?.value;
      if (!zip) {
        setZipError(true);
        setZipErrorMessage("Por favor, insira um CEP válido.");
        isValid = false;
      } else {
        setZipError(false);
        setZipErrorMessage("");
      }

      const country = countryRef.current?.value;
      if (!country) {
        setCountryError(true);
        setCountryErrorMessage("Por favor, insira um país válido.");
        isValid = false;
      } else {
        setCountryError(false);
        setCountryErrorMessage("");
      }

      if (isValid) {
        const formData = {
          firstName: firstNameRef.current.value,
          lastName: lastNameRef.current.value,
          address: addressRef.current.value,
          city: cityRef.current.value,
          state: stateRef.current.value,
          zip: zipRef.current.value,
          country: countryRef.current.value
        };
        updateAddress(formData);
      }

      onValidate(isValid);
    }
 }, [onNext, checkoutData.address]);


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
          inputRef={firstNameRef}
          name="first-name"
          type="text"
          placeholder="João"
          autoComplete="given-name"
          required
          size="small"
          defaultValue={formData.firstName || ""}
          variant="outlined"
          color={firstNameError ? 'error' : 'primary'}
        />
      </FormGrid>
      <FormGrid size={{ xs: 12, md: 6 }}>
        <FormLabel htmlFor="last-name" required>
          Sobrenome
        </FormLabel>
        <TextField
          error={lastNameError}
          helperText={lastNameErrorMessage}
          id="last-name"
          inputRef={lastNameRef}
          name="last-name"
          type="text"
          placeholder="Silva"
          autoComplete="family-name"
          required
          size="small"
          defaultValue={formData.lastName || ""}
          variant="outlined"
          color={lastNameError ? 'error' : 'primary'}
        />
      </FormGrid>
      <FormGrid size={{ xs: 12 }}>
        <FormLabel htmlFor="address" required>
          Endereço
        </FormLabel>
        <TextField
          error={addressError}
          helperText={addressErrorMessage}
          id="address"
          inputRef={addressRef}
          name="address"
          type="text"
          placeholder="Nome da rua e número"
          autoComplete="shipping address-line1"
          required
          size="small"
          defaultValue={formData.address || ""}
          variant="outlined"
          color={addressError ? 'error' : 'primary'}
        />
      </FormGrid>
      <FormGrid size={{ xs: 6 }}>
        <FormLabel htmlFor="city" required>
          Cidade
        </FormLabel>
        <TextField
          error={cityError}
          helperText={cityErrorMessage}
          id="city"
          inputRef={cityRef}
          name="city"
          type="text"
          placeholder="São Paulo"
          autoComplete="address-level2"
          required
          size="small"
          defaultValue={formData.city || ""}
          variant="outlined"
          color={cityError ? 'error' : 'primary'}
        />
      </FormGrid>
      <FormGrid size={{ xs: 6 }}>
        <FormLabel htmlFor="state" required>
          Estado
        </FormLabel>
        <TextField
          error={stateError}
          helperText={stateErrorMessage}
          id="state"
          inputRef={stateRef}
          name="state"
          type="text"
          placeholder="SP"
          autoComplete="address-level1"
          required
          size="small"
          defaultValue={formData.state || ""}
          variant="outlined"
          color={stateError ? 'error' : 'primary'}
        />
      </FormGrid>
      <FormGrid size={{ xs: 6 }}>
        <FormLabel htmlFor="zip" required>
          CEP
        </FormLabel>
        <TextField
          error={zipError}
          helperText={zipErrorMessage}
          id="zip"
          inputRef={zipRef}
          name="zip"
          type="text"
          placeholder="12345-678"
          autoComplete="postal-code"
          required
          size="small"
          defaultValue={formData.zip || ""}
          variant="outlined"
          color={zipError ? 'error' : 'primary'}
        />
      </FormGrid>
      <FormGrid size={{ xs: 6 }}>
        <FormLabel htmlFor="country" required>
          País
        </FormLabel>
        <TextField
          error={countryError}
          helperText={countryErrorMessage}
          id="country"
          inputRef={countryRef}
          name="country"
          type="text"
          placeholder="Brasil"
          autoComplete="country"
          required
          size="small"
          defaultValue={formData.country || ""}
          variant="outlined"
          color={countryError ? 'error' : 'primary'}
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
