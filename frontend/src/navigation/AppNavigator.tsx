import React from 'react';
import { createStackNavigator } from '@react-navigation/stack';
import AuthNavigator from './AuthNavigator';
import TabNavigator from './TabNavigator';
import { useAuthStore } from '../store/useAuthStore';
import GlucoseScreen from '../screens/home/GlucoseScreen';

const Stack = createStackNavigator();

export default function AppNavigator() {
  const token = useAuthStore((state: any) => state.token);

  return (
    <Stack.Navigator screenOptions={{ headerShown: false }}>
      {token ? (
        <>
          <Stack.Screen name="Main" component={TabNavigator} />
          <Stack.Screen name="GlucoseDetail" component={GlucoseScreen} />
        </>
      ) : (
        <Stack.Screen name="Auth" component={AuthNavigator} />
      )}
    </Stack.Navigator>
  );
}