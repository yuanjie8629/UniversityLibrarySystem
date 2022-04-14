<template>
    <v-app style="background-color: transparent">
        <v-container fluid class="mx-0 px-8 d-flex">
            <v-card class="pa-8" style="width: 60%">
                <v-card-title>Change Password</v-card-title>
                <v-form ref="form" v-model="formValid" lazy-validation>
                    <v-text-field
                        solo
                        label="Old Password"
                        placeholder="Enter password"
                        :append-icon="showOldPass ? 'mdi-eye' : 'mdi-eye-off'"
                        :type="showOldPass ? 'text' : 'password'"
                        v-model="old_password"
                        required
                        color="#6CAFAF"
                        :rules="emptyRules"
                        style="border-radius: 5px"
                        prepend-inner-icon="mdi-lock"
                        @click:append="showOldPass = !showOldPass"
                    />
                    <v-text-field
                        solo
                        label="Password"
                        placeholder="Enter new password"
                        :append-icon="showPass ? 'mdi-eye' : 'mdi-eye-off'"
                        :type="showPass ? 'text' : 'password'"
                        v-model="password"
                        required
                        color="#6CAFAF"
                        :rules="emptyRules"
                        style="border-radius: 5px"
                        prepend-inner-icon="mdi-lock"
                        @click:append="showPass = !showPass"
                    />
                    <v-text-field
                        solo
                        label="Confirm New Password"
                        placeholder="Enter new password"
                        :append-icon="showPass2 ? 'mdi-eye' : 'mdi-eye-off'"
                        :type="showPass2 ? 'text' : 'password'"
                        v-model="password2"
                        required
                        color="#6CAFAF"
                        :rules="emptyRules"
                        style="border-radius: 5px"
                        prepend-inner-icon="mdi-lock"
                        @click:append="showPass2 = !showPass2"
                    />
                    <v-btn
                        class="black--text my-2"
                        large
                        depressed
                        :loading="loading"
                        :disabled="
                            !formValid ||
                            old_password.length <= 0 ||
                            password.length <= 0 ||
                            password2.length <= 0
                        "
                        width="100%"
                        height="50px"
                        style="border-radius: 5px; background-color: #b5cfd8"
                        @click="changePassword"
                        >Change Password</v-btn
                    ></v-form
                >
            </v-card>
        </v-container>
    </v-app>
</template>

<script>
export default {
    props: {
        user_id: {
            type: Object,
            required: true,
        },
    },
    data: () => ({
        formValid: false,
        loading: false,
        showPass: false,
        showPass2: false,
        showOldPass: false,
        old_password: "",
        password: "",
        password2: "",
        emptyRules: [(v) => !!v || "This field is required"],
    }),
    methods: {
        async changePassword() {
            this.loading = true;
            if (!(this.password && this.password2 && this.old_password)) {
                this.changPassMessage = "Please fill in all field";
                this.loading = false;
                this.changPassSnackbar = true;
                return;
            }
            await axios
                .post(`http://127.0.0.1:8000/change-password/${this.user_id}`, {
                    old_password: this.old_password,
                    password: this.password,
                    password2: this.password2,
                })
                .then((res) => {
                    if (res.status === 200) {
                        Vue.$toast.open({
                            message: "The password has successfully changed!",
                            type: "success",
                            position: "top",
                        });
                        Object.assign(this.$data, {
                            loading: false,
                            showPass: false,
                            showPass2: false,
                            showOldPass: false,
                        });
                        this.$refs.form.reset();
                        this.$refs.form.resetValidation();
                    }
                })
                .catch((err) => {
                    if (err.response.data?.old_password) {
                        Vue.$toast.open({
                            message: err.response.data.old_password[0].replace(
                                "old_password",
                                "Old Password"
                            ),
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data?.password) {
                        Vue.$toast.open({
                            message: err.response.data.password[0].replace(
                                "password",
                                "Password"
                            ),
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data?.password2) {
                        Vue.$toast.open({
                            message: err.response.data.password2[0].replace(
                                "password2",
                                "Confirm Password"
                            ),
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.message) {
                        Vue.$toast.open({
                            message: err.response.data.message,
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

<style></style>
