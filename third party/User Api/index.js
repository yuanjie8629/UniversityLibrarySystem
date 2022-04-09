const axios = require("axios");
const faker = require("@faker-js/faker").default;

(async () => {
    await axios({
        method: "post",
        url: "http://127.0.0.1:8000/api/register",
        data: {
            name: faker.internet.userName(),
            email: faker.internet.email(),
            password: faker.internet.password(),
        },
    });
})();
