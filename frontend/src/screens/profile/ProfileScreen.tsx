import React from 'react';
import { View, Text, StyleSheet, SafeAreaView, ScrollView, TouchableOpacity } from 'react-native';
import { Ionicons, Feather } from '@expo/vector-icons';
import { COLORS } from '../../utils/colors';

export default function ProfileScreen() {
  return (
    <SafeAreaView style={styles.container}>
      <ScrollView showsVerticalScrollIndicator={false}>
        
        {/* HEADER SECTION (Avatar & Name) */}
        <View style={styles.header}>
          <Text style={styles.headerTitle}>Profile</Text>
          <View style={styles.profileInfo}>
            <View style={styles.avatarCircle}>
              <Ionicons name="person-outline" size={40} color="#fff" />
            </View>
            <Text style={styles.userName}>Lil Amba</Text>
            <Text style={styles.userEmail}>lilamba@email.com</Text>
          </View>
        </View>

        <View style={styles.content}>
          {/* MENU CARD */}
          <View style={styles.menuCard}>
            <MenuItem 
              icon="target" 
              label="My Goals" 
              iconColor={COLORS.primary} 
              onPress={() => {}} 
            />
            <MenuItem 
              icon="trash-2" 
              label="Delete Account" 
              iconColor="#FF5C5C" 
              isLast 
              onPress={() => {}} 
            />
            <MenuItem 
              icon="log-out" 
              label="Sign out" 
              iconColor="#4B5563" 
              isLast 
              onPress={() => {}} 
            />
          </View>

          {/* STATISTICS SECTION */}
          <View style={styles.statsCard}>
            <Text style={styles.sectionTitle}>Account Statistics</Text>
            <View style={styles.statsRow}>
              <StatItem value="42" label="Days Active" />
              <StatItem value="156" label="Logs Recorded" />
            </View>
          </View>
        </View>
      </ScrollView>

      {/* FLOATING CHAT BUTTON */}
      <TouchableOpacity style={styles.fab}>
        <Ionicons name="chatbubble-outline" size={24} color="#fff" />
      </TouchableOpacity>
    </SafeAreaView>
  );
}

// Sub-komponen untuk Baris Menu
const MenuItem = ({ icon, label, iconColor, isLast, onPress }: any) => (
  <TouchableOpacity 
    style={[styles.menuItem, !isLast && styles.menuBorder]} 
    onPress={onPress}
  >
    <View style={styles.menuLeft}>
      <Feather name={icon} size={20} color={iconColor} />
      <Text style={[styles.menuLabel, { color: iconColor === '#FF5C5C' ? '#FF5C5C' : COLORS.textDark }]}>
        {label}
      </Text>
    </View>
    <Feather name="chevron-right" size={18} color="#D1D5DB" />
  </TouchableOpacity>
);

// Sub-komponen untuk Statistik
const StatItem = ({ value, label }: { value: string; label: string }) => (
  <View style={styles.statBox}>
    <Text style={styles.statValue}>{value}</Text>
    <Text style={styles.statLabel}>{label}</Text>
  </View>
);

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#F8F9FA' },
  header: { 
    backgroundColor: COLORS.primary, 
    paddingHorizontal: 30, 
    paddingTop: 50, 
    paddingBottom: 60,
    borderBottomLeftRadius: 30, 
    borderBottomRightRadius: 30,
    alignItems: 'center'
  },
  headerTitle: { fontSize: 20, fontWeight: 'bold', color: '#fff', alignSelf: 'flex-start', marginBottom: 20 },
  profileInfo: { alignItems: 'center' },
  avatarCircle: { 
    width: 90, height: 90, borderRadius: 45, 
    backgroundColor: 'rgba(255,255,255,0.2)', 
    justifyContent: 'center', alignItems: 'center',
    borderWidth: 1, borderColor: 'rgba(255,255,255,0.3)'
  },
  userName: { fontSize: 22, fontWeight: 'bold', color: '#fff', marginTop: 15 },
  userEmail: { fontSize: 14, color: '#fff', opacity: 0.8 },
  content: { paddingHorizontal: 20, marginTop: -30 },
  menuCard: { 
    backgroundColor: '#fff', borderRadius: 20, paddingHorizontal: 15, 
    elevation: 4, shadowColor: '#000', shadowOpacity: 0.1, shadowRadius: 10,
    marginBottom: 20
  },
  menuItem: { 
    flexDirection: 'row', justifyContent: 'space-between', 
    alignItems: 'center', paddingVertical: 18 
  },
  menuBorder: { borderBottomWidth: 1, borderBottomColor: '#F3F4F6' },
  menuLeft: { flexDirection: 'row', alignItems: 'center' },
  menuLabel: { fontSize: 15, fontWeight: '600', marginLeft: 15 },
  statsCard: { 
    backgroundColor: '#fff', borderRadius: 20, padding: 20,
    elevation: 4, shadowColor: '#000', shadowOpacity: 0.1, shadowRadius: 10
  },
  sectionTitle: { fontSize: 16, fontWeight: '700', color: COLORS.textDark, marginBottom: 15 },
  statsRow: { flexDirection: 'row', justifyContent: 'space-between' },
  statBox: { 
    flex: 1, backgroundColor: '#EAF6F4', borderRadius: 15, 
    paddingVertical: 20, alignItems: 'center', marginHorizontal: 5 
  },
  statValue: { fontSize: 24, fontWeight: 'bold', color: COLORS.primary },
  statLabel: { fontSize: 12, color: COLORS.textGray, marginTop: 4 },
  fab: { 
    position: 'absolute', bottom: 100, right: 20, 
    backgroundColor: COLORS.primary, width: 56, height: 56, borderRadius: 28, 
    justifyContent: 'center', alignItems: 'center', elevation: 5 
  }
});