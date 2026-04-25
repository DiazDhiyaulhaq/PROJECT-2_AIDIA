import React, { useState } from 'react';
import { View, Text, StyleSheet, SafeAreaView, ScrollView, TouchableOpacity } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { COLORS } from '../../utils/colors';
import AddMealModal from './AddMealModal';

type MealItem = { id: string; name: string; time: string; cal: number };
type MealType = 'Breakfast' | 'Lunch' | 'Dinner';

export default function NutritionScreen() {
  const [activeTab, setActiveTab] = useState<MealType>('Breakfast');
  const [isAddMealVisible, setIsAddMealVisible] = useState(false);

  // Data disesuaikan persis dengan gambar desain kamu
  const [meals] = useState<Record<MealType, MealItem[]>>({
    Breakfast: [
      { id: '1', name: 'Oatmeal with berries', time: '8:30 AM', cal: 320 },
      { id: '2', name: 'Greek yogurt', time: '8:45 AM', cal: 150 },
    ],
    Lunch: [
      { id: '3', name: 'Grilled chicken salad', time: '12:30 PM', cal: 450 },
      { id: '4', name: 'Brown rice', time: '12:30 PM', cal: 200 },
    ],
    Dinner: [
      { id: '5', name: 'Salmon with vegetables', time: '7:00 PM', cal: 520 },
      { id: '6', name: 'Quinoa', time: '7:15 PM', cal: 180 },
    ],
  });

  return (
    <SafeAreaView style={styles.container}>
      <ScrollView showsVerticalScrollIndicator={false}>
        <View style={styles.header}>
          <Text style={styles.title}>Nutrition Tracker</Text>
          <Text style={styles.subtitle}>Track your daily meals</Text>
        </View>

        <View style={styles.content}>
          <View style={styles.mainCard}>
            <View style={styles.tabBar}>
              {(['Breakfast', 'Lunch', 'Dinner'] as MealType[]).map((tab) => (
                <TouchableOpacity 
                  key={tab}
                  style={[styles.tabItem, activeTab === tab && styles.tabItemActive]}
                  onPress={() => setActiveTab(tab)}
                >
                  <Text style={[styles.tabText, activeTab === tab && styles.tabTextActive]}>{tab}</Text>
                </TouchableOpacity>
              ))}
            </View>

            <View style={styles.mealListSection}>
              {meals[activeTab].map((item) => (
                <View key={item.id} style={styles.mealItem}>
                  <View>
                    <Text style={styles.mealName}>{item.name}</Text>
                    <Text style={styles.mealTime}>{item.time}</Text>
                  </View>
                  <Text style={styles.mealCal}>{item.cal} cal</Text>
                </View>
              ))}

              <TouchableOpacity style={styles.addBtn} onPress={() => setIsAddMealVisible(true)}>
                <Ionicons name="add" size={20} color="#fff" />
                <Text style={styles.addBtnText}>Add {activeTab} Item</Text>
              </TouchableOpacity>
            </View>
          </View>

          <View style={styles.summaryCard}>
            <Text style={styles.sectionTitle}>Today's Summary</Text>
            <View style={styles.summaryRow}>
              <SummaryItem value="1820" unit="Calories" />
              <SummaryItem value="85g" unit="Protein" />
              <SummaryItem value="140g" unit="Carbs" />
            </View>
          </View>
        </View>
      </ScrollView>

      <AddMealModal 
        isVisible={isAddMealVisible} 
        onClose={() => setIsAddMealVisible(false)} 
        mealType={activeTab}
      />
    </SafeAreaView>
  );
}

const SummaryItem = ({ value, unit }: { value: string; unit: string }) => (
  <View style={styles.summaryItem}>
    <Text style={styles.summaryValue}>{value}</Text>
    <Text style={styles.summaryUnit}>{unit}</Text>
  </View>
);

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#F8F9FA' },
  header: { backgroundColor: COLORS.primary, padding: 30, paddingTop: 50, borderBottomLeftRadius: 30, borderBottomRightRadius: 30, height: 160 },
  title: { fontSize: 24, fontWeight: 'bold', color: '#fff' },
  subtitle: { fontSize: 14, color: '#fff', opacity: 0.9, marginTop: 5 },
  content: { paddingHorizontal: 20, marginTop: -30 },
  mainCard: { backgroundColor: '#fff', borderRadius: 20, overflow: 'hidden', elevation: 4, shadowColor: '#000', shadowOpacity: 0.1, shadowRadius: 10, marginBottom: 20 },
  tabBar: { flexDirection: 'row', borderBottomWidth: 1, borderBottomColor: '#F3F4F6' },
  tabItem: { flex: 1, paddingVertical: 15, alignItems: 'center' },
  tabItemActive: { borderBottomWidth: 2, borderBottomColor: COLORS.primary },
  tabText: { fontSize: 14, color: COLORS.textGray, fontWeight: '600' },
  tabTextActive: { color: COLORS.primary },
  mealListSection: { padding: 20 },
  mealItem: { flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', backgroundColor: '#F9FAFB', padding: 15, borderRadius: 15, marginBottom: 12 },
  mealName: { fontSize: 15, fontWeight: '600', color: COLORS.textDark },
  mealTime: { fontSize: 12, color: COLORS.textGray, marginTop: 2 },
  mealCal: { fontSize: 14, fontWeight: '700', color: COLORS.primary },
  addBtn: { backgroundColor: COLORS.primary, flexDirection: 'row', justifyContent: 'center', alignItems: 'center', paddingVertical: 12, borderRadius: 12, marginTop: 8, gap: 5 },
  addBtnText: { color: '#fff', fontWeight: 'bold', fontSize: 15 },
  summaryCard: { backgroundColor: '#fff', borderRadius: 20, padding: 20, elevation: 4, shadowColor: '#000', shadowOpacity: 0.1, shadowRadius: 10, marginBottom: 40 },
  sectionTitle: { fontSize: 16, fontWeight: '700', color: COLORS.textDark, marginBottom: 15 },
  summaryRow: { flexDirection: 'row', justifyContent: 'space-between' },
  summaryItem: { flex: 1, paddingVertical: 15, borderRadius: 15, alignItems: 'center', marginHorizontal: 4, backgroundColor: '#EAF6F4' },
  summaryValue: { fontSize: 18, fontWeight: 'bold', color: COLORS.primary },
  summaryUnit: { fontSize: 11, color: COLORS.textGray, marginTop: 2 },
});