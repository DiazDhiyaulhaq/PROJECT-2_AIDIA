import React, { useState, useEffect } from 'react';
import { View, Text, StyleSheet, SafeAreaView, ScrollView, TouchableOpacity } from 'react-native';
import { Feather } from '@expo/vector-icons';
import { COLORS } from '../../utils/colors'; 
import { useNavigation } from '@react-navigation/native';
import { Card } from '../../components';

export default function GlucoseScreen() {
  const navigation = useNavigation();
  const [glucose, setGlucose] = useState<string | null>(null);

  useEffect(() => {
    // Simulasi ambil data
    setTimeout(() => setGlucose('125'), 800);
  }, []);

  return (
    <SafeAreaView style={styles.container}>
      <View style={styles.header}>
        <TouchableOpacity onPress={() => navigation.goBack()} style={styles.backBtn}>
          <Feather name="chevron-left" size={24} color={COLORS.textDark} />
        </TouchableOpacity>
        <Text style={styles.headerTitle}>My Glucose</Text>
        <View style={{ width: 40 }} />
      </View>

      <ScrollView contentContainerStyle={styles.content}>
        <Card style={styles.bigCard}>
          <Text style={styles.cardSubtitle}>Glucose in Range</Text>
          <View style={styles.valueRow}>
            <Text style={styles.bigValue}>{glucose ?? '...'}</Text>
            <View style={styles.unitCol}>
              <Text style={styles.unitText}>mg/dL</Text>
              <Feather name="trending-up" size={24} color={COLORS.textGray} />
            </View>
          </View>
        </Card>

        <Card style={styles.warningCard}>
          <Text style={styles.warningText}>
            Sepertinya kamu kebanyakan makan makanan tinggi gula, segera kurangi!
          </Text>
        </Card>

        {/* Skeleton Box */}
        <View style={styles.skeletonContainer}>
          {[1, 2, 3, 4].map((item) => (
            <View key={item} style={styles.skeletonBar} />
          ))}
        </View>

        <View style={styles.footerNote}>
          <Text style={styles.footerNoteText}>
            DATA DIAMBIL TINGGAL SELARASKAN DENGAN INSULIN
          </Text>
        </View>
      </ScrollView>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#F8F9FA' },
  header: { flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', padding: 24, paddingTop: 40 },
  backBtn: { padding: 8, backgroundColor: '#fff', borderRadius: 12, elevation: 2 },
  headerTitle: { fontSize: 20, fontWeight: 'bold', color: COLORS.textDark },
  content: { padding: 24, gap: 16 },
  bigCard: { backgroundColor: '#E5E7EB', alignItems: 'center', paddingVertical: 40 },
  cardSubtitle: { fontSize: 14, color: COLORS.textGray, marginBottom: 8 },
  valueRow: { flexDirection: 'row', alignItems: 'center', gap: 12 },
  bigValue: { fontSize: 64, fontWeight: 'bold', color: COLORS.textDark },
  unitCol: { alignItems: 'flex-start' },
  unitText: { fontSize: 16, color: COLORS.textDark, fontWeight: '600' },
  warningCard: { borderWidth: 1, borderColor: '#D1D5DB', backgroundColor: '#fff', elevation: 0 },
  warningText: { fontSize: 15, color: COLORS.textDark, lineHeight: 22 },
  skeletonContainer: { gap: 12 },
  skeletonBar: { height: 48, backgroundColor: '#E5E7EB', borderRadius: 12 },
  footerNote: { backgroundColor: '#F3F4F6', borderRadius: 12, padding: 16, alignItems: 'center', marginTop: 8 },
  footerNoteText: { fontSize: 12, color: COLORS.textGray, fontWeight: 'bold', textAlign: 'center' }
});