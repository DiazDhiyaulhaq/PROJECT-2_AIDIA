import React from 'react';
import { View, StyleSheet, ViewProps } from 'react-native';

export const Card = ({ children, style, ...props }: ViewProps) => (
  <View style={[styles.card, style]} {...props}>
    {children}
  </View>
);

const styles = StyleSheet.create({
  card: { backgroundColor: '#fff', borderRadius: 20, padding: 20, elevation: 4, shadowColor: '#000', shadowOffset: { width: 0, height: 2 }, shadowOpacity: 0.05, shadowRadius: 15 },
});