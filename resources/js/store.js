import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
Vue.use(Vuex);
export default new Vuex.Store({
    state: {
        token: localStorage.getItem("token") || "",
    },
    mutations: {
        SET_TOKEN(state, token) {
            state.token = token;
        },
    },
    actions: {
        async logInUser({ commit }, credentials) {
            await axios
                .post("api/login", credentials)
                .then((resp) => {
                    const token = resp.data;
                    localStorage.setItem("token", token);
                    axios.defaults.headers.common[
                        "Authorization"
                    ] = `Bearer ${token}`;
                    commit("SET_TOKEN", token);
                })
                .catch((err) => {
                    localStorage.removeItem("token");
                });
        },
        async logOutUser({ commit }) {
            await axios
                .post("api/logout")
                .then((response) => {
                    localStorage.removeItem("token");
                    axios.defaults.headers.common["Authorization"] = null;
                    commit("SET_TOKEN", null);
                })
                .catch((err) => {});
        },
    },
    getters: {
        authenticated(state) {
            return !!state.token;
        },
    },
});
