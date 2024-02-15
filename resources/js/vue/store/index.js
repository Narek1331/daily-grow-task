// store/index.js
import { createStore } from 'vuex';
import axios from 'axios';
const api_url = import.meta.env.VITE_API_URL;


export default createStore({
  state: {
    users: [],
    accessToken: null,
    error: null,
    signupError: '',
    signupForm: {
      email: '',
      password: '',
      full_name: '',
      phone_number: '',
      dob: ''
    },

  },
  mutations: {
    SET_USERS(state, users) {
      state.users = users;
    },
    setAccessToken(state, token) {
      state.accessToken = token
      location.href = '/panel'
    },
    setError(state, error) {
      state.error = error
    },
    updateSignupForm(state, payload) {
      state.signupForm = { ...state.signupForm, ...payload };
    },
    setSignupError(state, error) {
      state.signupError = error;
    }
  },
  getters: {
    isAuthenticated: state => !!state.accessToken
  },
  actions: {
    async signup({ commit, state }, credentials) {
      try {
        const response = await axios.post(api_url + 'auth/signup', credentials);
        if (response.data) {
          location.href = '/auth/login'
        }
      } catch (error) {
        if (error.response.data.errors) {
          commit('setSignupError', error.response.data.errors.email[0]);
        } else {
          commit('setSignupError', 'An unknown error occurred.');
        }
      }
    },
    async login({ commit }, credentials) {
      try {
        const response = await axios.post(api_url + 'auth/login', credentials)
        const { access_token } = response.data
        localStorage.setItem('accessToken', access_token)
        commit('setAccessToken', access_token)
      } catch (error) {
        commit('setError', error.response.data.errors)
      }
    },
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
