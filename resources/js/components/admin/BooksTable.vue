<template>
    <v-app>
        <v-data-table
            :headers="headers"
            :items="books"
            :search="search"
            sort-by="title"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>Books</v-toolbar-title>
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
                                Add Books
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
                                            <v-img
                                                max-height="300"
                                                max-width="200"
                                                :src="
                                                    editedItem.image == ''
                                                        ? 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png'
                                                        : editedItem.image
                                                "
                                                contain
                                            >
                                            </v-img>
                                            <v-text-field
                                                v-model="editedItem.image"
                                                label="Image address"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field
                                                v-model="editedItem.title"
                                                label="Title"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field
                                                v-model="editedItem.author"
                                                label="Author"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field
                                                v-model="editedItem.publisher"
                                                label="Publisher"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field
                                                v-model="
                                                    editedItem.categories[0]
                                                "
                                                label="Categories"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field
                                                v-model="editedItem.pages"
                                                label="Pages"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-select
                                                v-model="editedItem.status"
                                                :items="status_selection"
                                                :rules="[
                                                    (v) =>
                                                        !!v ||
                                                        'Item is required',
                                                ]"
                                                label="Status"
                                                required
                                            ></v-select>
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
                                    Save
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <v-dialog v-model="dialogDelete" max-width="550px">
                        <v-card>
                            <v-card-title class="text-h5"
                                >Are you sure you want to delete this
                                book?</v-card-title
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
            <template v-slot:[`item.status`]="{ item }">
                <v-chip
                    class="ma-2"
                    :color="
                        item.status === 'AVAILABLE'
                            ? 'green'
                            : item.status === 'BORROWED'
                            ? 'orange'
                            : 'red'
                    "
                    label
                    text-color="white"
                >
                    {{ item.status }}
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
                text: "Book ID",
                value: "id",
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
            { text: "Author", value: "author" },
            { text: "Publisher", value: "publisher" },
            { text: "Categories", value: "categories" },
            { text: "Pages", value: "pages" },
            { text: "Status", value: "status", sortable: false },
            { text: "Actions", value: "actions", sortable: false },
        ],
        books: [],
        status_selection: ["AVAILABLE", "BORROWED", "LOST"],
        editedIndex: -1,
        editedItem: {
            id: "",
            image: "",
            title: "",
            author: "",
            publisher: "",
            categories: [],
            pages: 0,
            status: "",
        },
        defaultItem: {
            id: "",
            image: "",
            title: "",
            author: "",
            publisher: "",
            categories: [],
            pages: 0,
            status: "",
        },
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "Add Books" : "Edit Books";
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
            this.getBooks();
        },

        async getBooks() {
            this.books = await axios({
                method: "get",
                url: "http://127.0.0.1:8000/books",
            })
                .then((res) => {
                    if (res.status === 200) {
                        console.log("a list of books");
                        console.log(res.data, 1245);
                        return res.data;
                    }
                })
                .catch((err) => {
                    console.log(err, 5566);
                });
        },

        async addNewBooks(book) {
            await axios
                .post("http://127.0.0.1:8000/book", book)
                .then((res) => {
                    if (res.status === 201) {
                        Vue.$toast.open({
                            message: "New book added.",
                            type: "success",
                            position: "top",
                        });
                        this.getBooks();
                    }
                })
                .catch((err) => {
                    console.log(err.response, 5566);
                    if (err.response.data.title) {
                        Vue.$toast.open({
                            message: err.response.data.title[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.author) {
                        Vue.$toast.open({
                            message: err.response.data.author[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.publisher) {
                        Vue.$toast.open({
                            message: err.response.data.publisher[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.pages) {
                        Vue.$toast.open({
                            message: err.response.data.pages[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.categories) {
                        Vue.$toast.open({
                            message: err.response.data.categories[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.image) {
                        Vue.$toast.open({
                            message: err.response.data.image[0],
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

        async editBook(book) {
            await axios
                .put("http://127.0.0.1:8000/book/" + book.id, book)
                .then((res) => {
                    if (res.status === 200) {
                        Vue.$toast.open({
                            message: "Book is edited.",
                            type: "success",
                            position: "top",
                        });
                        this.getBooks();
                    } else {
                        console.log(book.id, 1255);
                        Vue.$toast.open({
                            message: "Book is not edited.",
                            type: "error",
                            position: "top",
                        });
                    }
                })
                .catch((err) => {
                    console.log(err.response, 7788);
                    if (err.response.data.title) {
                        Vue.$toast.open({
                            message: err.response.data.title[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.author) {
                        Vue.$toast.open({
                            message: err.response.data.author[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.publisher) {
                        Vue.$toast.open({
                            message: err.response.data.publisher[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.pages) {
                        Vue.$toast.open({
                            message: err.response.data.pages[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.categories) {
                        Vue.$toast.open({
                            message: err.response.data.categories[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.image) {
                        Vue.$toast.open({
                            message: err.response.data.image[0],
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

        async deleteBook(book) {
            await axios
                .delete("http://127.0.0.1:8000/book/" + book.id, book)
                .then((res) => {
                    if (res.status === 200) {
                        Vue.$toast.open({
                            message: "Book is deleted.",
                            type: "success",
                            position: "top",
                        });
                        this.getBooks();
                    } else {
                        console.log(book.id, 1255);
                        Vue.$toast.open({
                            message: "Book is not deleted.",
                            type: "error",
                            position: "top",
                        });
                    }
                })
                .catch((err) => {
                    console.log(err.response);
                    if (err.response.data.title) {
                        Vue.$toast.open({
                            message: err.response.data.title[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.author) {
                        Vue.$toast.open({
                            message: err.response.data.author[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.publisher) {
                        Vue.$toast.open({
                            message: err.response.data.publisher[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.pages) {
                        Vue.$toast.open({
                            message: err.response.data.pages[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.categories) {
                        Vue.$toast.open({
                            message: err.response.data.categories[0],
                            type: "error",
                            position: "top",
                        });
                    } else if (err.response.data.image) {
                        Vue.$toast.open({
                            message: err.response.data.image[0],
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

        editItem(item) {
            this.editedIndex = this.books.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            this.editedIndex = this.books.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.deleteBook(this.editedItem);
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
                this.editBook(this.editedItem);
            } else {
                this.addNewBooks(this.editedItem);
            }
            this.close();
        },
    },
};
</script>
