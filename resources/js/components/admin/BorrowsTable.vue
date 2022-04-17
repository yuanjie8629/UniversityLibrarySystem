<template>
    <v-app>
        <v-data-table
            :headers="headers"
            :items="borrows"
            :search="search"
            sort-by="title"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>Borrows</v-toolbar-title>
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
                                Borrow Book
                            </v-btn>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="text-h5">{{ formTitle }}</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-row v-if="editedIndex > -1">
                                        <v-col col="12">
                                            <v-menu
                                                ref="menu"
                                                v-model="menu"
                                                :close-on-content-click="false"
                                                :return-value.sync="return_date"
                                                transition="scale-transition"
                                                offset-y
                                                min-width="auto"
                                            >
                                                <template
                                                    v-slot:activator="{
                                                        on,
                                                        attrs,
                                                    }"
                                                >
                                                    <v-text-field
                                                        v-model="return_date"
                                                        label="Return Date"
                                                        prepend-icon="mdi-calendar"
                                                        readonly
                                                        v-bind="attrs"
                                                        v-on="on"
                                                    ></v-text-field>
                                                </template>
                                                <v-date-picker
                                                    v-model="return_date"
                                                    no-title
                                                    scrollable
                                                >
                                                    <v-spacer></v-spacer>
                                                    <v-btn
                                                        text
                                                        color="primary"
                                                        @click="menu = false"
                                                    >
                                                        Cancel
                                                    </v-btn>
                                                    <v-btn
                                                        text
                                                        color="primary"
                                                        @click="
                                                            $refs.menu.save(
                                                                return_date
                                                            )
                                                        "
                                                    >
                                                        OK
                                                    </v-btn>
                                                </v-date-picker>
                                            </v-menu>
                                        </v-col>
                                    </v-row>
                                    <v-row v-else>
                                        <v-col cols="12">
                                            <v-text-field
                                                v-model="editedItem.user_id"
                                                label="User ID"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field
                                                v-model="editedItem.book_id"
                                                label="Book ID"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-menu
                                                ref="menu"
                                                v-model="menu"
                                                :close-on-content-click="false"
                                                :return-value.sync="borrow_date"
                                                transition="scale-transition"
                                                offset-y
                                                min-width="auto"
                                            >
                                                <template
                                                    v-slot:activator="{
                                                        on,
                                                        attrs,
                                                    }"
                                                >
                                                    <v-text-field
                                                        v-model="borrow_date"
                                                        label="Borrow Date"
                                                        prepend-icon="mdi-calendar"
                                                        readonly
                                                        v-bind="attrs"
                                                        v-on="on"
                                                    ></v-text-field>
                                                </template>
                                                <v-date-picker
                                                    v-model="borrow_date"
                                                    no-title
                                                    scrollable
                                                >
                                                    <v-spacer></v-spacer>
                                                    <v-btn
                                                        text
                                                        color="primary"
                                                        @click="menu = false"
                                                    >
                                                        Cancel
                                                    </v-btn>
                                                    <v-btn
                                                        text
                                                        color="primary"
                                                        @click="
                                                            $refs.menu.save(
                                                                borrow_date
                                                            )
                                                        "
                                                    >
                                                        OK
                                                    </v-btn>
                                                </v-date-picker>
                                            </v-menu>
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
                                            ? "Borrow Book"
                                            : "Return Book"
                                    }}
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <v-dialog v-model="dialogDelete" max-width="550px">
                        <v-card>
                            <v-card-title class="text-h5"
                                >Are you sure you want to delete this
                                borrow?</v-card-title
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
            <template v-slot:[`item.image`]="{ item }">
                <v-img
                    max-height="300"
                    max-width="200"
                    :src="item.image"
                    contain
                >
                </v-img>
            </template>
            <template v-slot:[`item.actions`]="{ item }">
                <v-icon
                    small
                    class="mr-2"
                    :disabled="item.return_date ? true : false"
                    @click="editItem(item)"
                >
                    mdi-keyboard-return
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
                text: "Borrow ID",
                value: "id",
                sortable: false,
            },
            {
                text: "Book ID",
                value: "book_id",
                sortable: false,
            },
            {
                text: "Book Cover",
                value: "image",
                sortable: false,
            },
            {
                text: "Title",
                align: "start",
                value: "title",
            },
            { text: "Borrower's Name", value: "name" },
            { text: "Borrow Date", value: "borrow_date" },
            { text: "Return Date", value: "return_date" },
            { text: "Actions", value: "actions", sortable: false },
        ],
        borrows: [],
        editedIndex: -1,
        editedItem: {
            id: "",
            book_id: "",
            image: "",
            title: "",
            name: "",
            borrow_date: new Date(
                Date.now() - new Date().getTimezoneOffset() * 60000
            )
                .toISOString()
                .substr(0, 10),
            return_date: new Date(
                Date.now() - new Date().getTimezoneOffset() * 60000
            )
                .toISOString()
                .substr(0, 10),
        },
        defaultItem: {
            id: "",
            book_id: "",
            image: "",
            title: "",
            name: "",
            borrow_date: new Date(
                Date.now() - new Date().getTimezoneOffset() * 60000
            )
                .toISOString()
                .substr(0, 10),
            return_date: new Date(
                Date.now() - new Date().getTimezoneOffset() * 60000
            )
                .toISOString()
                .substr(0, 10),
        },

        menu: false,
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "Borrow book" : "Edit borrow";
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
            this.getBorrows();
        },

        async getBorrows() {
            this.borrows = await axios({
                method: "get",
                url: "http://127.0.0.1:8000/borrows",
            })
                .then((res) => {
                    if (res.status === 200) {
                        console.log("a list of borrows");
                        console.log(res.data, 8787);
                        return res.data;
                    }
                })
                .catch((err) => {
                    console.log(err.response, 5566);
                    Vue.$toast.open({
                        message: err.response.data.message,
                        type: "error",
                        position: "top",
                    });
                });
        },

        async borrowBook(borrow) {
            await axios
                .post("http://127.0.0.1:8000/borrow", {
                    user_id: borrow.user_id,
                    book_id: borrow.book_id,
                    borrow_date: this.borrow_date,
                })
                .then((res) => {
                    if (res.status === 200) {
                        Vue.$toast.open({
                            message: "This book is successfully borrowed",
                            type: "success",
                            position: "top",
                        });
                        this.getBorrows();
                    }
                })
                .catch((err) => {
                    console.log(err.response, 5566);
                    if (err.response.data.user_id) {
                        Vue.$toast.open({
                            message: err.response.data.user_id[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.book_id) {
                        Vue.$toast.open({
                            message: err.response.data.book_id[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.borrow_date) {
                        Vue.$toast.open({
                            message: err.response.data.borrow_date[0],
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

        async returnBook(borrow) {
            await axios
                .put("http://127.0.0.1:8000/borrow/" + borrow.id, {
                    book_id: borrow.book_id,
                    return_date: this.return_date,
                    status: "AVAILABLE",
                })
                .then((res) => {
                    if (res.status === 200) {
                        Vue.$toast.open({
                            message: "Book is successfully returned",
                            type: "success",
                            position: "top",
                        });
                        this.getBorrows();
                    } else {
                        console.log(book.id, 1255);
                        Vue.$toast.open({
                            message: "Book is not returned",
                            type: "error",
                            position: "top",
                        });
                    }
                })
                .catch((err) => {
                    console.log(err.response, 7788);
                    if (err.response.data.book_id) {
                        Vue.$toast.open({
                            message: err.response.data.book_id[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.return_date) {
                        Vue.$toast.open({
                            message: err.response.data.return_date[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.status) {
                        Vue.$toast.open({
                            message: err.response.data.status[0],
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

        async deleteBorrow(borrow) {
            await axios
                .delete("http://127.0.0.1:8000/borrow/" + borrow.id, borrow)
                .then((res) => {
                    if (res.status === 200) {
                        Vue.$toast.open({
                            message: "Borrow is deleted.",
                            type: "success",
                            position: "top",
                        });
                        this.getBorrows();
                    } else {
                        console.log(book.id, 1255);
                        Vue.$toast.open({
                            message: "Borrow is not deleted.",
                            type: "error",
                            position: "top",
                        });
                    }
                })
                .catch((err) => {
                    console.log(err.response);
                    Vue.$toast.open({
                        message: err.response.data.message,
                        type: "error",
                        position: "top",
                    });
                });
        },

        editItem(item) {
            console.log(item);
            this.editedIndex = this.borrows.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            this.editedIndex = this.borrows.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.deleteBorrow(this.editedItem);
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
                console.log(this.editedItem, 8877);
                this.returnBook(this.editedItem);
            } else {
                this.borrowBook(this.editedItem);
            }
            this.close();
        },
    },
};
</script>
