import React, { useState } from 'react'; // Tambahkan useState di sini
import { View, Text, StyleSheet, SafeAreaView, ScrollView, TouchableOpacity } from 'react-native';
import { MaterialCommunityIcons, Ionicons } from '@expo/vector-icons';
import { COLORS } from '../../utils/colors';
import LogGlucoseModal from './LogGlucoseModal'; // Pastikan path import benar

export default function HomeScreen() {
  // State untuk mengontrol muncul/tidaknya modal
  const [isGlucoseModalVisible, setIsGlucoseModalVisible] = useState(false);

  return (
    <SafeAreaView style={styles.container}>
      <ScrollView showsVerticalScrollIndicator={false}>
        
        {/* HEADER SECTION */}
        <View style={styles.header}>
          <Text style={styles.welcomeText}>Welcome back,</Text>
          <Text style={styles.userName}>Lil Amba</Text>
        </View>

        <View style={styles.content}>
          {/* HEALTH OVERVIEW CARD */}
          <View style={styles.sectionCard}>
            <Text style={styles.sectionTitle}>Health Overview</Text>
            
            <HealthItem 
              icon="water" 
              label="Insulin Level" 
              value="12.5 mU/L" 
              status="Normal" 
              bgColor={COLORS.bgInsulin} 
              iconColor={COLORS.insulinIcon}
              statusColor="#4EB0A0"
            />

            <HealthItem 
              icon="analytics" 
              label="Blood Glucose" 
              value="125 mg/dL" 
              status="Monitor" 
              bgColor={COLORS.bgGlucose} 
              iconColor={COLORS.glucoseIcon}
              statusColor="#F5A623"
            />

            <HealthItem 
              icon="heart" 
              label="Fitness Score" 
              value="78/100" 
              status="Good" 
              bgColor={COLORS.bgFitness} 
              iconColor={COLORS.fitnessIcon}
              statusColor="#FF5C5C"
            />
          </View>

          {/* QUICK ACTIONS SECTION */}
          <View style={styles.sectionCard}>
            <Text style={styles.sectionTitle}>Quick Actions</Text>
            <View style={styles.actionRow}>
              
              {/* TOMBOL LOG GLUCOSE - Sekarang bisa diklik */}
              <TouchableOpacity 
                style={styles.actionButton} 
                onPress={() => setIsGlucoseModalVisible(true)}
              >
                <View style={styles.actionIconCircle}>
                  <Ionicons name="add" size={24} color="#fff" />
                </View>
                <Text style={styles.actionText}>Log Glucose</Text>
              </TouchableOpacity>

              <TouchableOpacity style={styles.actionButton}>
                <View style={styles.actionIconCircle}>
                  <MaterialCommunityIcons name="silverware-fork-knife" size={20} color="#fff" />
                </View>
                <Text style={styles.actionText}>Add Meal</Text>
              </TouchableOpacity>
            </View>
          </View>
        </View>
      </ScrollView>

      {/* MODAL INPUT GLUCOSE */}
      <LogGlucoseModal 
        isVisible={isGlucoseModalVisible} 
        onClose={() => setIsGlucoseModalVisible(false)} 
      />

      {/* FLOATING CHAT BUTTON */}
      <TouchableOpacity style={styles.fab}>
        <Ionicons name="chatbubble-outline" size={24} color="#fff" />
      </TouchableOpacity>
    </SafeAreaView>
  );
}

// Sub-komponen untuk baris kesehatan
const HealthItem = ({ icon, label, value, status, bgColor, iconColor, statusColor }: any) => (
  <View style={[styles.healthRow, { backgroundColor: bgColor }]}>
    <View style={[styles.iconBox, { backgroundColor: iconColor }]}>
      <Ionicons name={icon} size={20} color="#fff" />
    </View>
    <View style={styles.healthInfo}>
      <Text style={styles.healthLabel}>{label}</Text>
      <Text style={styles.healthValue}>{value}</Text>
    </View>
    <View style={styles.statusBadge}>
      <Text style={[styles.statusText, { color: statusColor }]}>{status}</Text>
    </View>
  </View>
);

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#F8F9FA' },
  header: { 
    backgroundColor: COLORS.primary, 
    padding: 30, 
    paddingTop: 50,
    borderBottomLeftRadius: 30, 
    borderBottomRightRadius: 30,
    height: 180
  },
  welcomeText: { fontSize: 18, color: '#fff', opacity: 0.9 },
  userName: { fontSize: 28, fontWeight: 'bold', color: '#fff', marginTop: 5 },
  content: { paddingHorizontal: 20, marginTop: -40 },
  sectionCard: { 
    backgroundColor: '#fff', 
    borderRadius: 20, 
    padding: 20, 
    marginBottom: 20,
    elevation: 4, 
    shadowColor: '#000', shadowOffset: { width: 0, height: 2 }, shadowOpacity: 0.1, shadowRadius: 10
  },
  sectionTitle: { fontSize: 16, fontWeight: '700', color: COLORS.textDark, marginBottom: 15 },
  healthRow: { 
    flexDirection: 'row', 
    alignItems: 'center', 
    padding: 12, 
    borderRadius: 15, 
    marginBottom: 12 
  },
  iconBox: { width: 40, height: 40, borderRadius: 20, justifyContent: 'center', alignItems: 'center' },
  healthInfo: { flex: 1, marginLeft: 15 },
  healthLabel: { fontSize: 12, color: COLORS.textGray },
  healthValue: { fontSize: 18, fontWeight: 'bold', color: COLORS.textDark },
  statusBadge: { backgroundColor: '#fff', paddingHorizontal: 12, paddingVertical: 4, borderRadius: 20 },
  statusText: { fontSize: 12, fontWeight: '600' },
  actionRow: { flexDirection: 'row', justifyContent: 'space-between' },
  actionButton: { 
    backgroundColor: COLORS.primary, 
    width: '48%', 
    height: 100, 
    borderRadius: 15, 
    justifyContent: 'center', 
    alignItems: 'center' 
  },
  actionIconCircle: { 
    width: 35, height: 35, borderRadius: 18, 
    borderWidth: 1, borderColor: 'rgba(255,255,255,0.5)', 
    justifyContent: 'center', alignItems: 'center', marginBottom: 8 
  },
  actionText: { color: '#fff', fontWeight: 'bold', fontSize: 14 },
  fab: { 
    position: 'absolute', 
    bottom: 100, 
    right: 20, 
    backgroundColor: COLORS.primary, 
    width: 56, height: 56, borderRadius: 28, 
    justifyContent: 'center', alignItems: 'center', 
    elevation: 5 
  }
});