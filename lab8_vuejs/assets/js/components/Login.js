const Login = {

    template: `
    <div class="login-container">

        <div class="login-box">

            <h2>Login Admin</h2>

            <form @submit.prevent="handleLogin">

                <div class="form-group">
                    <label>Username / Email</label>
                    <input
                        type="text"
                        v-model="username"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input
                        type="password"
                        v-model="password"
                        required
                    >
                </div>

                <button
                    type="submit"
                    class="btn-login"
                >
                    Login
                </button>

            </form>

            <p class="error-msg">
                {{ errorMessage }}
            </p>

        </div>

    </div>
    `,

    data() {

        return {

            username: "",
            password: "",
            errorMessage: ""

        };

    },

    methods: {

        handleLogin() {

            this.errorMessage = "";

            axios.post(apiUrl + "/api/login", {

                username: this.username,
                password: this.password

            })
            .then((response) => {

                if (response.data.status === 200) {

                    localStorage.setItem(
                        "isLoggedIn",
                        "true"
                    );

                    localStorage.setItem(
                        "userToken",
                        response.data.data.token
                    );

                    this.$router.push("/artikel");

                    window.location.reload();

                }

            })
            .catch((error) => {

                if (
                    error.response &&
                    error.response.data
                ) {

                    this.errorMessage =
                        error.response.data.messages;

                } else {

                    this.errorMessage =
                        "Login gagal.";

                }

            });

        }

    }

};