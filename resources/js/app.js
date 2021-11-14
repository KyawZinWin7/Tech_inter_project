require("./bootstrap");

window.Vue = require("vue").default;

import App from "./App.vue";
import VueRouter from "vue-router";

import auth from "@websanova/vue-auth/src/v2.js";
import driverAuthBearer from "@websanova/vue-auth/src/drivers/auth/bearer.js";
import driverHttpAxios from "@websanova/vue-auth/src/drivers/http/axios.1.x.js";
import driverRouterVueRouter from "@websanova/vue-auth/src/drivers/router/vue-router.2.x.js";

import "./plugins";
import { routes } from "./routes";

import axios from "axios";
import VueAxios from "vue-axios";
window.axios = axios;
axios.defaults.baseURL = `${window.baseUrl}/`;
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

Vue.use(VueAxios, axios);
Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes,
    linkExactActiveClass: "active",
});

Vue.use(auth, {
    plugins: {
        http: Vue.axios,
        router,
    },
    drivers: {
        auth: driverAuthBearer,
        http: driverHttpAxios,
        router: driverRouterVueRouter,
    },
    options: {
        loginData: {
            url: "api/auth/login",
            method: "POST",
        },
        registerData: {
            url: "api/auth/register",
            method: "POST",
        },
        fetchData: {
            url: "api/auth/me",
            method: "GET",
        },
        authRedirect: {
            path: "/auth/login",
        },
    },
});

const app = new Vue({
    el: "#app",
    router,
    render: (h) => h(App),
});
