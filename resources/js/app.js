import './bootstrap';
import '../css/app.css'

import { createApp, markRaw } from 'vue';
import { createPinia } from "pinia";
import router from "./Router";
import { abilitiesPlugin } from '@casl/vue';
import ability from './Ability';

import App from "./App.vue";

import Notifications from 'notiwind'

const app = createApp(App);
const pinia = createPinia();

pinia.use(({ store }) => {
  store.$router = markRaw(router);
});
app.use(Notifications);
app.use(pinia);
app.use(router);
app.use(abilitiesPlugin, ability, {
  useGlobalProperties: true,
});

import JWTInterceptor from "./helpers/JWTInterceptor";
JWTInterceptor();

app.mount("#app");
