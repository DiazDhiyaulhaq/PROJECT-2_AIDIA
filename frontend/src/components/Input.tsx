import React, { useState } from 'react';
import { View, TextInput, Text, StyleSheet, TouchableOpacity, TextInputProps } from 'react-native';
import { Feather } from '@expo/vector-icons';
import { COLORS } from '../utils/colors';

interface InputProps extends TextInputProps {
  label?: string;
  icon?: keyof typeof Feather.glyphMap;
  isPassword?: boolean;
  error?: string;
}

export const Input = ({ label, icon, isPassword, error, ...props }: InputProps) => {
  const [isSecure, setIsSecure] = useState(isPassword);
  const [isFocused, setIsFocused] = useState(false);

  return (
    <View style={styles.container}>
      {label && <Text style={styles.label}>{label}</Text>}
      <View style={[styles.inputContainer, isFocused && styles.inputFocused, error && styles.inputError]}>
        {icon && <Feather name={icon} size={20} color={isFocused ? COLORS.primary : '#9CA3AF'} style={styles.icon} />}
        
        <TextInput
          style={styles.input}
          placeholderTextColor="#9CA3AF"
          secureTextEntry={isSecure}
          onFocus={() => setIsFocused(true)}
          onBlur={() => setIsFocused(false)}
          {...props}
        />
        
        {isPassword && (
          <TouchableOpacity onPress={() => setIsSecure(!isSecure)} style={styles.eyeIcon}>
            <Feather name={isSecure ? 'eye-off' : 'eye'} size={20} color="#9CA3AF" />
          </TouchableOpacity>
        )}
      </View>
      {error && <Text style={styles.errorText}>{error}</Text>}
    </View>
  );
};

const styles = StyleSheet.create({
  container: { marginBottom: 16, width: '100%' },
  label: { fontSize: 14, fontWeight: '600', color: '#374151', marginBottom: 8 },
  inputContainer: { flexDirection: 'row', alignItems: 'center', backgroundColor: '#F9FAFB', borderWidth: 1, borderColor: '#E5E7EB', borderRadius: 12, paddingHorizontal: 16, height: 56 },
  inputFocused: { borderColor: COLORS.primary, backgroundColor: '#fff', elevation: 2, shadowColor: COLORS.primary, shadowOpacity: 0.1, shadowRadius: 4 },
  inputError: { borderColor: '#EF4444' },
  input: { flex: 1, fontSize: 16, color: '#111827' },
  icon: { marginRight: 12 },
  eyeIcon: { padding: 4, marginLeft: 8 },
  errorText: { color: '#EF4444', fontSize: 12, marginTop: 4 },
});