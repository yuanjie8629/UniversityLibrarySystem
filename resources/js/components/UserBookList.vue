<template>
    <v-app style="background-color: transparent">
        <v-container fluid class="mx-0 px-8 d-flex">
            <!-- <p>{{ user_id }}</p> -->

            <v-row style="width: 100%; display: flex">
                <v-text-field
                    solo
                    v-model="search"
                    placeholder="Search Books"
                />
                <div v-if="!filterBooks.length" class="d-flex">
                    <v-img
                        src="https://www.thefitzip.com/public/frontend/imgs/norecordfound.png"
                        class="d-flex mx-auto my-auto"
                        max-width="400"
                        contain
                    ></v-img>
                </div>

                <v-col
                    v-for="(book, index) in filterBooks"
                    :key="index"
                    lg="3"
                    md="6"
                    cols="12"
                >
                    <BookCard :data="book" />
                </v-col>
                <!-- <v-col v-if="filterBooks === null">
                    No Record Found.
                    <v-img
                        src="http://m.prarang.in/img/norecordfound.png"
                        alt="norecord"
                        max-width="100"
                        max-height="100"
                    ></v-img>
                </v-col> -->
            </v-row>
        </v-container>
    </v-app>
</template>

<script>
import BookCard from "./BookCard.vue";
export default {
    // props: {
    //     user_id: {
    //         type: Object,
    //         required: true,
    //     },
    // },
    data() {
        return {
            books: [],
            loading: "true",
            search: "",
        };
    },
    components: {
        BookCard,
    },
    created() {
        this.initialize();
    },
    computed: {
        filterBooks: function () {
            return this.books.filter((book) => {
                console.log("2");
                console.log(
                    book.title.toLowerCase().match(this.search.toLowerCase())
                );
                return book.title
                    .toLowerCase()
                    .match(this.search.toLowerCase());
            });
        },
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
    },
};
</script>

<style></style>