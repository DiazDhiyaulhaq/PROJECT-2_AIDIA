import React from 'react';

import { createStackNavigator } from '@react-navigation/stack';

import AuthNavigator from './AuthNavigator';

import TabNavigator from './TabNavigator';

import GlucoseScreen from '../screens/home/GlucoseScreen';

import { useAuthStore } from '../store/useAuthStore';

const Stack = createStackNavigator();

export default function AppNavigator() {

  const token = useAuthStore(
    (state) => state.token
  );

  return (

    <Stack.Navigator
      screenOptions={{
        headerShown: false
      }}
    >

      {token == null ? (

        <Stack.Screen
          name="AuthStack"
          component={AuthNavigator}
        />

      ) : (

        <>
          <Stack.Screen
            name="MainStack"
            component={TabNavigator}
          />

          <Stack.Screen
            name="GlucoseDetail"
            component={GlucoseScreen}
          />
        </>

      )}

    </Stack.Navigator>
  );
}