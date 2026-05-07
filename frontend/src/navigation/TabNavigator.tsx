import React from 'react';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { Feather } from '@expo/vector-icons';
import { COLORS } from '../utils/colors';

// Import Screens (Pastikan path ini sesuai dengan file kamu)
import HomeScreen from '../screens/home/HomeScreen';
// import NutritionScreen from '../screens/nutrition/NutritionScreen';
// import ReminderScreen from '../screens/reminders/ReminderScreen';
// import ChatbotScreen from '../screens/chatbot/ChatbotScreen';
import ProfileScreen from '../screens/profile/ProfileScreen';

const Tab = createBottomTabNavigator();

export default function TabNavigator() {
  return (
    <Tab.Navigator
      screenOptions={({ route }) => ({
        headerShown: false,
        tabBarActiveTintColor: COLORS.primary,
        tabBarInactiveTintColor: '#9CA3AF',
        tabBarStyle: { height: 70, paddingBottom: 12, paddingTop: 12, backgroundColor: '#FFFFFF', borderTopWidth: 1, borderTopColor: '#F3F4F6', elevation: 0 },
        tabBarLabelStyle: { fontSize: 11, fontWeight: '600', marginTop: 4 },
        tabBarIcon: ({ color, size }) => {
          let iconName: any = 'home';
          if (route.name === 'Home') iconName = 'home';
          else if (route.name === 'Nutrition') iconName = 'coffee';
          else if (route.name === 'Reminders') iconName = 'bell';
          else if (route.name === 'Chatbot') iconName = 'message-circle';
          else if (route.name === 'Profile') iconName = 'user';

          return <Feather name={iconName} size={24} color={color} />;
        },
      })}
    >
      <Tab.Screen name="Home" component={HomeScreen} />
      {/* Uncomment di bawah ini kalau file layarnya sudah siap */}
      {/* <Tab.Screen name="Nutrition" component={NutritionScreen} /> */}
      {/* <Tab.Screen name="Reminders" component={ReminderScreen} /> */}
      {/* <Tab.Screen name="Chatbot" component={ChatbotScreen} /> */}
      <Tab.Screen name="Profile" component={ProfileScreen} />
    </Tab.Navigator>
  );
}