import { defineStore } from 'pinia';

export const useAuthStore = defineStore("auth", {
  state: () => ({
    token: localStorage.getItem('access_token'),
  }),
  getters: {
    isAuthenticated: (state) => !!state.token,
  },

  actions: {
    login(accessToken) {
      this.token = accessToken;
      $cookies.set('access_token', accessToken, '/');
      localStorage.setItem('access_token', accessToken);
    },

    logout() {
      this.token = null;
      $cookies.remove('access_token', '/');
      localStorage.removeItem('access_token');
    }
  }

});