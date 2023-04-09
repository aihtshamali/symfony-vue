import { createRouter, createWebHashHistory } from "vue-router";
import HomeView from "@/views/HomeView.vue";
import FavoritesListing from "@/components/fruit/FavoritesListing";

const routes = [
  {
    path: "/",
    name: "Home",
    component: HomeView,
  },
  {
    path: "/favorites",
    name: "Favorites",
    component: FavoritesListing,
  },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;
