<template>
    <v-app>
        <v-data-table
            :headers="headers"
            :items="users"
            :search="search"
            sort-by="name"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>Users</v-toolbar-title>
                    <v-text-field
                        v-model="search"
                        append-icon="mdi-magnify"
                        label="Search"
                        single-line
                        hide-details
                        style="margin-left: 10%"
                        color="#6CAFAF"
                    ></v-text-field>
                    <v-divider class="mx-4" inset vertical></v-divider>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog" max-width="500px">
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                color="#6CAFAF"
                                dark
                                class="mb-2"
                                v-bind="attrs"
                                v-on="on"
                            >
                                Register Account
                            </v-btn>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="text-h5">{{ formTitle }}</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field
                                                v-model="editedItem.name"
                                                label="Name"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field
                                                v-model="editedItem.email"
                                                label="Email"
                                                placeholder="example@gmail.com"
                                                :rules="emailRules"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field
                                                v-model="editedItem.telephone"
                                                label="Telephone"
                                                placeholder="0123456789"
                                                :rules="phoneNoRules"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-select
                                                v-model="editedItem.role"
                                                :items="role_selection"
                                                :rules="[
                                                    (v) =>
                                                        !!v ||
                                                        'Role is required',
                                                ]"
                                                label="Role"
                                                required
                                            ></v-select>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            v-if="editedIndex > -1"
                                        >
                                            <v-checkbox
                                                v-model="resetPassword"
                                                value="true"
                                                label="Reset password"
                                                type="checkbox"
                                            ></v-checkbox>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn
                                    color="blue darken-1"
                                    text
                                    @click="close"
                                >
                                    Cancel
                                </v-btn>
                                <v-btn color="blue darken-1" text @click="save">
                                    {{
                                        editedIndex === -1
                                            ? "Register Account"
                                            : "Edit Users"
                                    }}
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <v-dialog v-model="dialogDelete" max-width="550px">
                        <v-card>
                            <v-card-title class="text-h5"
                                >Are you sure you want to delete this
                                user?</v-card-title
                            >
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn
                                    color="blue darken-1"
                                    text
                                    @click="closeDelete"
                                    >Cancel</v-btn
                                >
                                <v-btn
                                    color="blue darken-1"
                                    text
                                    @click="deleteItemConfirm"
                                    >OK</v-btn
                                >
                                <v-spacer></v-spacer>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
            <template v-slot:[`item.role`]="{ item }">
                <v-chip
                    class="ma-2"
                    :color="
                        item.role === 'ADMIN'
                            ? 'orange'
                            : item.role === 'STUDENT'
                            ? 'green'
                            : 'blue'
                    "
                    label
                    text-color="white"
                >
                    {{ item.role }}
                </v-chip>
            </template>

            <template v-slot:[`item.actions`]="{ item }">
                <v-icon small class="mr-2" @click="editItem(item)">
                    mdi-pencil
                </v-icon>
                <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
            </template>
            <template v-slot:no-data>
                <v-btn color="primary" @click="initialize"> Reset </v-btn>
            </template>
        </v-data-table>
    </v-app>
</template>

<script>
import axios from "axios";

