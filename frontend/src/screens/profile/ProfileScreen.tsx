import React from 'react';

import {
  View,
  Text,
  StyleSheet,
  SafeAreaView,
  TouchableOpacity,
  Alert
} from 'react-native';

import AsyncStorage from '@react-native-async-storage/async-storage';

import { Ionicons } from '@expo/vector-icons';

import { useAuthStore } from '../../store/useAuthStore';

export default function ProfileScreen() {

  const user = useAuthStore(
    (state: any) => state.user
  );

  const handleSignOut = async () => {

    console.log('KLIK LOGOUT');

    try {

      await AsyncStorage.clear();

      console.log('ASYNC CLEARED');

      useAuthStore.setState({
        token: null,
        user: null
      });

      console.log('ZUSTAND CLEARED');

    } catch (error) {

      console.log('ERROR LOGOUT:', error);
    }
  };

  return (

    <SafeAreaView style={styles.container}>

      <Text style={styles.headerTitle}>
        Menu Profile
      </Text>

      <View style={styles.content}>

        <View style={styles.userInfoRow}>

          <View style={styles.avatarCircle} />

          <Text style={styles.userName}>
            {user?.name || 'User'}
          </Text>

        </View>

        <TouchableOpacity
          style={styles.menuItem}
          onPress={handleSignOut}
        >

          <Text style={styles.menuText}>
            Sign out
          </Text>

          <Ionicons
            name="chevron-forward"
            size={20}
            color="#9CA3AF"
          />

        </TouchableOpacity>

      </View>

    </SafeAreaView>
  );
}

const styles = StyleSheet.create({

  container: {
    flex: 1,
    backgroundColor: '#fff',
    padding: 24
  },

  headerTitle: {
    fontSize: 20,
    fontWeight: 'bold',
    color: '#111827',
    marginBottom: 32
  },

  content: {
    gap: 8
  },

  userInfoRow: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 16,
    marginBottom: 32
  },

  avatarCircle: {
    width: 64,
    height: 64,
    borderRadius: 32,
    backgroundColor: '#E5E7EB'
  },

  userName: {
    fontSize: 18,
    color: '#111827',
    fontWeight: '500'
  },

  menuItem: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    paddingVertical: 16,
    borderBottomWidth: 1,
    borderBottomColor: '#E5E7EB'
  },

  menuText: {
    fontSize: 16,
    color: '#111827'
  },

});