import React from 'react';
import { View, Text, StyleSheet, FlatList, TouchableOpacity, SafeAreaView } from 'react-native';
import { Feather, MaterialCommunityIcons } from '@expo/vector-icons';

// Mock Data sesuai struktur database yang kita bahas tadi
const reminders = [
  {
    id: '1',
    medicine_name: 'Metformin',
    medicine_type: 'Tablet',
    dosage: '500mg',
    time: '08:00',
    frequency: '2x Sehari',
    is_taken: false,
  },
  {
    id: '2',
    medicine_name: 'Glimepiride',
    medicine_type: 'Kapsul',
    dosage: '2mg',
    time: '07:00',
    frequency: '1x Sehari',
    is_taken: true,
  },
];

export default function ReminderScreen() {
  const renderItem = ({ item }: { item: typeof reminders[0] }) => (
    <View style={styles.card}>
      <View style={styles.cardHeader}>
        <View style={styles.iconContainer}>
          <MaterialCommunityIcons 
            name={item.medicine_type === 'Tablet' ? 'pill' : 'medication'} 
            size={24} 
            color="#2563eb" 
          />
        </View>
        <View style={styles.infoContainer}>
          <Text style={styles.medicineName}>{item.medicine_name}</Text>
          <Text style={styles.details}>{item.dosage} • {item.frequency}</Text>
        </View>
        <View style={styles.timeBadge}>
          <Text style={styles.timeText}>{item.time}</Text>
        </View>
      </View>

      <View style={styles.cardFooter}>
        <TouchableOpacity 
          style={[styles.button, item.is_taken ? styles.btnSuccess : styles.btnOutline]}
        >
          <Feather 
            name={item.is_taken ? "check-circle" : "circle"} 
            size={18} 
            color={item.is_taken ? "#fff" : "#6b7280"} 
          />
          <Text style={[styles.btnText, item.is_taken && styles.textWhite]}>
            {item.is_taken ? 'Sudah Diminum' : 'Tandai Diminum'}
          </Text>
        </TouchableOpacity>
      </View>
    </View>
  );

  return (
    <SafeAreaView style={styles.container}>
      <View style={styles.header}>
        <Text style={styles.title}>Pengingat Obat</Text>
        <Text style={styles.subtitle}>Jangan lupa minum obat tepat waktu ya!</Text>
      </View>

      <FlatList
        data={reminders}
        renderItem={renderItem}
        keyExtractor={item => item.id}
        contentContainerStyle={styles.listContent}
        ListEmptyComponent={
          <View style={styles.empty}>
            <Feather name="coffee" size={48} color="#d1d5db" />
            <Text style={styles.emptyText}>Tidak ada jadwal obat hari ini</Text>
          </View>
        }
      />
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#f9fafb' },
  header: { padding: 24, backgroundColor: '#fff', borderBottomWidth: 1, borderBottomColor: '#f3f4f6' },
  title: { fontSize: 28, fontWeight: '800', color: '#111827', letterSpacing: -0.5 },
  subtitle: { fontSize: 14, color: '#6b7280', marginTop: 4 },
  listContent: { padding: 16 },
  card: { backgroundColor: '#fff', borderRadius: 16, padding: 16, marginBottom: 16, borderWidth: 1, borderColor: '#e5e7eb', elevation: 2, shadowColor: '#000', shadowOffset: { width: 0, height: 2 }, shadowOpacity: 0.05, shadowRadius: 4 },
  cardHeader: { flexDirection: 'row', alignItems: 'center' },
  iconContainer: { width: 48, height: 48, borderRadius: 12, backgroundColor: '#eff6ff', justifyContent: 'center', alignItems: 'center' },
  infoContainer: { flex: 1, marginLeft: 16 },
  medicineName: { fontSize: 18, fontWeight: '700', color: '#1f2937' },
  details: { fontSize: 13, color: '#6b7280', marginTop: 2 },
  timeBadge: { paddingHorizontal: 10, paddingVertical: 6, backgroundColor: '#f3f4f6', borderRadius: 8 },
  timeText: { fontSize: 14, fontWeight: '700', color: '#374151' },
  cardFooter: { marginTop: 16, paddingTop: 16, borderTopWidth: 1, borderTopColor: '#f3f4f6' },
  button: { flexDirection: 'row', height: 44, borderRadius: 10, justifyContent: 'center', alignItems: 'center', gap: 8 },
  btnOutline: { borderWidth: 1, borderColor: '#d1d5db' },
  btnSuccess: { backgroundColor: '#16a34a' },
  btnText: { fontSize: 14, fontWeight: '600', color: '#4b5563' },
  textWhite: { color: '#fff' },
  empty: { alignItems: 'center', marginTop: 100 },
  emptyText: { marginTop: 12, color: '#9ca3af', fontSize: 16 },
});