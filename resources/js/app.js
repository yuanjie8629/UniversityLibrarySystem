/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;
import vuetify from "./vuetify";

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

Vue.component("login-form", require("./components/LoginForm.vue").default);

//Admin Components
Vue.component(
    "admin-books-table",
    require("./components/admin/BooksTable.vue").default
);

Vue.component(
    "admin-users-table",
    require("./components/admin/UsersTable.vue").default
);

Vue.component(
    "user-book-list",
    require("./components/UserBookList.vue").default
);

Vue.component(
    "change-password-form",
    require("./components/ChangePasswordForm.vue").default
);

Vue.component(
    "admin-borrows-table",
    require("./components/admin/BorrowsTable.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    vuetify,
});
