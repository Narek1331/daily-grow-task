// store/index.js
import { createStore } from 'vuex';
import axios from 'axios';

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
        const response = await axios.get('http://localhost/api/user');
        commit('SET_USERS', response.data.data);
      } catch (error) {
        console.error('Error fetching users:', error);
      }
    },
  },
  modules: {},
});
