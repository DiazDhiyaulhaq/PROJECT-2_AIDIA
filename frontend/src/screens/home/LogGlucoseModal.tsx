import React, { useState } from 'react';
import { 
  Modal, 
  View, 
  Text, 
  StyleSheet, 
  TextInput, 
  TouchableOpacity, 
  TouchableWithoutFeedback, 
  Keyboard,
  ActivityIndicator,
  Alert
} from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { COLORS } from '../../utils/colors';

// Nanti pastikan kamu meng-import konfigurasi axios kamu di sini
// import api from '../../services/api';

interface LogGlucoseModalProps {
  isVisible: boolean;
  onClose: () => void;
  onSave: (val: string) => void; 
}

export default function LogGlucoseModal({ isVisible, onClose, onSave }: LogGlucoseModalProps) {
  // State dibiarkan kosong, menunggu inputan user
  const [glucoseValue, setGlucoseValue] = useState('');
  const [isSaving, setIsSaving] = useState(false);

  // Fungsi diubah menjadi ASYNC karena akan ngobrol dengan Database
  const handleSave = async () => {
    // 1. Validasi Input
    if (!glucoseValue) {
      Alert.alert("Peringatan", "Kadar gula darah tidak boleh kosong!");
      return; 
    }
    
    setIsSaving(true);

    try {
      // 2. TEMPAT INTEGRASI API LARAVEL
      // Uncomment kode di bawah ini kalau endpoint Laravel sudah siap:
      
      // const response = await api.post('/glucose-logs', { 
      //   level: glucoseValue 
      // });
      
      // 3. Jika API berhasil (Status 200/201), update UI
      onSave(glucoseValue); // Lempar angka ke HomeScreen agar dashboard terupdate
      setGlucoseValue('');  // Kosongkan form input
      onClose();            // Tutup modal
      
    } catch (error) {
      // 4. Tangani error dari backend (misal: server mati atau validasi gagal)
      console.log("Error save glucose:", error);
      Alert.alert("Gagal Menyimpan", "Terjadi kesalahan saat mengirim data ke server.");
    } finally {
      setIsSaving(false); // Matikan loading baik saat sukses maupun gagal
    }
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
              <TouchableOpacity onPress={onClose} disabled={isSaving}>
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
                editable={!isSaving} // Kunci input saat sedang mengirim data
              />
              <Text style={styles.unit}>mg/dL</Text>
            </View>

            {/* INFO ALERT */}
            <View style={styles.infoBox}>
              <Ionicons name="information-circle" size={18} color={COLORS.primary} />
              <Text style={styles.infoText}>
                Data ini akan langsung disimpan ke database kesehatan kamu.
              </Text>
            </View>

            {/* BUTTONS */}
            <View style={styles.footer}>
              <TouchableOpacity style={styles.cancelBtn} onPress={onClose} disabled={isSaving}>
                <Text style={styles.cancelBtnText}>Batal</Text>
              </TouchableOpacity>
              
              <TouchableOpacity style={styles.saveBtn} onPress={handleSave} disabled={isSaving}>
                {isSaving ? (
                  <ActivityIndicator color="#fff" />
                ) : (
                  <Text style={styles.saveBtnText}>Simpan Data</Text>
                )}
              </TouchableOpacity>
            </View>

          </View>
        </View>
      </TouchableWithoutFeedback>
    </Modal>
  );
}

const styles = StyleSheet.create({
  overlay: { flex: 1, backgroundColor: 'rgba(0,0,0,0.5)', justifyContent: 'center', padding: 20 },
  modalContainer: { backgroundColor: '#fff', borderRadius: 20, padding: 24, elevation: 5 },
  header: { flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', marginBottom: 8 },
  title: { fontSize: 20, fontWeight: 'bold', color: COLORS.textDark },
  subtitle: { fontSize: 14, color: COLORS.textGray, marginBottom: 24 },
  inputWrapper: { flexDirection: 'row', alignItems: 'baseline', justifyContent: 'center', backgroundColor: '#F3F4F6', borderRadius: 15, paddingVertical: 20, marginBottom: 20 },
  input: { fontSize: 48, fontWeight: 'bold', color: COLORS.primary, textAlign: 'center' },
  unit: { fontSize: 18, fontWeight: '600', color: COLORS.textGray, marginLeft: 8 },
  infoBox: { flexDirection: 'row', backgroundColor: '#FDF2F8', padding: 12, borderRadius: 10, alignItems: 'center', marginBottom: 24 },
  infoText: { flex: 1, fontSize: 12, color: COLORS.primary, marginLeft: 8 },
  footer: { flexDirection: 'row', gap: 12 },
  cancelBtn: { flex: 1, paddingVertical: 14, borderRadius: 12, alignItems: 'center', borderWidth: 1, borderColor: '#E5E7EB' },
  cancelBtnText: { color: COLORS.textGray, fontWeight: '600' },
  saveBtn: { flex: 2, backgroundColor: COLORS.primary, paddingVertical: 14, borderRadius: 12, alignItems: 'center', justifyContent: 'center' },
  saveBtnText: { color: '#fff', fontWeight: 'bold' },
});