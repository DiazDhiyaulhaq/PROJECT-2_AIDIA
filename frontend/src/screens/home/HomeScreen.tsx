import React, { useState, useEffect } from 'react';

import {
  View,
  Text,
  StyleSheet,
  SafeAreaView,
  ScrollView,
  TouchableOpacity,
  ActivityIndicator,
  RefreshControl,
  Alert
} from 'react-native';

import { Feather } from '@expo/vector-icons';

import { COLORS } from '../../utils/colors';

import { useAuthStore } from '../../store/useAuthStore';

import { useNavigation } from '@react-navigation/native';

import LogGlucoseModal from './LogGlucoseModal';

import { Card, FloatingChat } from '../../components';

import api from '../../services/api';

export default function HomeScreen() {

  const navigation = useNavigation<any>();

  const user = useAuthStore(
    (state: any) => state.user
  );

  const [loadingData, setLoadingData] =
    useState(true);

  const [refreshing, setRefreshing] =
    useState(false);

  const [profile, setProfile] =
    useState<any>(null);

  const [healthData, setHealthData] =
    useState<any>({
      insulin: null,
      glucose: null,
      fitness: null
    });

  const [isGlucoseModalVisible,
    setGlucoseModalVisible] =
    useState(false);

  useEffect(() => {

    fetchHomeData();

  }, []);

  const fetchHomeData = async () => {

    try {

      setLoadingData(true);

      // 🔥 FETCH USER LOGIN
      const profileResponse =
        await api.get('/me');

      setProfile(profileResponse.data);

      // 🔥 DUMMY DATA
      // nanti diganti fetch monitoring asli
      setHealthData({
        insulin: '12.5',
        glucose: '125',
        fitness: '78'
      });

    } catch (error: any) {

      console.log(
        'HOME ERROR:',
        error.response?.data
      );

      Alert.alert(
        'Error',
        'Gagal mengambil data dashboard'
      );

    } finally {

      setLoadingData(false);

      setRefreshing(false);
    }
  };

  const onRefresh = async () => {

    setRefreshing(true);

    await fetchHomeData();
  };

  return (

    <SafeAreaView style={styles.container}>

      <ScrollView
        showsVerticalScrollIndicator={false}

        refreshControl={
          <RefreshControl
            refreshing={refreshing}
            onRefresh={onRefresh}
          />
        }
      >

        {/* HEADER */}
        <View style={styles.header}>

          <Text style={styles.welcomeText}>
            Welcome back,
          </Text>

          <Text style={styles.userName}>
            {profile?.name ||
              user?.name ||
              'User'}
          </Text>

        </View>

        <View style={styles.content}>

          {/* OVERVIEW */}
          <Card style={styles.overviewCard}>

            <Text style={styles.sectionTitle}>
              Health Overview
            </Text>

            {loadingData ? (

              <ActivityIndicator
                size="large"
                color={COLORS.primary}
                style={{ marginVertical: 30 }}
              />

            ) : (

              <>

                {/* INSULIN */}
                <View
                  style={[
                    styles.dataRow,
                    {
                      backgroundColor:
                        '#FDF2F8'
                    }
                  ]}
                >

                  <View style={styles.dataLeft}>

                    <View
                      style={[
                        styles.iconCircle,
                        {
                          backgroundColor:
                            '#DB2777'
                        }
                      ]}
                    >

                      <Feather
                        name="droplet"
                        size={20}
                        color="#fff"
                      />

                    </View>

                    <View>

                      <Text style={styles.dataLabel}>
                        Insulin Level
                      </Text>

                      <Text style={styles.dataValue}>
                        {healthData.insulin ?? '-'} mU/L
                      </Text>

                    </View>

                  </View>

                </View>

                {/* GLUCOSE */}
                <TouchableOpacity
                  style={[
                    styles.dataRow,
                    {
                      backgroundColor:
                        '#FFF5E9'
                    }
                  ]}
                  onPress={() =>
                    navigation.navigate(
                      'GlucoseDetail'
                    )
                  }
                >

                  <View style={styles.dataLeft}>

                    <View
                      style={[
                        styles.iconCircle,
                        {
                          backgroundColor:
                            '#F5A623'
                        }
                      ]}
                    >

                      <Feather
                        name="activity"
                        size={20}
                        color="#fff"
                      />

                    </View>

                    <View>

                      <Text style={styles.dataLabel}>
                        Blood Glucose
                      </Text>

                      <Text style={styles.dataValue}>
                        {healthData.glucose ?? '-'} mg/dL
                      </Text>

                    </View>

                  </View>

                </TouchableOpacity>

                {/* FITNESS */}
                <View
                  style={[
                    styles.dataRow,
                    {
                      backgroundColor:
                        '#FFE4E6'
                    }
                  ]}
                >

                  <View style={styles.dataLeft}>

                    <View
                      style={[
                        styles.iconCircle,
                        {
                          backgroundColor:
                            '#E11D48'
                        }
                      ]}
                    >

                      <Feather
                        name="heart"
                        size={20}
                        color="#fff"
                      />

                    </View>

                    <View>

                      <Text style={styles.dataLabel}>
                        Fitness Score
                      </Text>

                      <Text style={styles.dataValue}>
                        {healthData.fitness ?? '-'}/100
                      </Text>

                    </View>

                  </View>

                </View>

              </>

            )}

          </Card>

          {/* QUICK ACTION */}
          <Text style={styles.sectionTitle}>
            Quick Actions
          </Text>

          <View style={styles.actionRow}>

            <TouchableOpacity
              style={styles.actionCard}
              onPress={() =>
                setGlucoseModalVisible(true)
              }
            >

              <View
                style={
                  styles.actionIconContainer
                }
              >

                <Feather
                  name="plus"
                  size={24}
                  color="#fff"
                />

              </View>

              <Text style={styles.actionText}>
                Log Glucose
              </Text>

            </TouchableOpacity>

            <TouchableOpacity
              style={styles.actionCard}
            >

              <View
                style={
                  styles.actionIconContainer
                }
              >

                <Feather
                  name="coffee"
                  size={24}
                  color="#fff"
                />

              </View>

              <Text style={styles.actionText}>
                Add Meal
              </Text>

            </TouchableOpacity>

          </View>

        </View>

      </ScrollView>

      {/* FLOATING CHAT */}
      <FloatingChat />

      {/* MODAL */}
      <LogGlucoseModal

        isVisible={
          isGlucoseModalVisible
        }

        onClose={() =>
          setGlucoseModalVisible(false)
        }

        onSave={(val) =>

          setHealthData(
            (prev: any) => ({
              ...prev,
              glucose: val
            })
          )
        }
      />

    </SafeAreaView>
  );
}