export default {
    data: () => ({
        search: "",
        dialog: false,
        dialogDelete: false,
        headers: [
            {
                text: "User ID",
                value: "id",
            },
            {
                text: "Full Name",
                value: "name",
            },
            {
                text: "Email",
                align: "start",
                value: "email",
            },
            { text: "Phone Number", value: "telephone" },
            { text: "Role", value: "role" },
            { text: "Actions", value: "actions", sortable: false },
        ],
        users: [],
        role_selection: ["STUDENT", "LECTURER", "ADMIN"],
        editedIndex: -1,
        editedItem: {
            id: "",
            name: "",
            email: "",
            telephone: "",
            role: "",
        },
        defaultItem: {
            id: "",
            name: "",
            email: "",
            telephone: "",
            role: "",
        },
        emailRules: [
            (v) => !!v || "E-mail is required",
            (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
        ],
        phoneNoRules: [
            (v) => !!v || "Phone number is required",
            (v) => /^(\d{10}|\d{11})$/.test(v) || "Phone number must be valid",
        ],
        resetPassword: "false",
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "Register Account" : "Edit Users";
        },
    },

    watch: {
        dialog(val) {
            val || this.close();
        },
        dialogDelete(val) {
            val || this.closeDelete();
        },
    },

    created() {
        this.initialize();
    },

    methods: {
        initialize() {
            this.getUsers();
        },

        async getUsers() {
            this.users = await axios({
                method: "get",
                url: "http://127.0.0.1:8000/users",
            })
                .then((res) => {
                    if (res.status === 200) {
                        console.log("a list of users");
                        console.log(res.data, 1245);
                        return res.data;
                    }
                })
                .catch((err) => {
                    console.log(err, 5566);
                });
        },

        async registerAccount(user) {
            await axios
                .post("http://127.0.0.1:8000/register", user)
                .then((res) => {
                    if (res.status === 200) {
                        Vue.$toast.open({
                            message: "Account registered",
                            type: "success",
                            position: "top",
                        });
                        this.getUsers();
                    }
                })
                .catch((err) => {
                    console.log(err.response, 5566);
                    if (err.response.data.name) {
                        Vue.$toast.open({
                            message: err.response.data.name[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.role) {
                        Vue.$toast.open({
                            message: err.response.data.role[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.email) {
                        Vue.$toast.open({
                            message: err.response.data.email[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.telephone) {
                        Vue.$toast.open({
                            message: err.response.data.telephone[0],
                            type: "error",
                            position: "top",
                        });
                    } else {
                        Vue.$toast.open({
                            message: err.response.data.message[0],
                            type: "error",
                            position: "top",
                        });
                    }
                });
        },

        async editUser(user) {
            await axios
                .put("http://127.0.0.1:8000/user/" + user.id, user)
                .then((res) => {
                    if (res.status === 200) {
                        Vue.$toast.open({
                            message: "User is edited.",
                            type: "success",
                            position: "top",
                        });
                        this.getUsers();
                    }
                })
                .catch((err) => {
                    console.log(err.response, 7788);
                    if (err.response.data.name) {
                        Vue.$toast.open({
                            message: err.response.data.name[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.email) {
                        Vue.$toast.open({
                            message: err.response.data.email[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.telephone) {
                        Vue.$toast.open({
                            message: err.response.data.telephone[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.role) {
                        Vue.$toast.open({
                            message: err.response.data.role[0],
                            type: "error",
                            position: "top",
                        });
                    } else {
                        Vue.$toast.open({
                            message: err.response.data.message,
                            type: "error",
                            position: "top",
                        });
                    }
                });

            if (this.resetPassword === "true") {
                await axios
                    .post("http://127.0.0.1:8000/reset-password/" + user.id)
                    .then((res) => {
                        if (res.status === 200) {
                            this.resetPassword = "false";
                            Vue.$toast.open({
                                message: "Password reset successfully",
                                type: "success",
                                position: "top",
                            });
                            this.getUsers();
                        } else {
                            Vue.$toast.open({
                                message: "Password reset unsuccessfully",
                                type: "error",
                                position: "top",
                            });
                        }
                    })
                    .catch((err) => {
                        console.log(err.response, 7788);

                        Vue.$toast.open({
                            message: err.response.data.message,
                            type: "error",
                            position: "top",
                        });
                    });
            }
        },

        async deleteUsers(user) {
            await axios
                .delete("http://127.0.0.1:8000/user/" + user.id, user)
                .then((res) => {
                    if (res.status === 200) {
                        Vue.$toast.open({
                            message: "User is deleted.",
                            type: "success",
                            position: "top",
                        });
                        this.getUsers();
                    }
                })
                .catch((err) => {
                    console.log(err.response);
                    if (err.response.data.name) {
                        Vue.$toast.open({
                            message: err.response.data.name[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.role) {
                        Vue.$toast.open({
                            message: err.response.data.role[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.email) {
                        Vue.$toast.open({
                            message: err.response.data.email[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.telephone) {
                        Vue.$toast.open({
                            message: err.response.data.telephone[0],
                            type: "error",
                            position: "top",
                        });
                    } else {
                        Vue.$toast.open({
                            message: err.response.data.message,
                            type: "error",
                            position: "top",
                        });
                    }
                });
        },

        editItem(item) {
            this.editedIndex = this.users.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            this.editedIndex = this.users.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.deleteUsers(this.editedItem);
            this.closeDelete();
        },

        close() {
            this.dialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        closeDelete() {
            this.dialogDelete = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        save() {
            if (this.editedIndex > -1) {
                this.editUser(this.editedItem);
            } else {
                this.registerAccount(this.editedItem);
            }
            this.close();
        },
    },
};
</script>
