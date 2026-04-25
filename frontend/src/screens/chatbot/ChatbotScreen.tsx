import React, { useState } from 'react';
import { 
  View, 
  Text, 
  StyleSheet, 
  SafeAreaView, 
  TextInput, 
  TouchableOpacity, 
  FlatList, 
  KeyboardAvoidingView, 
  Platform,
  ScrollView
} from 'react-native';
import { Ionicons, MaterialCommunityIcons } from '@expo/vector-icons';
import { COLORS } from '../../utils/colors';

// Tipe Data Chat
type Message = {
  id: string;
  text: string;
  sender: 'ai' | 'user';
};

export default function ChatbotScreen() {
  const [inputText, setInputText] = useState('');
  const [messages, setMessages] = useState<Message[]>([
    { id: '1', text: 'Halo! Saya asisten kesehatan AIDIA. Ada yang bisa saya bantu hari ini?', sender: 'ai' },
  ]);

  const sendMessage = () => {
    if (inputText.trim() === '') return;

    const newUserMsg: Message = { id: Date.now().toString(), text: inputText, sender: 'user' };
    setMessages([...messages, newUserMsg]);
    setInputText('');

    // Simulasi Jawaban AI
    setTimeout(() => {
      const aiReply: Message = { 
        id: (Date.now() + 1).toString(), 
        text: 'Terima kasih informasinya. Saya sedang menganalisis data kesehatan Anda...', 
        sender: 'ai' 
      };
      setMessages(prev => [...prev, aiReply]);
    }, 1000);
  };

  return (
    <SafeAreaView style={styles.container}>
      {/* HEADER - Teal Background */}
      <View style={styles.header}>
        <View style={styles.headerContent}>
          <View style={styles.botIcon}>
            <MaterialCommunityIcons name="robot" size={24} color={COLORS.primary} />
          </View>
          <View style={styles.headerText}>
            <Text style={styles.headerTitle}>Asisten Kesehatan AI</Text>
            <Text style={styles.headerStatus}>Siap membantu Anda</Text>
          </View>
          <TouchableOpacity style={styles.closeBtn}>
            <Ionicons name="close" size={24} color="#fff" />
          </TouchableOpacity>
        </View>
      </View>

      {/* SUGGESTED CHIPS - Scrollable Horizontal */}
      <View style={styles.chipSection}>
        <ScrollView horizontal showsHorizontalScrollIndicator={false} contentContainerStyle={styles.chipScroll}>
          <TouchableOpacity style={styles.chip}><Text style={styles.chipText}>Ciri-ciri Diabetes</Text></TouchableOpacity>
          <TouchableOpacity style={styles.chip}><Text style={styles.chipText}>Cara Mencegah Diabetes</Text></TouchableOpacity>
          <TouchableOpacity style={styles.chip}><Text style={styles.chipText}>Menu Sehat</Text></TouchableOpacity>
        </ScrollView>
      </View>

      {/* CHAT AREA */}
      <FlatList
        data={messages}
        keyExtractor={(item) => item.id}
        contentContainerStyle={styles.chatList}
        renderItem={({ item }) => (
          <View style={[styles.bubble, item.sender === 'user' ? styles.userBubble : styles.aiBubble]}>
            <Text style={[styles.bubbleText, item.sender === 'user' ? styles.userText : styles.aiText]}>
              {item.text}
            </Text>
          </View>
        )}
      />

      {/* INPUT AREA */}
      <KeyboardAvoidingView behavior={Platform.OS === 'ios' ? 'padding' : undefined}>
        <View style={styles.inputArea}>
          <View style={styles.inputContainer}>
            <TextInput
              style={styles.textInput}
              placeholder="Ketik pesan Anda..."
              value={inputText}
              onChangeText={setInputText}
            />
            <TouchableOpacity style={styles.sendBtn} onPress={sendMessage}>
              <Ionicons name="paper-plane" size={20} color="#fff" />
            </TouchableOpacity>
          </View>
        </View>
      </KeyboardAvoidingView>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#fff' },
  header: { 
    backgroundColor: COLORS.primary, 
    paddingTop: Platform.OS === 'android' ? 40 : 20,
    paddingBottom: 20,
    paddingHorizontal: 20,
    borderBottomLeftRadius: 25,
    borderBottomRightRadius: 25,
  },
  headerContent: { flexDirection: 'row', alignItems: 'center' },
  botIcon: { width: 45, height: 45, borderRadius: 22.5, backgroundColor: 'rgba(255,255,255,0.8)', justifyContent: 'center', alignItems: 'center' },
  headerText: { flex: 1, marginLeft: 15 },
  headerTitle: { fontSize: 18, fontWeight: 'bold', color: '#fff' },
  headerStatus: { fontSize: 12, color: '#fff', opacity: 0.9 },
  closeBtn: { padding: 5 },
  
  chipSection: { paddingVertical: 15, borderBottomWidth: 1, borderBottomColor: '#F3F4F6' },
  chipScroll: { paddingHorizontal: 20, gap: 10 },
  chip: { backgroundColor: '#EAF6F4', paddingHorizontal: 15, paddingVertical: 8, borderRadius: 20, borderWidth: 1, borderColor: '#D1EAE7' },
  chipText: { fontSize: 13, color: '#4EB0A0', fontWeight: '500' },

  chatList: { padding: 20, paddingBottom: 40 },
  bubble: { maxWidth: '80%', padding: 15, borderRadius: 20, marginBottom: 15 },
  aiBubble: { backgroundColor: '#F3F4F6', alignSelf: 'flex-start', borderBottomLeftRadius: 2 },
  userBubble: { backgroundColor: COLORS.primary, alignSelf: 'flex-end', borderBottomRightRadius: 2 },
  bubbleText: { fontSize: 15, lineHeight: 22 },
  aiText: { color: COLORS.textDark },
  userText: { color: '#fff' },

  inputArea: { padding: 20, borderTopWidth: 1, borderTopColor: '#F3F4F6' },
  inputContainer: { flexDirection: 'row', alignItems: 'center', backgroundColor: '#F9FAFB', borderRadius: 30, paddingLeft: 20, paddingRight: 8, height: 56, borderWidth: 1, borderColor: '#E5E7EB' },
  textInput: { flex: 1, fontSize: 15, color: COLORS.textDark },
  sendBtn: { backgroundColor: COLORS.primary, width: 42, height: 42, borderRadius: 21, justifyContent: 'center', alignItems: 'center' }
});