const styles = StyleSheet.create({

  container: {
    flex: 1,
    backgroundColor: '#F8F9FA'
  },

  header: {
    backgroundColor: COLORS.primary,
    paddingHorizontal: 24,
    paddingTop: 60,
    paddingBottom: 80,
    borderBottomLeftRadius: 30,
    borderBottomRightRadius: 30
  },

  welcomeText: {
    fontSize: 16,
    color: '#fff',
    opacity: 0.9
  },

  userName: {
    fontSize: 28,
    fontWeight: 'bold',
    color: '#fff',
    marginTop: 4
  },

  content: {
    paddingHorizontal: 20,
    marginTop: -40
  },

  overviewCard: {
    marginBottom: 25
  },

  sectionTitle: {
    fontSize: 18,
    fontWeight: 'bold',
    color: COLORS.textDark,
    marginBottom: 15
  },

  dataRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    padding: 15,
    borderRadius: 15,
    marginBottom: 10
  },

  dataLeft: {
    flexDirection: 'row',
    alignItems: 'center'
  },

  iconCircle: {
    width: 40,
    height: 40,
    borderRadius: 20,
    justifyContent: 'center',
    alignItems: 'center',
    marginRight: 15
  },

  dataLabel: {
    fontSize: 12,
    color: COLORS.textGray,
    marginBottom: 4
  },

  dataValue: {
    fontSize: 18,
    fontWeight: 'bold',
    color: COLORS.textDark
  },

  actionRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginBottom: 100
  },

  actionCard: {
    flex: 1,
    backgroundColor: COLORS.primary,
    borderRadius: 20,
    padding: 20,
    alignItems: 'center',
    marginHorizontal: 5,
    elevation: 3
  },

  actionIconContainer: {
    width: 40,
    height: 40,
    borderRadius: 20,
    borderWidth: 1,
    borderColor:
      'rgba(255,255,255,0.5)',
    justifyContent: 'center',
    alignItems: 'center',
    marginBottom: 10
  },

  actionText: {
    color: '#fff',
    fontWeight: 'bold',
    fontSize: 15
  },

});