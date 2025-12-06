// context/CheckoutContext.jsx
import { createContext, useContext, useState } from "react";

const CheckoutContext = createContext();

export function CheckoutProvider({ children }) {
  const [checkoutData, setCheckoutData] = useState({
    address: {},
    payment: {
      paymentType: "creditCard",
      cardNumber: "",
      cvv: "",
      expirationDate: "",
      cardName: "",
      isCardSaved: "",
    },
  });

  const updateAddress = (data) => {
    setCheckoutData((prev) => ({
      ...prev,
      address: data
    }));
  };

  const updatePayment = (data) => {
    setCheckoutData((prev) => ({
      ...prev,
      payment: data
    }));
  };

  return (
    <CheckoutContext.Provider value={{ checkoutData, updateAddress, updatePayment, }}>
      {children}
    </CheckoutContext.Provider>
  );
}

export const useCheckout = () => useContext(CheckoutContext);

