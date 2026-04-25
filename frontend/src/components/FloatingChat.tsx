import React from 'react';
import { TouchableOpacity, StyleSheet } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { COLORS } from '../utils/colors';
import { useNavigation } from '@react-navigation/native';

export const FloatingChat = () => {
  const navigation = useNavigation<any>();
  return (
    <TouchableOpacity 
      style={styles.fab} 
      onPress={() => navigation.navigate('Chatbot')}
    >
      <Ionicons name="chatbubble-ellipses" size={28} color="#fff" />
    </TouchableOpacity>
  );
};

const styles = StyleSheet.create({
  fab: {
    position: 'absolute',
    bottom: 90,
    right: 20,
    backgroundColor: COLORS.primary,
    width: 60,
    height: 60,
    borderRadius: 30,
    justifyContent: 'center',
    alignItems: 'center',
    elevation: 5,
    shadowColor: '#000',
    shadowOpacity: 0.3,
    shadowRadius: 5,
  },
});