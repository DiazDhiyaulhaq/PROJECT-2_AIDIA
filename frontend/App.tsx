import React from 'react';
import { NavigationContainer } from '@react-navigation/native';
import AppNavigator from './src/navigation/AppNavigator'; // Arahkan ke pintu masuk navigasi
import { StatusBar } from 'expo-status-bar';

export default function App() {
  return (
    <NavigationContainer>
      {/* StatusBar biar icon batre/jam di HP menyesuaikan warna aplikasi.
          Karena desain kita cerah, pakai style 'dark' atau 'auto'.
      */}
      <StatusBar style="auto" />
      
      {/* Panggil Navigator Utama kita */}
      <AppNavigator />
    </NavigationContainer>
  );
}