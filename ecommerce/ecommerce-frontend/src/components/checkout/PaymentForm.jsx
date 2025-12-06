import React, { useState, useEffect } from "react";
import Alert from '@mui/material/Alert';
import Box from '@mui/material/Box';
import MuiCard from '@mui/material/Card';
import CardActionArea from '@mui/material/CardActionArea';
import CardContent from '@mui/material/CardContent';
import Checkbox from '@mui/material/Checkbox';
import FormControl from '@mui/material/FormControl';
import FormControlLabel from '@mui/material/FormControlLabel';
import FormLabel from '@mui/material/FormLabel';
import OutlinedInput from '@mui/material/OutlinedInput';
import RadioGroup from '@mui/material/RadioGroup';
import Stack from '@mui/material/Stack';
import Typography from '@mui/material/Typography';
import { styled } from '@mui/material/styles';
import AccountBalanceRoundedIcon from '@mui/icons-material/AccountBalanceRounded';
import CreditCardRoundedIcon from '@mui/icons-material/CreditCardRounded';
import SimCardRoundedIcon from '@mui/icons-material/SimCardRounded';
import WarningRoundedIcon from '@mui/icons-material/WarningRounded';
import FormHelperText from '@mui/material/FormHelperText';
import { useCheckout } from "../../context/CheckoutContext";

const Card = styled(MuiCard)(({ theme }) => ({
  border: '1px solid',
  borderColor: (theme.vars || theme).palette.divider,
  width: '100%',
  '&:hover': {
    background:
      'linear-gradient(to bottom right, hsla(210, 100%, 97%, 0.5) 25%, hsla(210, 100%, 90%, 0.3) 100%)',
    borderColor: 'primary.light',
    boxShadow: '0px 2px 8px hsla(0, 0%, 0%, 0.1)',
    ...theme.applyStyles('dark', {
      background:
        'linear-gradient(to right bottom, hsla(210, 100%, 12%, 0.2) 25%, hsla(210, 100%, 16%, 0.2) 100%)',
      borderColor: 'primary.dark',
      boxShadow: '0px 1px 8px hsla(210, 100%, 25%, 0.5) ',
    }),
  },
  [theme.breakpoints.up('md')]: {
    flexGrow: 1,
    maxWidth: `calc(50% - ${theme.spacing(1)})`,
  },
  variants: [
    {
      props: ({ selected }) => selected,
      style: {
        borderColor: (theme.vars || theme).palette.primary.light,
        ...theme.applyStyles('dark', {
          borderColor: (theme.vars || theme).palette.primary.dark,
        }),
      },
    },
  ],
}));

const PaymentContainer = styled('div')(({ theme }) => ({
  display: 'flex',
  flexDirection: 'column',
  justifyContent: 'space-between',
  width: '100%',
  height: 375,
  padding: theme.spacing(3),
  borderRadius: `calc(${theme.shape.borderRadius}px + 4px)`,
  border: '1px solid ',
  borderColor: (theme.vars || theme).palette.divider,
  background:
    'linear-gradient(to bottom right, hsla(220, 35%, 97%, 0.3) 25%, hsla(220, 20%, 88%, 0.3) 100%)',
  boxShadow: '0px 4px 8px hsla(210, 0%, 0%, 0.05)',
  [theme.breakpoints.up('xs')]: {
    height: 300,
  },
  [theme.breakpoints.up('sm')]: {
    height: 350,
  },
  ...theme.applyStyles('dark', {
    background:
      'linear-gradient(to right bottom, hsla(220, 30%, 6%, 0.2) 25%, hsla(220, 20%, 25%, 0.2) 100%)',
    boxShadow: '0px 4px 8px hsl(220, 35%, 0%)',
  }),
}));

const FormGrid = styled('div')(() => ({
  display: 'flex',
  flexDirection: 'column',
}));

