import React, { useState } from 'react';

import {
  View,
  Text,
  StyleSheet,
  SafeAreaView,
  KeyboardAvoidingView,
  Platform,
  ScrollView,
  Alert
} from 'react-native';

import { useNavigation } from '@react-navigation/native';

import { COLORS } from '../../utils/colors';

import { Input, Button } from '../../components';

import api from '../../services/api';

export default function RegisterScreen() {

  const navigation = useNavigation<any>();

  const [name, setName] = useState('');

  const [email, setEmail] = useState('');

  const [password, setPassword] = useState('');

  const [loading, setLoading] = useState(false);

  const handleRegister = async () => {

    if (!name || !email || !password) {

      return Alert.alert(
        'Error',
        'Semua field wajib diisi'
      );
    }

    try {

      setLoading(true);

      await api.post('/register', {
        name,
        email,
        password
      });

      Alert.alert(
        'Sukses',
        'Registrasi berhasil! Silakan login.',
        [
          {
            text: 'OK',
            onPress: () => navigation.goBack()
          }
        ]
      );

    } catch (error: any) {

      console.log(error.response?.data);

      Alert.alert(
        'Register Gagal',
        error.response?.data?.message || 'Terjadi kesalahan'
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
        style={{ flex: 1 }}
      >

        <ScrollView
          contentContainerStyle={styles.scrollContent}
          showsVerticalScrollIndicator={false}
        >

          <View style={styles.headerBox}>

            <Text style={styles.title}>
              Join AIDIA
            </Text>

            <Text style={styles.subtitle}>
              Start your health journey today
            </Text>

          </View>

          <View style={styles.formBox}>

            <Input
              label="Full Name"
              placeholder="e.g. John Doe"
              icon="user"
              value={name}
              onChangeText={setName}
            />

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
              placeholder="Create a strong password"
              icon="lock"
              value={password}
              onChangeText={setPassword}
              isPassword
            />

            <Button
              title="Register"
              onPress={handleRegister}
              isLoading={loading}
              style={{ marginTop: 24 }}
            />

            <Button
              title="Already have an account? Login"
              variant="outline"
              onPress={() => navigation.goBack()}
              style={{ marginTop: 16 }}
              disabled={loading}
            />

          </View>

        </ScrollView>

      </KeyboardAvoidingView>

    </SafeAreaView>
  );
}

const styles = StyleSheet.create({

  container: {
    flex: 1,
    backgroundColor: '#fff'
  },

  scrollContent: {
    flexGrow: 1,
    justifyContent: 'center',
    paddingHorizontal: 32,
    paddingVertical: 40
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

});