import {createStore} from "vuex"
import axiosClient from "../axios.js";
const store = createStore({
  state : {
    auth : {
      user : null,
      token: localStorage.getItem('TOKEN'),
      role : null,
      isAuthenticated : !!localStorage.getItem('TOKEN')
    }
  },
  getters : {},
  actions : {
    signUpCandidat({commit}, user) {
      return axiosClient.post('/register/signUpCondidat', user)
            .then(({data}) => {
              commit('setUser', data);
              return data
            })
    },
    signUpRecruteur({commit}, user) {
      return axiosClient.post('/register/signUpRecruter', user)
        .then(({data}) => {
          console.log(data)
          commit('setUser', data);
          return data
        })
    },
    login ({commit} , user) {
      return axiosClient.post('/login', user)
        .then(({data}) => {
          commit('setUser', data);
          return data
        })
    },
    logout ({commit}) {
      return axiosClient.post('/logout')
        .then(response => {
          commit('logout')
          return response
        })
    }
  },
  mutations : {

    setUser : (state, data) => {
      state.auth.token = data.token;
      state.auth.user = data.data.user;
      state.auth.role = data.data.user.role.role;
      state.auth.isAuthenticated = true;
      console.log(data)
      localStorage.setItem('TOKEN', data.token);
    },
    logout : (state) => {
      state.auth.user = null;
      state.auth.token = null;
      state.auth.role = null;
      state.auth.isAuthenticated = false;
      localStorage.removeItem('TOKEN');
    },
  },
  modules : {}
})

export default store;
