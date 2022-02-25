require("./bootstrap");

window.Vue = require("vue").default;

import Vue from "vue";
import VueRouter from "vue-router";
import router from "./routes";
import NavBar from "./components/NavBar";
import store from "./store";

Vue.use(VueRouter);

Vue.component("nav-component", NavBar);

const app = new Vue({
    el: "#app",
    router,
    store,
});
