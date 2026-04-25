import React, { useState } from 'react';
import {
  View,
  Text,
  StyleSheet,
  TextInput,
  TouchableOpacity,
  SafeAreaView,
  KeyboardAvoidingView,
  Platform,
  ScrollView,
} from 'react-native';
import { Ionicons } from '@expo/vector-icons'; // Ikon standar Expo
import { COLORS } from '../../utils/colors'; // Import konstanta warna
import { useNavigation } from '@react-navigation/native'; // Untuk pindah halaman

export default function LoginScreen() {
  const navigation = useNavigation();
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [secureText, setSecureText] = useState(true); // Untuk mata password

  const handleSignIn = () => {
    // Logika login nti di sini
    console.log('Login:', email, password);
    // Contoh pindah ke Home nti:
    // navigation.replace('MainTabs'); 
  };

  return (
    <SafeAreaView style={styles.container}>
      {/* KeyboardAvoidingView agar input tidak tertutup keyboard HP */}
      <KeyboardAvoidingView
        behavior={Platform.OS === 'ios' ? 'padding' : 'height'}
        style={{ flex: 1 }}
      >
        <ScrollView contentContainerStyle={styles.scrollContent}>
          {/* Bagian LOGO & Judul - Sesuai gambar */}
          <View style={styles.logoSection}>
            <Text style={styles.appTitle}>AIDIA</Text>
            <Text style={styles.appSubtitle}>Your Health Companion</Text>
          </View>

          {/* Bagian FORM - Sesuai gambar */}
          <View style={styles.formSection}>
            {/* Input Email */}
            <View style={styles.inputWrapper}>
              <Text style={styles.inputLabel}>Email Address</Text>
              <View style={styles.inputContainer}>
                <Ionicons name="mail-outline" size={20} color={COLORS.textGray} style={styles.inputIcon} />
                <TextInput
                  style={styles.textInput}
                  placeholder="Enter your email"
                  value={email}
                  onChangeText={setEmail}
                  keyboardType="email-address"
                  autoCapitalize="none"
                />
              </View>
            </View>

            {/* Input Password */}
            <View style={styles.inputWrapper}>
              <Text style={styles.inputLabel}>Password</Text>
              <View style={styles.inputContainer}>
                <Ionicons name="lock-closed-outline" size={20} color={COLORS.textGray} style={styles.inputIcon} />
                <TextInput
                  style={styles.textInput}
                  placeholder="Enter your password"
                  value={password}
                  onChangeText={setPassword}
                  secureTextEntry={secureText}
                />
                {/* Tombol Mata untuk lihat password */}
                <TouchableOpacity onPress={() => setSecureText(!secureText)}>
                  <Ionicons
                    name={secureText ? 'eye-off-outline' : 'eye-outline'}
                    size={20}
                    color={COLORS.textGray}
                  />
                </TouchableOpacity>
              </View>
            </View>

            {/* Tombol SIGN IN - Warna Teal */}
            <TouchableOpacity style={styles.signInButton} onPress={handleSignIn}>
              <Text style={styles.signInButtonText}>Sign In</Text>
            </TouchableOpacity>

            {/* Link REGISTER - Sesuai gambar */}
            <TouchableOpacity style={styles.registerLink} onPress={() => console.log('Pindah Register')}>
              <Text style={styles.registerText}>
                Don't have an account? <Text style={styles.registerTextBold}>Register</Text>
              </Text>
            </TouchableOpacity>
          </View>
        </ScrollView>
      </KeyboardAvoidingView>
    </SafeAreaView>
  );
}

// Styling ala Shadcn mobile
const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: COLORS.white,
  },
  scrollContent: {
    flexGrow: 1,
    justifyContent: 'center', // Agar konten di tengah layar
    paddingHorizontal: 24,
  },
  logoSection: {
    alignItems: 'center',
    marginBottom: 48, // Jarak besar ke bawah
  },
  appTitle: {
    fontSize: 40,
    fontWeight: 'bold',
    color: COLORS.primary, // Warna Teal
    letterSpacing: 1.2,
  },
  appSubtitle: {
    fontSize: 16,
    color: COLORS.textDark,
    marginTop: 8,
  },
  formSection: {
    width: '100%',
  },
  inputWrapper: {
    marginBottom: 20,
  },
  inputLabel: {
    fontSize: 14,
    fontWeight: '600',
    color: COLORS.textDark,
    marginBottom: 8,
  },
  inputContainer: {
    flexDirection: 'row',
    alignItems: 'center',
    backgroundColor: COLORS.inputBg,
    borderWidth: 1,
    borderColor: COLORS.border,
    borderRadius: 12,
    paddingHorizontal: 16,
    height: 56, // Input agak tinggi biar modern
  },
  inputIcon: {
    marginRight: 12,
  },
  textInput: {
    flex: 1,
    fontSize: 16,
    color: COLORS.textDark,
  },
  signInButton: {
    backgroundColor: COLORS.primary,
    height: 56,
    borderRadius: 12,
    justifyContent: 'center',
    alignItems: 'center',
    marginTop: 16,
    // Shadow ala iOS
    shadowColor: COLORS.primary,
    shadowOffset: { width: 0, height: 4 },
    shadowOpacity: 0.3,
    shadowRadius: 6,
    // Shadow ala Android
    elevation: 4,
  },
  signInButtonText: {
    fontSize: 18,
    fontWeight: 'bold',
    color: COLORS.white,
  },
  registerLink: {
    marginTop: 24,
    alignItems: 'center',
  },
  registerText: {
    fontSize: 14,
    color: COLORS.textGray,
  },
  registerTextBold: {
    color: COLORS.primary,
    fontWeight: '700',
  },
});