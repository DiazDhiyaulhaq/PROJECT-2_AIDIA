import React from 'react';
import { View, Text, StyleSheet, TouchableOpacity } from 'react-native';
import { Patient } from '../utils/types';

interface PatientCardProps {
  patient: Patient;
  onPress: (p: Patient) => void;
}

export const PatientCard = ({ patient, onPress }: PatientCardProps) => {
  const isHighRisk = patient.risiko === 'tinggi';

  return (
    <View style={[styles.card, isHighRisk && styles.borderHigh]}>
      <View style={styles.row}>
        <View>
          <Text style={styles.name}>{patient.nama}</Text>
          <Text style={styles.sub}>{patient.usia} Tahun • {patient.gulaDarah} mg/dL</Text>
        </View>
        <View style={[styles.badge, isHighRisk ? styles.bgRed : styles.bgYellow]}>
          <Text style={styles.badgeText}>{patient.risiko.toUpperCase()}</Text>
        </View>
      </View>
      
      <TouchableOpacity 
        style={styles.button} 
        onPress={() => onPress(patient)}
      >
        <Text style={styles.buttonText}>Lihat Detail</Text>
      </TouchableOpacity>
    </View>
  );
};

const styles = StyleSheet.create({
  card: {
    backgroundColor: '#fff',
    borderRadius: 12,
    padding: 16,
    marginBottom: 12,
    borderWidth: 1,
    borderColor: '#e5e7eb',
    elevation: 2,
  },
  borderHigh: { borderColor: '#fecaca', backgroundColor: '#fef2f2' },
  row: { flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center' },
  name: { fontSize: 16, fontWeight: '700', color: '#111827' },
  sub: { fontSize: 13, color: '#6b7280', marginTop: 2 },
  badge: { paddingHorizontal: 8, paddingVertical: 4, borderRadius: 6 },
  bgRed: { backgroundColor: '#ef4444' },
  bgYellow: { backgroundColor: '#f59e0b' },
  badgeText: { color: '#fff', fontSize: 10, fontWeight: '800' },
  button: { marginTop: 12, backgroundColor: '#2563eb', padding: 8, borderRadius: 6, alignItems: 'center' },
  buttonText: { color: '#fff', fontWeight: '600', fontSize: 14 },
});