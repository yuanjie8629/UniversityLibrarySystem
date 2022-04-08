import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import VueToast from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

Vue.use(Vuetify);
Vue.use(VueToast);

export default new Vuetify({
    theme: {
        themes: {
            light: {
                primary: "#3f51b5",
                secondary: "#696969",
                accent: "#8c9eff",
                error: "#b71c1c",
            },
        },
    },
});
