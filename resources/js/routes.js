import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./components/Home";
import Login from "./components/auth/Login";
import Register from "./components/auth/Register";
import Dashboard from "./components/Dashboard";
import store from "./store";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        component: Home,
        name: "Home",
    },
    {
        path: "/login",
        component: Login,
        name: "Login",
        meta: {
            requirsGuest: true,
        },
    },
    {
        path: "/register",
        component: Register,
        name: "Register",
        meta: {
            requirsGuest: true,
        },
    },
    {
        path: "/dashboard",
        component: Dashboard,
        name: "Dashboard",
        meta: {
            requirsAuth: true,
        },
    },
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requirsAuth)) {
        if (!store.getters.authenticated) {
            next({
                path: "/login",
            });
        } else {
            next();
        }
    } else if (to.matched.some((record) => record.meta.requirsGuest)) {
        if (store.getters.authenticated) {
            next({
                path: "/",
            });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
