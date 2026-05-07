import React from 'react';
import { TouchableOpacity, Text, ActivityIndicator, StyleSheet, TouchableOpacityProps } from 'react-native';
import { COLORS } from '../utils/colors';

interface ButtonProps extends TouchableOpacityProps {
  title: string;
  variant?: 'primary' | 'secondary' | 'outline';
  isLoading?: boolean;
}

export const Button = ({ title, variant = 'primary', isLoading, style, disabled, ...props }: ButtonProps) => {
  const isOutline = variant === 'outline';
  
  return (
    <TouchableOpacity 
      style={[
        styles.btn, 
        isOutline ? styles.btnOutline : styles.btnPrimary,
        (disabled || isLoading) && styles.btnDisabled,
        style
      ]} 
      disabled={disabled || isLoading}
      {...props}
    >
      {isLoading ? (
        <ActivityIndicator color={isOutline ? COLORS.primary : '#fff'} />
      ) : (
        <Text style={[styles.text, isOutline ? styles.textOutline : styles.textPrimary]}>
          {title}
        </Text>
      )}
    </TouchableOpacity>
  );
};

const styles = StyleSheet.create({
  btn: { height: 56, borderRadius: 12, justifyContent: 'center', alignItems: 'center', width: '100%' },
  btnPrimary: { backgroundColor: COLORS.primary, elevation: 4, shadowColor: COLORS.primary, shadowOffset: { width: 0, height: 4 }, shadowOpacity: 0.3, shadowRadius: 6 },
  btnOutline: { backgroundColor: 'transparent', borderWidth: 1.5, borderColor: COLORS.primary },
  btnDisabled: { opacity: 0.6 },
  text: { fontSize: 16, fontWeight: 'bold' },
  textPrimary: { color: '#fff' },
  textOutline: { color: COLORS.primary },
});