import React from 'react';
import { createStackNavigator } from '@react-navigation/stack';
import AuthNavigator from './AuthNavigator';
import TabNavigator from './TabNavigator';

const Stack = createStackNavigator();

export default function AppNavigator() {
  const isLoggedIn = true; // Nanti diganti dengan status login asli dari backend

  return (
    <Stack.Navigator screenOptions={{ headerShown: false }}>
      {isLoggedIn ? (
        // Jika sudah login, langsung ke Tab Utama
        <Stack.Screen name="Main" component={TabNavigator} />
      ) : (
        // Jika belum, ke layar Login/Register
        <Stack.Screen name="Auth" component={AuthNavigator} />
      )}
    </Stack.Navigator>
  );
}