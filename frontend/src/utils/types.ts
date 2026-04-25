export type Patient = {
  id: number;
  nama: string;
  usia: number;
  gulaDarah: number;
  status: 'belum_kontak' | 'sudah_kontak' | 'proses_rujukan';
  risiko: 'tinggi' | 'sedang';
};