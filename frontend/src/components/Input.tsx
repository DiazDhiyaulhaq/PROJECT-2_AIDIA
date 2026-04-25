import React from 'react';
import { View, Text, TextInput, StyleSheet, TextInputProps } from 'react-native';
import { COLORS } from '../utils/colors';

interface InputProps extends TextInputProps {
  label: string;
}

export const Input = ({ label, ...props }: InputProps) => (
  <View style={styles.container}>
    <Text style={styles.label}>{label}</Text>
    <TextInput 
      style={styles.input} 
      placeholderTextColor="#9CA3AF"
      {...props} 
    />
  </View>
);

const styles = StyleSheet.create({
  container: { marginBottom: 16 },
  label: { fontSize: 14, fontWeight: '600', color: COLORS.textDark, marginBottom: 8 },
  input: { 
    backgroundColor: '#F9FAFB', 
    borderWidth: 1, 
    borderColor: '#E5E7EB', 
    borderRadius: 12, 
    padding: 15, 
    fontSize: 16,
    color: COLORS.textDark
  },
});