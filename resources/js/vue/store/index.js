// store/index.js
import { createStore } from 'vuex';
import axios from 'axios';
const api_url = import.meta.env.VITE_API_URL;


export default createStore({
  state: {
    users: [],
  },
  mutations: {
    SET_USERS(state, users) {
      state.users = users;
    },
  },
  actions: {
    async fetchUsers({ commit }) {
      try {
        const response = await axios.get(api_url + 'user');
        commit('SET_USERS', response.data.data);
      } catch (error) {
        console.error('Error fetching users:', error);
      }
    },
  },
  modules: {},
});
