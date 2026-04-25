import React, { useState } from 'react';
import { 
  Modal, 
  View, 
  Text, 
  StyleSheet, 
  TextInput, 
  TouchableOpacity, 
  TouchableWithoutFeedback, 
  Keyboard 
} from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { COLORS } from '../../utils/colors';

interface LogGlucoseModalProps {
  isVisible: boolean;
  onClose: () => void;
}

export default function LogGlucoseModal({ isVisible, onClose }: LogGlucoseModalProps) {
  const [glucoseValue, setGlucoseValue] = useState('');

  const handleSave = () => {
    console.log('Menyimpan Gula Darah:', glucoseValue);
    // Nanti panggil service API di sini
    onClose();
  };

  return (
    <Modal
      animationType="fade"
      transparent={true}
      visible={isVisible}
      onRequestClose={onClose}
    >
      <TouchableWithoutFeedback onPress={Keyboard.dismiss}>
        <View style={styles.overlay}>
          <View style={styles.modalContainer}>
            {/* HEADER MODAL */}
            <View style={styles.header}>
              <Text style={styles.title}>Log Blood Glucose</Text>
              <TouchableOpacity onPress={onClose}>
                <Ionicons name="close" size={24} color={COLORS.textGray} />
              </TouchableOpacity>
            </View>

            <Text style={styles.subtitle}>Masukkan kadar gula darah kamu saat ini (mg/dL)</Text>

            {/* INPUT SECTION */}
            <View style={styles.inputWrapper}>
              <TextInput
                style={styles.input}
                placeholder="0"
                keyboardType="numeric"
                value={glucoseValue}
                onChangeText={setGlucoseValue}
                autoFocus={true}
              />
              <Text style={styles.unit}>mg/dL</Text>
            </View>

            {/* INFO ALERT (Opsional) */}
            <View style={styles.infoBox}>
              <Ionicons name="information-circle" size={18} color={COLORS.primary} />
              <Text style={styles.infoText}>
                Data ini akan langsung terupdate di dashboard kesehatan kamu.
              </Text>
            </View>

            {/* BUTTONS */}
            <View style={styles.footer}>
              <TouchableOpacity style={styles.cancelBtn} onPress={onClose}>
                <Text style={styles.cancelBtnText}>Batal</Text>
              </TouchableOpacity>
              <TouchableOpacity style={styles.saveBtn} onPress={handleSave}>
                <Text style={styles.saveBtnText}>Simpan Data</Text>
              </TouchableOpacity>
            </View>
          </View>
        </View>
      </TouchableWithoutFeedback>
    </Modal>
  );
}

const styles = StyleSheet.create({
  overlay: {
    flex: 1,
    backgroundColor: 'rgba(0,0,0,0.5)',
    justifyContent: 'center',
    padding: 20,
  },
  modalContainer: {
    backgroundColor: '#fff',
    borderRadius: 20,
    padding: 24,
    elevation: 5,
  },
  header: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginBottom: 8,
  },
  title: { fontSize: 20, fontWeight: 'bold', color: COLORS.textDark },
  subtitle: { fontSize: 14, color: COLORS.textGray, marginBottom: 24 },
  inputWrapper: {
    flexDirection: 'row',
    alignItems: 'baseline',
    justifyContent: 'center',
    backgroundColor: '#F3F4F6',
    borderRadius: 15,
    paddingVertical: 20,
    marginBottom: 20,
  },
  input: {
    fontSize: 48,
    fontWeight: 'bold',
    color: COLORS.primary,
    textAlign: 'center',
  },
  unit: {
    fontSize: 18,
    fontWeight: '600',
    color: COLORS.textGray,
    marginLeft: 8,
  },
  infoBox: {
    flexDirection: 'row',
    backgroundColor: '#F0F9F8',
    padding: 12,
    borderRadius: 10,
    alignItems: 'center',
    marginBottom: 24,
  },
  infoText: {
    flex: 1,
    fontSize: 12,
    color: '#3A7D74',
    marginLeft: 8,
  },
  footer: {
    flexDirection: 'row',
    gap: 12,
  },
  cancelBtn: {
    flex: 1,
    paddingVertical: 14,
    borderRadius: 12,
    alignItems: 'center',
    borderWidth: 1,
    borderColor: '#E5E7EB',
  },
  cancelBtnText: { color: COLORS.textGray, fontWeight: '600' },
  saveBtn: {
    flex: 2,
    backgroundColor: COLORS.primary,
    paddingVertical: 14,
    borderRadius: 12,
    alignItems: 'center',
  },
  saveBtnText: { color: '#fff', fontWeight: 'bold' },
});