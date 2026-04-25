import React from 'react';
import { Text, View } from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';

// 🔥 Type untuk Tab
type TabParamList = {
  Home: undefined;
  Biodata: undefined;
};

// 🔥 Home Screen
const HomeScreen: React.FC = () => {
  return (
    <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center' }}>
      <Text>Home!</Text>
    </View>
  );
};

// 🔥 Biodata Screen
const Biodata: React.FC = () => {
  return (
    <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center' }}>
      <Text>Settings!</Text>
    </View>
  );
};

const Tab = createBottomTabNavigator<TabParamList>();

// 🔥 App utama
export default function App() {
  return (
    <NavigationContainer>np
      <Tab.Navigator>
        <Tab.Screen name="Home" component={HomeScreen} />
        <Tab.Screen name="Biodata" component={Biodata} />
      </Tab.Navigator>
    </NavigationContainer>
  );
}