export default function PaymentForm({ onNext, onValidate }) {

  const { checkoutData, updatePayment } = useCheckout();

  const [formData, setFormData] = useState(checkoutData.payment || {});

  const [paymentType, setPaymentType] = useState(formData.paymentType || "creditCard");
  const [cardNumber, setCardNumber] = useState(formData.cardNumber || "");
  const [cvv, setCvv] = useState(formData.cvv || "");
  const [expirationDate, setExpirationDate] = useState(formData.expirationDate || "");
  const [cardName, setCardName] = useState(formData.cardName || "");
  
  const [isCardSaved, setIsCardSaved] = useState(formData.isCardSaved || "");
  

  const [errors, setErrors] = React.useState({});

  const isValid = () => {
    let newErrors = {};
    if (paymentType === 'creditCard') {
      if (!cardNumber || cardNumber.replace(/\s/g, '').length !== 16) {
        newErrors.cardNumber = 'O número do cartão deve ter 16 dígitos.';
      }
      if (!cvv || !/^\d{3}$/.test(cvv)) { 
        newErrors.cvv = 'CVV inválido';
      }
      if (!expirationDate || !/^\d{2}\/\d{2}$/.test(expirationDate)) { 
        newErrors.expirationDate = 'Data de validade inválida';
      }
      if (!cardName.trim()) { 
        newErrors.cardName = 'Nome no cartão é obrigatório';
      }
    }
    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  useEffect(() => {
    if (onNext) {
      const valid = isValid();
      onValidate(valid);
      if (valid) {
        const paymentData = { paymentType, cardNumber, cvv, expirationDate, cardName, isCardSaved };
        updatePayment(paymentData);
        if (isCardSaved) { 
          //preparar dados para api
        }
      }
    }
  }, [onNext, onValidate]);

  const handlePaymentTypeChange = (event) => {
    setPaymentType(event.target.value);
  };

  const handleCardNumberChange = (event) => {
    const value = event.target.value.replace(/\D/g, '');
    const formattedValue = value.replace(/(\d{4})(?=\d)/g, '$1 ');
    if (value.length <= 16) {
      setCardNumber(formattedValue);
    }
  };

  const handleCvvChange = (event) => {
    const value = event.target.value.replace(/\D/g, '');
    if (value.length <= 3) {
      setCvv(value);
    }
  };

  const handleExpirationDateChange = (event) => {
    const value = event.target.value.replace(/\D/g, '');
    const formattedValue = value.replace(/(\d{2})(?=\d{2})/, '$1/');
    if (value.length <= 4) {
      setExpirationDate(formattedValue);
    }
  };

  const handleCheckboxChange = (event) => {
    setIsCardSaved(event.target.checked);

    if (!event.target.checked && Object.keys(formData).length > 0 && false) { //ultimo condicional sera se houver token do cartao
      const confirmDelete = window.confirm('Você tem certeza que deseja apagar os dados do cartão?');

      if (confirmDelete) {
        // Limpa os campos quando o checkbox é desmarcado
        setCardNumber('');
        setCvv('');
        setExpirationDate('');
        setCardName('');
      } else {
        setIsCardSaved(true);
      }
    }
  };
  

  return (
    <Stack spacing={{ xs: 3, sm: 6 }} useFlexGap>
      <FormControl component="fieldset" fullWidth>
        <RadioGroup
          aria-label="Opções de pagamento"
          name="paymentType"
          value={paymentType}
          onChange={handlePaymentTypeChange}
          sx={{
            display: 'flex',
            flexDirection: { xs: 'column', sm: 'row' },
            gap: 2,
          }}
        >
          <Card selected={paymentType === 'creditCard'}>
            <CardActionArea
              onClick={() => setPaymentType('creditCard')}
              sx={{
                '.MuiCardActionArea-focusHighlight': {
                  backgroundColor: 'transparent',
                },
                '&:focus-visible': {
                  backgroundColor: 'action.hover',
                },
              }}
            >
              <CardContent sx={{ display: 'flex', alignItems: 'center', gap: 1 }}>
                <CreditCardRoundedIcon
                  fontSize="small"
                  sx={[
                    (theme) => ({
                      color: 'grey.400',
                      ...theme.applyStyles('dark', {
                        color: 'grey.600',
                      }),
                    }),
                    paymentType === 'creditCard' && {
                      color: 'primary.main',
                    },
                  ]}
                />
                <Typography sx={{ fontWeight: 'medium' }}>Cartão de crédito</Typography>
              </CardContent>
            </CardActionArea>
          </Card>
          <Card selected={paymentType === 'bankTransfer'}>
            <CardActionArea
              onClick={() => setPaymentType('bankTransfer')}
              sx={{
                '.MuiCardActionArea-focusHighlight': {
                  backgroundColor: 'transparent',
                },
                '&:focus-visible': {
                  backgroundColor: 'action.hover',
                },
              }}
            >
              <CardContent sx={{ display: 'flex', alignItems: 'center', gap: 1 }}>
                <AccountBalanceRoundedIcon
                  fontSize="small"
                  sx={[
                    (theme) => ({
                      color: 'grey.400',
                      ...theme.applyStyles('dark', {
                        color: 'grey.600',
                      }),
                    }),
                    paymentType === 'bankTransfer' && {
                      color: 'primary.main',
                    },
                  ]}
                />
                <Typography sx={{ fontWeight: 'medium' }}>Conta bancária</Typography>
              </CardContent>
            </CardActionArea>
          </Card>
        </RadioGroup>
      </FormControl>
      {paymentType === 'creditCard' && (
        <Box sx={{ display: 'flex', flexDirection: 'column', gap: 2 }}>
          <PaymentContainer>
            <Box sx={{ display: 'flex', justifyContent: 'space-between' }}>
              <Typography variant="subtitle2">Cartão de crédito</Typography>
              <CreditCardRoundedIcon sx={{ color: 'text.secondary' }} />
            </Box>
            <SimCardRoundedIcon
              sx={{
                fontSize: { xs: 48, sm: 56 },
                transform: 'rotate(90deg)',
                color: 'text.secondary',
              }}
            />
            <Box
              sx={{
                display: 'flex',
                justifyContent: 'space-between',
                width: '100%',
                gap: 2,
              }}
            >
              <FormGrid sx={{ flexGrow: 1 }}>
                <FormLabel htmlFor="card-number" required>
                  Número do cartão
                </FormLabel>
                <OutlinedInput
                  id="card-number"
                  autoComplete="card-number"
                  placeholder="0000 0000 0000 0000"
                  required
                  size="small"
                  value={cardNumber}
                  onChange={handleCardNumberChange}
                  inputProps={{readOnly: isCardSaved && Object.keys(formData).length > 0}}
                />
                {errors.cardNumber && <FormHelperText error>{errors.cardNumber}</FormHelperText>}
              </FormGrid>
              <FormGrid sx={{ maxWidth: '20%' }}>
                <FormLabel htmlFor="cvv" required>
                  CVV
                </FormLabel>
                <OutlinedInput
                  id="cvv"
                  autoComplete="CVV"
                  placeholder="000"
                  required
                  size="small"
                  value={cvv}
                  onChange={handleCvvChange}
                  inputProps={{readOnly: isCardSaved && Object.keys(formData).length > 0}}
                />
                {errors.cvv && <FormHelperText error>{errors.cvv}</FormHelperText>}
              </FormGrid>
            </Box>
            <Box sx={{ display: 'flex', gap: 2 }}>
              <FormGrid sx={{ flexGrow: 1 }}>
                <FormLabel htmlFor="card-name" required>
                  Nome no cartão
                </FormLabel>
                <OutlinedInput
                  id="card-name"
                  autoComplete="card-name"
                  required
                  value={cardName}
                  onChange={(e) => setCardName(e.target.value)}
                  size="small"
                  inputProps={{readOnly: isCardSaved && Object.keys(formData).length > 0}}
                />
                {errors.cardName && <FormHelperText error>{errors.cardName}</FormHelperText>}
              </FormGrid>
              <FormGrid sx={{ flexGrow: 1 }}>
                <FormLabel htmlFor="card-expiration" required>
                  Data de validade
                </FormLabel>
                <OutlinedInput
                  id="card-expiration"
                  autoComplete="card-expiration"
                  placeholder="MM/AA"
                  required
                  size="small"
                  value={expirationDate}
                  onChange={handleExpirationDateChange}
                  inputProps={{readOnly: isCardSaved && Object.keys(formData).length > 0}}
                />
                {errors.expirationDate && <FormHelperText error>{errors.expirationDate}</FormHelperText>}
              </FormGrid>
            </Box>
          </PaymentContainer>
          <FormControlLabel
            control={<Checkbox checked={isCardSaved} onChange={handleCheckboxChange} />}
            label={
              isCardSaved && Object.keys(formData).length > 0
                ? "Excluir cartao"
                : "Lembrar os detalhes do cartão para a próxima vez"
            }
          />
        </Box>
      )}
      {paymentType === 'bankTransfer' && (
        <Box sx={{ display: 'flex', flexDirection: 'column', gap: 2 }}>
          <Alert severity="warning" icon={<WarningRoundedIcon />}>
            Seu pedido será processado assim que recebermos os fundos.
          </Alert>
          <Typography variant="subtitle1" sx={{ fontWeight: 'medium' }}>
            Conta bancária
          </Typography>
          <Typography variant="body1" gutterBottom>
            Por favor, transfira o pagamento para os detalhes bancários abaixo.
          </Typography>
          <Box sx={{ display: 'flex', gap: 1 }}>
            <Typography variant="body1" sx={{ color: 'text.secondary' }}>
              Banco:
            </Typography>
            <Typography variant="body1" sx={{ fontWeight: 'medium' }}>
              Mastercredit
            </Typography>
          </Box>
          <Box sx={{ display: 'flex', gap: 1 }}>
            <Typography variant="body1" sx={{ color: 'text.secondary' }}>
              Número da conta:
            </Typography>
            <Typography variant="body1" sx={{ fontWeight: 'medium' }}>
              123456789
            </Typography>
          </Box>
          <Box sx={{ display: 'flex', gap: 1 }}>
            <Typography variant="body1" sx={{ color: 'text.secondary' }}>
              Número da agência:
            </Typography>
            <Typography variant="body1" sx={{ fontWeight: 'medium' }}>
              987654321
            </Typography>
          </Box>
        </Box>
      )}
    </Stack>
  );
}
