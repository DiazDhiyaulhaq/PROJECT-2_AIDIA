import React from 'react';
import { View, Text, StyleSheet, SafeAreaView, TouchableOpacity } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { useAuthStore } from '../../store/useAuthStore';

export default function ProfileScreen() {
  const { user, logout } = useAuthStore();

  const handleSignOut = () => {
    logout(); // Ini bakal otomatis pindahin kamu ke layar Login
  };

  return (
    <SafeAreaView style={styles.container}>
      <Text style={styles.headerTitle}>Menu Profile</Text>

      <View style={styles.content}>
        {/* User Info */}
        <View style={styles.userInfoRow}>
          <View style={styles.avatarCircle} />
          <Text style={styles.userName}>{user?.name || 'Lil Amba'}</Text>
        </View>

        {/* Menu Items */}
        <TouchableOpacity style={styles.menuItem}>
          <Text style={styles.menuText}>My Goals</Text>
          <Ionicons name="chevron-forward" size={20} color="#9CA3AF" />
        </TouchableOpacity>

        <TouchableOpacity style={styles.menuItem}>
          <Text style={styles.menuText}>Delete Account</Text>
          <Ionicons name="chevron-forward" size={20} color="#9CA3AF" />
        </TouchableOpacity>

        {/* Sign Out Button */}
        <TouchableOpacity style={styles.menuItem} onPress={handleSignOut}>
          <Text style={styles.menuText}>Sign out</Text>
          <Ionicons name="chevron-forward" size={20} color="#9CA3AF" />
        </TouchableOpacity>
      </View>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#fff', padding: 24 },
  headerTitle: { fontSize: 20, fontWeight: 'bold', color: '#111827', marginBottom: 32 },
  content: { gap: 8 },
  userInfoRow: { flexDirection: 'row', alignItems: 'center', gap: 16, marginBottom: 32 },
  avatarCircle: { width: 64, height: 64, borderRadius: 32, backgroundColor: '#E5E7EB' },
  userName: { fontSize: 18, color: '#111827', fontWeight: '500' },
  menuItem: { flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', paddingVertical: 16, borderBottomWidth: 1, borderBottomColor: '#E5E7EB' },
  menuText: { fontSize: 16, color: '#111827' }
});