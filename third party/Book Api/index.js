const fs = require("fs");
const axios = require("axios");
const book = [
    "harrypotter",
    "html",
    "sunview",
    "financial",
    "business",
    "blockchain",
    "nft",
];
const googleleapisAPI = "https://www.googleapis.com/books/v1/volumes?q=";

const books = [];
(async () => {
    // gather data
    for (let i = 0; i < book.length; i++) {
        const url = googleleapisAPI + book[i];
        const rsp = await axios
            .get(url)
            .then((rsp) => rsp.data.items)
            .catch((err) => console.error("Error > ", err));

        for (let j = 0; j < rsp.length; j++) {
            if (rsp[j] && rsp[j]?.volumeInfo && rsp[j].volumeInfo.title) {
                // check if book title is already in array
                if (
                    !books
                        .map((book) => book.title)
                        .includes(rsp[j].volumeInfo.title)
                ) {
                    const title = rsp[j].volumeInfo.title;
                    const author = rsp[j].volumeInfo?.authors
                        ? rsp[j].volumeInfo.authors[0]
                        : "Unknown";
                    const publisher = rsp[j].volumeInfo?.publisher || "Unknown";
                    const pages = rsp[j].volumeInfo?.pageCount || 0;
                    const categories = rsp[j].volumeInfo?.categories || [
                        "Unknown",
                    ];
                    const image =
                        rsp[j].volumeInfo?.imageLinks?.thumbnail ||
                        "https://utar.edu.my/dir/images/1560407830010rvcopy_1560407805.jpg?n=1560407830282set";
                    const book = {
                        title,
                        author,
                        publisher,
                        pages,
                        categories,
                        image,
                    };
                    books.push(book);
                }
            }
        }
    }

    //fs.writeFileSync("./books.json", JSON.stringify(books));

    for (let i = 0; i < books.length; i++) {
        // create book
        axios({
            method: "post",
            url: "http://127.0.0.1:8000/book",
            data: books[i],
        });
    }
})();
