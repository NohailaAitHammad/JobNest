import {createStore} from "vuex"
import axiosClient from "../axios.js";
const store = createStore({
  state : {
    user : {
      data : {},
      token: localStorage.getItem('TOKEN')
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

    setUser : (state, userData) => {
      state.user.token = userData.token;
      state.user.data = userData.data;
      localStorage.setItem('TOKEN', userData.token);
    },
    logout : (state) => {
      state.user.data = {};
      state.user.token = null
      localStorage.removeItem('TOKEN');
    },
  },
  modules : {}
})

export default store;
