import React from 'react';
import { View, Text, StyleSheet, SafeAreaView, ScrollView, TouchableOpacity } from 'react-native';
import { Ionicons, Feather } from '@expo/vector-icons';
import { COLORS } from '../../utils/colors';
import { useNavigation } from '@react-navigation/native';

// Data Dummy Jadwal Hari Ini
const REMINDERS = [
  { id: '1', title: 'Cek Gula Darah Puasa', time: '07:00 AM', type: 'Checkup', done: true },
  { id: '2', title: 'Minum Metformin (500mg)', time: '08:00 AM', type: 'Medication', done: false },
  { id: '3', title: 'Jadwal Makan Siang', time: '12:30 PM', type: 'Nutrition', done: false },
];

export default function ReminderScreen() {
  const navigation = useNavigation<any>();

  return (
    <SafeAreaView style={styles.container}>
      <ScrollView showsVerticalScrollIndicator={false}>
        
        {/* HEADER */}
        <View style={styles.header}>
          <View style={styles.headerTop}>
            <View>
              <Text style={styles.headerTitle}>Reminders</Text>
              <Text style={styles.headerSubtitle}>Jadwal kesehatanmu hari ini</Text>
            </View>
            <TouchableOpacity 
              style={styles.calendarBtn} 
              onPress={() => navigation.navigate('Calendar')} // Pindah ke layar Kalender
            >
              <Feather name="calendar" size={20} color={COLORS.primary} />
            </TouchableOpacity>
          </View>
        </View>

        <View style={styles.content}>
          {/* LIST PENGINGAT */}
          <View style={styles.card}>
            <Text style={styles.sectionTitle}>Hari Ini</Text>
            
            {REMINDERS.map((item) => (
              <View key={item.id} style={[styles.reminderItem, item.done && styles.reminderDone]}>
                <View style={styles.reminderLeft}>
                  <TouchableOpacity style={[styles.checkbox, item.done && styles.checkboxActive]}>
                    {item.done && <Feather name="check" size={14} color="#fff" />}
                  </TouchableOpacity>
                  <View>
                    <Text style={[styles.reminderTitle, item.done && styles.textDone]}>{item.title}</Text>
                    <Text style={styles.reminderTime}>{item.type} • {item.time}</Text>
                  </View>
                </View>
                <TouchableOpacity>
                  <Feather name="more-vertical" size={20} color={COLORS.textGray} />
                </TouchableOpacity>
              </View>
            ))}

            <TouchableOpacity style={styles.addBtn}>
              <Feather name="plus" size={20} color="#fff" />
              <Text style={styles.addBtnText}>Tambah Pengingat</Text>
            </TouchableOpacity>
          </View>
        </View>
      </ScrollView>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#F8F9FA' },
  header: { 
    backgroundColor: COLORS.primary, 
    padding: 30, paddingTop: 50, paddingBottom: 60,
    borderBottomLeftRadius: 30, borderBottomRightRadius: 30,
  },
  headerTop: { flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center' },
  headerTitle: { fontSize: 24, fontWeight: 'bold', color: '#fff' },
  headerSubtitle: { fontSize: 14, color: '#fff', opacity: 0.9, marginTop: 5 },
  calendarBtn: { backgroundColor: '#fff', padding: 12, borderRadius: 15, elevation: 2 },
  content: { paddingHorizontal: 20, marginTop: -30 },
  card: { 
    backgroundColor: '#fff', borderRadius: 20, padding: 20, 
    elevation: 4, shadowColor: '#000', shadowOpacity: 0.1, shadowRadius: 10,
    marginBottom: 100
  },
  sectionTitle: { fontSize: 16, fontWeight: '700', color: COLORS.textDark, marginBottom: 15 },
  reminderItem: { 
    flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', 
    backgroundColor: '#F9FAFB', padding: 15, borderRadius: 15, marginBottom: 12,
    borderWidth: 1, borderColor: '#F3F4F6'
  },
  reminderDone: { backgroundColor: '#FDF2F8', borderColor: '#FBCFE8' }, // Efek pink saat selesai
  reminderLeft: { flexDirection: 'row', alignItems: 'center' },
  checkbox: { 
    width: 24, height: 24, borderRadius: 6, borderWidth: 2, borderColor: '#D1D5DB', 
    marginRight: 12, justifyContent: 'center', alignItems: 'center' 
  },
  checkboxActive: { backgroundColor: COLORS.primary, borderColor: COLORS.primary },
  reminderTitle: { fontSize: 15, fontWeight: '600', color: COLORS.textDark },
  textDone: { textDecorationLine: 'line-through', color: COLORS.textGray },
  reminderTime: { fontSize: 12, color: COLORS.textGray, marginTop: 2 },
  addBtn: { 
    backgroundColor: COLORS.primary, flexDirection: 'row', justifyContent: 'center', 
    alignItems: 'center', paddingVertical: 14, borderRadius: 12, marginTop: 10, gap: 8 
  },
  addBtnText: { color: '#fff', fontWeight: 'bold', fontSize: 15 },
});