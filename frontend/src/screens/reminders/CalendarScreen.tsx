import React, { useState } from 'react';
import { View, Text, StyleSheet, SafeAreaView, TouchableOpacity } from 'react-native';
import { Calendar } from 'react-native-calendars';
import { Ionicons } from '@expo/vector-icons';
import { COLORS } from '../../utils/colors';
import { useNavigation } from '@react-navigation/native';

export default function CalendarScreen() {
  const navigation = useNavigation();
  const [selectedDate, setSelectedDate] = useState('');

  return (
    <SafeAreaView style={styles.container}>
      {/* HEADER SIMPLE */}
      <View style={styles.header}>
        <TouchableOpacity onPress={() => navigation.goBack()} style={styles.backBtn}>
          <Ionicons name="chevron-back" size={24} color={COLORS.textDark} />
        </TouchableOpacity>
        <Text style={styles.headerTitle}>Jadwal Bulanan</Text>
        <View style={{ width: 24 }} /> {/* Spacer biar judul di tengah */}
      </View>

      {/* KALENDER COMPONENT */}
      <View style={styles.calendarWrapper}>
        <Calendar
          onDayPress={(day: any) => {
            setSelectedDate(day.dateString);
          }}
          markedDates={{
            [selectedDate]: { selected: true, disableTouchEvent: true },
            '2026-04-28': { marked: true, dotColor: COLORS.primary },
            '2026-04-30': { marked: true, dotColor: COLORS.primary },
          }}
          theme={{
            backgroundColor: '#ffffff',
            calendarBackground: '#ffffff',
            textSectionTitleColor: '#b6c1cd',
            selectedDayBackgroundColor: COLORS.primary, // Warna Pink pas diklik
            selectedDayTextColor: '#ffffff',
            todayTextColor: COLORS.primary,
            dayTextColor: COLORS.textDark,
            textDisabledColor: '#d9e1e8',
            dotColor: COLORS.primary, // Titik pengingat warna Pink
            arrowColor: COLORS.primary, // Panah bulan warna Pink
            monthTextColor: COLORS.textDark,
            textDayFontWeight: '500',
            textMonthFontWeight: 'bold',
            textDayHeaderFontWeight: '600',
          }}
        />
      </View>

      <View style={styles.infoBox}>
        <Ionicons name="information-circle" size={20} color={COLORS.primary} />
        <Text style={styles.infoText}>
          Pilih tanggal yang memiliki titik merah untuk melihat jadwal pengingat pada hari tersebut.
        </Text>
      </View>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#F8F9FA' },
  header: { 
    flexDirection: 'row', alignItems: 'center', justifyContent: 'space-between', 
    paddingHorizontal: 20, paddingTop: 10, paddingBottom: 20 
  },
  backBtn: { padding: 5, backgroundColor: '#fff', borderRadius: 10, elevation: 2 },
  headerTitle: { fontSize: 18, fontWeight: 'bold', color: COLORS.textDark },
  calendarWrapper: { 
    marginHorizontal: 20, borderRadius: 20, overflow: 'hidden', 
    elevation: 4, shadowColor: '#000', shadowOpacity: 0.1, shadowRadius: 10 
  },
  infoBox: { 
    flexDirection: 'row', backgroundColor: '#FDF2F8', marginHorizontal: 20, 
    marginTop: 20, padding: 15, borderRadius: 12, alignItems: 'center' 
  },
  infoText: { flex: 1, fontSize: 13, color: '#BE185D', marginLeft: 10, lineHeight: 18 },
});