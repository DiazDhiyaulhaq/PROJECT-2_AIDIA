import React, { useEffect, useState } from 'react';

import { NavigationContainer } from '@react-navigation/native';

import { StatusBar } from 'expo-status-bar';

import AsyncStorage from '@react-native-async-storage/async-storage';

import AppNavigator from './src/navigation/AppNavigator';

import { useAuthStore } from './src/store/useAuthStore';

import { ActivityIndicator, View } from 'react-native';

export default function App() {

  const login = useAuthStore((state: any) => state.login);

  const [loading, setLoading] = useState(true);

  useEffect(() => {

    checkLogin();

  }, []);

  const checkLogin = async () => {

    try {

      const token = await AsyncStorage.getItem('token');

      const user = await AsyncStorage.getItem('user');

      if (token && user) {

        login(
          token,
          JSON.parse(user)
        );
      }

    } catch (error) {

      console.log(error);

    } finally {

      setLoading(false);
    }
  };

  if (loading) {

    return (

      <View
        style={{
          flex: 1,
          justifyContent: 'center',
          alignItems: 'center'
        }}
      >

        <ActivityIndicator size="large" />

      </View>
    );
  }

  return (

    <NavigationContainer>

      <StatusBar style="auto" />

      <AppNavigator />

    </NavigationContainer>
  );
}