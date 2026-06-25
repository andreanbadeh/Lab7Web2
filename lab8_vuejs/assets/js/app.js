const { createApp } = Vue;
const { createRouter, createWebHashHistory } = VueRouter;

const apiUrl = "http://localhost:8080";

const routes = [
    {
        path: "/",
        component: Home
    },
    {
        path: "/login",
        component: Login
    },
    {
        path: "/artikel",
        component: Artikel,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: "/about",
        component: About,
        meta: {
            requiresAuth: true
        }
    }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes
});

router.beforeEach((to, from, next) => {

    const isLoggedIn =
        localStorage.getItem("isLoggedIn") === "true";

    if (to.matched.some(route => route.meta.requiresAuth) && !isLoggedIn) {

        alert("Anda harus login terlebih dahulu!");
        next("/login");

    } else {

        next();

    }

});

const app = createApp({

    data() {

        return {
            isLoggedIn:
                localStorage.getItem("isLoggedIn") === "true"
        };

    },

    methods: {

        logout() {

            localStorage.removeItem("isLoggedIn");
            localStorage.removeItem("userToken");

            this.isLoggedIn = false;

            this.$router.push("/");

            window.location.reload();

        }

    }

});

app.use(router);
app.mount("#app");