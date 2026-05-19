import React, { useState } from 'react';

import {
  View,
  Text,
  StyleSheet,
  SafeAreaView,
  KeyboardAvoidingView,
  Platform,
  Alert
} from 'react-native';

import { useNavigation } from '@react-navigation/native';

import AsyncStorage from '@react-native-async-storage/async-storage';

import { useAuthStore } from '../../store/useAuthStore';

import { COLORS } from '../../utils/colors';

import { Input, Button } from '../../components';

import api from '../../services/api';

export default function LoginScreen() {

  const navigation = useNavigation<any>();

  const login = useAuthStore((state: any) => state.login);

  const [email, setEmail] = useState('');

  const [password, setPassword] = useState('');

  const [loading, setLoading] = useState(false);

  const handleLogin = async () => {

    if (!email || !password) {

      return Alert.alert(
        'Error',
        'Email dan Password wajib diisi!'
      );
    }

    try {

      setLoading(true);

      const response = await api.post('/login', {
        email,
        password
      });

      const token = response.data.token;

      const user = response.data.user;

      // simpan ke zustand
      login(token, user);

      // simpan ke asyncstorage
      await AsyncStorage.setItem(
        'token',
        token
      );

      Alert.alert(
        'Sukses',
        'Login berhasil'
      );

    } catch (error: any) {

      console.log(error.response?.data);

      Alert.alert(
        'Login Gagal',
        error.response?.data?.message ||
        'Email atau password salah'
      );

    } finally {

      setLoading(false);
    }
  };

  return (

    <SafeAreaView style={styles.container}>

      <KeyboardAvoidingView
        behavior={Platform.OS === 'ios'
          ? 'padding'
          : 'height'
        }
        style={styles.keyboardView}
      >

        <View style={styles.headerBox}>

          <Text style={styles.title}>
            Welcome Back
          </Text>

          <Text style={styles.subtitle}>
            Sign in to continue to AIDIA
          </Text>

        </View>

        <View style={styles.formBox}>

          <Input
            label="Email Address"
            placeholder="Enter your email"
            icon="mail"
            value={email}
            onChangeText={setEmail}
            keyboardType="email-address"
            autoCapitalize="none"
          />

          <Input
            label="Password"
            placeholder="Enter your password"
            icon="lock"
            value={password}
            onChangeText={setPassword}
            isPassword
          />

          <View style={styles.forgotBox}>

            <Text style={styles.forgotText}>
              Forgot Password?
            </Text>

          </View>

          <Button
            title="Sign In"
            onPress={handleLogin}
            isLoading={loading}
            style={{ marginTop: 8 }}
          />

          <Button
            title="Create an Account"
            variant="outline"
            onPress={() =>
              navigation.navigate('Register')
            }
            style={{ marginTop: 16 }}
            disabled={loading}
          />

        </View>

      </KeyboardAvoidingView>

    </SafeAreaView>
  );
}

const styles = StyleSheet.create({

  container: {
    flex: 1,
    backgroundColor: '#fff'
  },

  keyboardView: {
    flex: 1,
    justifyContent: 'center',
    paddingHorizontal: 32
  },

  headerBox: {
    marginBottom: 40
  },

  title: {
    fontSize: 32,
    fontWeight: 'bold',
    color: COLORS.textDark,
    marginBottom: 8
  },

  subtitle: {
    fontSize: 16,
    color: COLORS.textGray
  },

  formBox: {
    width: '100%'
  },

  forgotBox: {
    alignItems: 'flex-end',
    marginBottom: 24,
    marginTop: -8
  },

  forgotText: {
    fontSize: 14,
    color: COLORS.primary,
    fontWeight: '600'
  },

});