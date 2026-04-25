import React, { useState } from 'react';
import { View, StyleSheet, SafeAreaView, Text } from 'react-native';
import { Calendar } from 'react-native-calendars';

export default function CalendarScreen() {
  const [selected, setSelected] = useState('');

  return (
    <SafeAreaView style={styles.container}>
      <View style={styles.header}>
        <Text style={styles.title}>Riwayat Kepatuhan</Text>
        <Text style={styles.subtitle}>Pantau catatan konsumsi obat bulanan</Text>
      </View>

      <View style={styles.calendarWrapper}>
        <Calendar
          onDayPress={day => setSelected(day.dateString)}
          markedDates={{
            [selected]: { selected: true, disableTouchEvent: true, selectedColor: '#2563eb' },
            '2026-04-20': { marked: true, dotColor: '#16a34a' }, // Contoh sudah minum
            '2026-04-21': { marked: true, dotColor: '#ef4444' }, // Contoh terlewat
          }}
          theme={{
            textDayFontWeight: '500',
            textMonthFontWeight: 'bold',
            textDayHeaderFontWeight: '600',
            todayTextColor: '#2563eb',
            arrowColor: '#2563eb',
            selectedDayBackgroundColor: '#2563eb',
          }}
        />
      </View>

      <View style={styles.legendCard}>
        <Text style={styles.legendTitle}>Keterangan:</Text>
        <View style={styles.legendRow}>
          <View style={[styles.dot, { backgroundColor: '#16a34a' }]} />
          <Text style={styles.legendText}>Diminum Tepat Waktu</Text>
        </View>
        <View style={styles.legendRow}>
          <View style={[styles.dot, { backgroundColor: '#ef4444' }]} />
          <Text style={styles.legendText}>Terlewat / Tidak Diminum</Text>
        </View>
      </View>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#f9fafb' },
  header: { padding: 24, backgroundColor: '#fff' },
  title: { fontSize: 24, fontWeight: 'bold', color: '#111827' },
  subtitle: { fontSize: 14, color: '#6b7280', marginTop: 4 },
  calendarWrapper: { marginTop: 12, backgroundColor: '#fff', paddingBottom: 10 },
  legendCard: { margin: 16, padding: 16, backgroundColor: '#fff', borderRadius: 12, borderWidth: 1, borderColor: '#e5e7eb' },
  legendTitle: { fontSize: 14, fontWeight: '700', color: '#374151', marginBottom: 12 },
  legendRow: { flexDirection: 'row', alignItems: 'center', marginBottom: 8 },
  dot: { width: 10, height: 10, borderRadius: 5, marginRight: 10 },
  legendText: { fontSize: 13, color: '#4b5563' }
});