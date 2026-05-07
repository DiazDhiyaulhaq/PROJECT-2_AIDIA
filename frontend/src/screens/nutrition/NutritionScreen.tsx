import React, { useState } from 'react';
import { View, Text, StyleSheet, SafeAreaView, TouchableOpacity, ScrollView } from 'react-native';

export default function NutritionScreen() {
  const [activeTab, setActiveTab] = useState('Breakfast');

  const meals = {
    Breakfast: [{ name: "Oatmeal with Milk", time: "09/03/2026, 9:34 AM" }],
    Lunch: [{ name: "Nasi Padang", time: "09/03/2026, 1:30 PM" }],
    Dinner: [{ name: "Nasi Goreng", time: "09/03/2026, 7:00 PM" }],
  };

  const currentMeals = meals[activeTab as keyof typeof meals] || [];

  return (
    <SafeAreaView style={styles.container}>
      <View style={styles.headerBorder}>
        <Text style={styles.headerTitle}>Nutrition</Text>
        
        {/* TABS */}
        <View style={styles.tabContainer}>
          {['Breakfast', 'Lunch', 'Dinner'].map((tab) => (
            <TouchableOpacity 
              key={tab} 
              style={[styles.tabButton, activeTab === tab && styles.tabActive]}
              onPress={() => setActiveTab(tab)}
            >
              <Text style={[styles.tabText, activeTab === tab && styles.tabTextActive]}>{tab}</Text>
            </TouchableOpacity>
          ))}
        </View>
      </View>

      {/* MEAL LIST */}
      <ScrollView style={styles.listContainer}>
        {currentMeals.map((meal, index) => (
          <View key={index} style={styles.mealItem}>
            <Text style={styles.mealName}>{meal.name}</Text>
            <Text style={styles.mealTime}>{meal.time}</Text>
          </View>
        ))}
      </ScrollView>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#fff' },
  headerBorder: { borderBottomWidth: 1, borderBottomColor: '#E5E7EB', paddingTop: 24 },
  headerTitle: { fontSize: 20, fontWeight: 'bold', paddingHorizontal: 24, marginBottom: 24, color: '#111827' },
  tabContainer: { flexDirection: 'row', paddingHorizontal: 24, gap: 32 },
  tabButton: { paddingBottom: 12, borderBottomWidth: 2, borderBottomColor: 'transparent' },
  tabActive: { borderBottomColor: '#000' },
  tabText: { fontSize: 14, color: '#9CA3AF' },
  tabTextActive: { color: '#000', fontWeight: 'bold' },
  listContainer: { padding: 24 },
  mealItem: { borderBottomWidth: 1, borderBottomColor: '#E5E7EB', paddingBottom: 16, marginBottom: 16 },
  mealName: { fontSize: 16, color: '#111827', marginBottom: 4 },
  mealTime: { fontSize: 12, color: '#6B7280' }
});