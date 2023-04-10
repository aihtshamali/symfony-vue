import { defineStore } from "pinia";
import apiClient from "@/utils/helpers/apiClient";

export const useMainStore = defineStore({
  id: "mainStore",
  state: () => ({
    fruits: [],
    favoriteFruits: [],
    totalFruits: 0,
  }),
  getters: {},
  actions: {
    fetchFruits(limit = 10, offset = 0) {
      apiClient
        .get(`http://localhost:8000/fruits/all?limit=${limit}&offset=${offset}`)
        .then((response) => {
          this.fruits = response.data.fruits;
          this.totalFruits = response.data.totalRecords;
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
