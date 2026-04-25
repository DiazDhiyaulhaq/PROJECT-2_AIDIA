import React from 'react';
import { TouchableOpacity, Text, StyleSheet, ActivityIndicator } from 'react-native';
import { COLORS } from '../utils/colors';

interface ButtonProps {
  title: string;
  onPress: () => void;
  loading?: boolean;
  variant?: 'primary' | 'outline';
}

export const Button = ({ title, onPress, loading, variant = 'primary' }: ButtonProps) => (
  <TouchableOpacity 
    style={[styles.btn, variant === 'outline' ? styles.btnOutline : styles.btnPrimary]} 
    onPress={onPress}
    disabled={loading}
  >
    {loading ? (
      <ActivityIndicator color={variant === 'primary' ? "#fff" : COLORS.primary} />
    ) : (
      <Text style={[styles.text, variant === 'outline' ? styles.textOutline : styles.textPrimary]}>
        {title}
      </Text>
    )}
  </TouchableOpacity>
);

const styles = StyleSheet.create({
  btn: { height: 56, borderRadius: 12, justifyContent: 'center', alignItems: 'center', marginVertical: 8 },
  btnPrimary: { backgroundColor: COLORS.primary },
  btnOutline: { borderWidth: 1, borderColor: COLORS.primary },
  text: { fontSize: 16, fontWeight: 'bold' },
  textPrimary: { color: '#fff' },
  textOutline: { color: COLORS.primary },
});