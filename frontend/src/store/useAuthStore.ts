import { create } from 'zustand';

// 1. Kita buat "KTP" (Interface) untuk data auth-nya
export interface AuthState {
  token: string | null;
  user: { name: string; email: string } | null; // Tipe data user lebih jelas
  login: (token: string, userData: { name: string; email: string }) => void;
  logout: () => void;
  updateName: (newName: string) => void;
}

// 2. Masukkan tipe <AuthState> ke dalam Zustand
// Penulisan () => () ini adalah standar Zustand versi terbaru agar TS tidak error
export const useAuthStore = create<AuthState>()((set) => ({
  token: null,
  user: null,

  // Fungsi Login
  login: (token, userData) => set({ token, user: userData }),

  // Fungsi Logout
  logout: () => set({ token: null, user: null }),

  // Fungsi Update Nama
  updateName: (newName) => set((state) => ({
    user: state.user ? { ...state.user, name: newName } : null
  })),
}));