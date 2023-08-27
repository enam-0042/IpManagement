import { useState } from "react";
export function getLocalStorage(keyName, defaultValue=''){
  
  try {
    const value = window.localStorage.getItem(keyName);
    if (value) {
      return JSON.parse(value);
    } else {
      window.localStorage.setItem(keyName, JSON.stringify(defaultValue));
      return defaultValue;
    }
  } catch (err) {
    return defaultValue;
  }
}
export const useLocalStorage = (keyName, defaultValue) => {
  const [storedValue, setStoredValue] = useState(() => {
   return getLocalStorage(keyName,defaultValue);
  });

  const setValue = (newValue) => {
    try {
      window.localStorage.setItem(keyName, JSON.stringify(newValue));
    } catch (err) {}
    setStoredValue(newValue);
  };
  return [storedValue, setValue];
};