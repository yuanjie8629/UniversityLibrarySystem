<template>
    <v-app style="background-color: transparent">
        <v-container fluid class="mx-0 px-8 d-flex">
            <!-- <p>{{ user_id }}</p> -->
            <v-row style="width: 100%">
                <v-col
                    v-for="(book, index) in books"
                    :key="index"
                    lg="3"
                    md="6"
                    cols="12"
                >
                    <BookCard :data="book" />
                </v-col>
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
            // books: [
            //     {
            //         title: "The Martian",
            //         image: "https://lumiere-a.akamaihd.net/v1/images/image_a119dd78.jpeg",
            //         publisher: "test",
            //         author: "test",
            //         category: "Novel",
            //         status: "Lost",
            //     },
            //     {
            //         title: "The Hell",
            //         image: "https://lumiere-a.akamaihd.net/v1/images/image_a119dd78.jpeg",
            //         publisher: "hell",
            //         author: "hell",
            //         category: "hell",
            //         status: "Available",
            //     },
            //     {
            //         title: "UTAR SUCK MY DICK",
            //         image: "https://lumiere-a.akamaihd.net/v1/images/image_a119dd78.jpeg",
            //         publisher: "hell",
            //         author: "hell",
            //         category: "hell",
            //         status: "Borrowed",
            //     },
            //     {
            //         title: "UTAR IS TRASH",
            //         image: "https://lumiere-a.akamaihd.net/v1/images/image_a119dd78.jpeg",
            //         publisher: "hell",
            //         author: "hell",
            //         category: "hell",
            //         status: "Borrowed",
            //     },
            //     {
            //         title: "UTAR IS TRASH",
            //         image: "https://i.pinimg.com/originals/74/88/22/7488228009d153e94a00427f674d54bb.jpg",
            //         publisher: "hell",
            //         author: "hell",
            //         category: "hell",
            //         status: "Return",
            //     },
            //     {
            //         title: "UTAR IS TRASH",
            //         image: "https://lumiere-a.akamaihd.net/v1/images/image_a119dd78.jpeg",
            //         publisher: "hell",
            //         author: "hell",
            //         category: "hell",
            //         status: "Available",
            //     },
            //     {
            //         title: "UTAR IS TRASH",
            //         image: "https://lumiere-a.akamaihd.net/v1/images/image_a119dd78.jpeg",
            //         publisher: "hell",
            //         author: "hell",
            //         category: "hell",
            //         status: "Available",
            //     },
            //     {
            //         title: "UTAR IS TRASH",
            //         image: "https://lumiere-a.akamaihd.net/v1/images/image_a119dd78.jpeg",
            //         publisher: "hell",
            //         author: "hell",
            //         category: "hell",
            //         status: "Available",
            //     },
            // ],
            books: [],
            loading: "true",
        };
    },
    components: {
        BookCard,
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
    },
};
</script>

<style></style>
