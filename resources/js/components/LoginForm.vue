<template>
    <v-app style="background-color: transparent">
        <v-container fluid class="mx-0 px-8 d-flex">
            <v-card
                class="mx-auto mb-15 mt-10 py-8"
                :class="$vuetify.breakpoint.smAndDown ? 'px-8' : 'px-15'"
                :width="$vuetify.breakpoint.mdAndDown ? '100%' : '50%'"
                min-height="200px"
                style="border-radius: 40px"
            >
                <div style="padding: 30px">
                    <h1>University Library Management System</h1>
                    <p style="font-size: 14px">
                        Please enter your credentials to
                        <span style="font-size: 14px; color: grey">login</span>
                    </p>
                    <h2>Email</h2>
                    <v-form ref="form" v-model="formValid" lazy-validation>
                        <v-text-field
                            solo
                            label="Email"
                            placeholder="Enter registered email"
                            v-model="email"
                            required
                            color="#6CAFAF"
                            :rules="emailRules"
                            style="border-radius: 5px"
                            class=""
                            prepend-inner-icon="mdi-account"
                        ></v-text-field>
                        <h3>Password</h3>
                        <v-text-field
                            solo
                            label="Password"
                            placeholder="Enter password"
                            :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                            :type="show ? 'text' : 'password'"
                            v-model="password"
                            required
                            color="#6CAFAF"
                            :rules="emptyRules"
                            style="border-radius: 5px"
                            prepend-inner-icon="mdi-lock"
                            @click:append="show = !show"
                        ></v-text-field>

                        <v-btn
                            class="black--text mt-10 mb-2"
                            large
                            depressed
                            :loading="loading"
                            :disabled="
                                !formValid ||
                                email.length <= 0 ||
                                password.length <= 0
                            "
                            width="100%"
                            height="50px"
                            style="
                                border-radius: 5px;
                                background-color: #b5cfd8;
                            "
                            @click="login"
                            >Login<v-icon>mdi-chevron-right</v-icon>
                        </v-btn>
                    </v-form>
                </div>
            </v-card>
        </v-container>
    </v-app>
</template>

<script>
import axios from "axios";

export default {
    data: () => ({
        formValid: false,
        loading: false,
        show: false,
        email: "",
        password: "",
        emptyRules: [(v) => !!v || "This field is required"],
        emailRules: [
            (v) => !!v || "E-mail is required",
            (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
        ],
        isFormValid: false,
        loginMessage: "",
    }),

    methods: {
        async login() {
            this.loading = true;
            if (!this.email || !this.password) {
                this.loginMessage = "Please fill in all field";
                this.loading = false;
                return;
            }

            await axios
                .post("http://127.0.0.1:8000/login", {
                    email: this.email,
                    password: this.password,
                })
                .then((res) => {
                    if (res.status === 200) {
                        console.log("navigate to dashboard", 4455);
                        window.location.reload();
                    }
                })
                .catch((err) => {
                    console.log(err.response.data, 4455);
                    if (err.response.data.errors.email) {
                        Vue.$toast.open({
                            message: err.response.data.errors.email[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.errors.password) {
                        Vue.$toast.open({
                            message: err.response.data.errors.password[0],
                            type: "error",
                            position: "top",
                        });
                    }
                    this.loading = false;
                });
        },
    },
};
</script>
