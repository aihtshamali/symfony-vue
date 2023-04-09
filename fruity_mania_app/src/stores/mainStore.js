import { defineStore } from "pinia";
import apiClient from "@/utils/helpers/apiClient";

export const useMainStore = defineStore({
  id: "mainStore",
  state: () => ({
    fruits: [],
    favoriteFruits: [],
  }),
  getters: {},
  actions: {
    fetchFruits() {
      apiClient.get("http://localhost:8000/fruits/all").then((response) => {
        this.fruits = response.data;
      });
    },
    addToFavorites(fruit) {
      if (this.favoriteFruits.length < 10) {
        this.favoriteFruits = [...this.favoriteFruits, fruit];
      }
    },
    removeFromFavorites(fruit) {
      const fruitIndex = this.favoriteFruits.findIndex(
        (favoriteFruit) => favoriteFruit.id == fruit.id
      );
      this.favoriteFruits.splice(fruitIndex, 1);
    },
  },
});
