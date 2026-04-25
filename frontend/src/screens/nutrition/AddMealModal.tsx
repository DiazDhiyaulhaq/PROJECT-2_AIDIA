import React, { useState } from 'react';
import { Modal, View, Text, StyleSheet, TextInput, TouchableOpacity, TouchableWithoutFeedback, Keyboard } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { COLORS } from '../../utils/colors';

interface AddMealModalProps {
  isVisible: boolean;
  onClose: () => void;
  mealType: string;
}

export default function AddMealModal({ isVisible, onClose, mealType }: AddMealModalProps) {
  const [food, setFood] = useState('');
  const [cal, setCal] = useState('');
  const [time, setTime] = useState('');

  return (
    <Modal animationType="fade" transparent={true} visible={isVisible} onRequestClose={onClose}>
      <TouchableWithoutFeedback onPress={Keyboard.dismiss}>
        <View style={styles.overlay}>
          <View style={styles.modalContent}>
            <View style={styles.header}>
              <Text style={styles.title}>Add {mealType}</Text>
              <TouchableOpacity onPress={onClose}>
                <Ionicons name="close" size={24} color={COLORS.textGray} />
              </TouchableOpacity>
            </View>

            <View style={styles.inputGroup}>
              <Text style={styles.label}>Meal Name</Text>
              <TextInput 
                style={styles.input} 
                placeholder="e.g., Grilled chicken salad" 
                value={food} 
                onChangeText={setFood}
              />
            </View>

            <View style={styles.inputGroup}>
              <Text style={styles.label}>Calories</Text>
              <TextInput 
                style={styles.input} 
                placeholder="e.g., 450" 
                keyboardType="numeric"
                value={cal} 
                onChangeText={setCal}
              />
            </View>

            <View style={styles.inputGroup}>
              <Text style={styles.label}>Time</Text>
              <View style={styles.timeInputWrapper}>
                <TextInput 
                  style={[styles.input, { flex: 1 }]} 
                  placeholder="--:--" 
                  value={time} 
                  onChangeText={setTime}
                />
                <Ionicons name="time-outline" size={20} color="#E5E7EB" style={styles.timeIcon} />
              </View>
            </View>

            <View style={styles.footer}>
              <TouchableOpacity style={styles.cancelBtn} onPress={onClose}>
                <Text style={styles.cancelBtnText}>Cancel</Text>
              </TouchableOpacity>
              <TouchableOpacity style={styles.saveBtn} onPress={onClose}>
                <Text style={styles.saveBtnText}>Add Meal</Text>
              </TouchableOpacity>
            </View>
          </View>
        </View>
      </TouchableWithoutFeedback>
    </Modal>
  );
}

const styles = StyleSheet.create({
  overlay: { flex: 1, backgroundColor: 'rgba(0,0,0,0.5)', justifyContent: 'center', padding: 24 },
  modalContent: { backgroundColor: '#fff', borderRadius: 20, padding: 24 },
  header: { flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', marginBottom: 20 },
  title: { fontSize: 20, fontWeight: 'bold', color: COLORS.textDark },
  inputGroup: { marginBottom: 16 },
  label: { fontSize: 14, fontWeight: '600', color: COLORS.textDark, marginBottom: 8 },
  input: { backgroundColor: '#F9FAFB', borderWidth: 1, borderColor: '#E5E7EB', borderRadius: 12, padding: 12, fontSize: 15 },
  timeInputWrapper: { flexDirection: 'row', alignItems: 'center' },
  timeIcon: { position: 'absolute', right: 12 },
  footer: { flexDirection: 'row', gap: 12, marginTop: 10 },
  cancelBtn: { flex: 1, backgroundColor: '#F3F4F6', paddingVertical: 14, borderRadius: 12, alignItems: 'center' },
  cancelBtnText: { color: COLORS.textDark, fontWeight: '600' },
  saveBtn: { flex: 1, backgroundColor: COLORS.primary, paddingVertical: 14, borderRadius: 12, alignItems: 'center' },
  saveBtnText: { color: '#fff', fontWeight: 'bold' },
});