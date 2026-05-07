import React from 'react';
import { TouchableOpacity, StyleSheet } from 'react-native';
import { Feather } from '@expo/vector-icons';
import { useNavigation } from '@react-navigation/native';
import { COLORS } from '../utils/colors';

export const FloatingChat = () => {
  const navigation = useNavigation<any>();
  return (
    <TouchableOpacity style={styles.fab} onPress={() => navigation.navigate('Chatbot')}>
      <Feather name="message-circle" size={28} color="#fff" />
    </TouchableOpacity>
  );
};

const styles = StyleSheet.create({
  fab: { position: 'absolute', bottom: 20, right: 20, backgroundColor: COLORS.primary, width: 60, height: 60, borderRadius: 30, justifyContent: 'center', alignItems: 'center', elevation: 6, shadowColor: COLORS.primary, shadowOpacity: 0.4, shadowRadius: 8, shadowOffset: { width: 0, height: 4 }, zIndex: 999 },
});