<script setup>
import { computed, ref } from "vue";
import { useMainStore } from "@/stores/mainStore";

const mainStore = useMainStore();
const multipleTableRef = ref();

const fruitNutritionRows = computed(() => {
  return mainStore.favoriteFruits.map((fruit) => {
    return fruit.nutritions;
  });
});

const calculateTotalNutrition = (nutritions) => {
  return (
    nutritions.calories +
    nutritions.carbohydrates +
    nutritions.fat +
    nutritions.protein +
    nutritions.sugar
  );
};
</script>

<template>
  <div class="t-w-3/5 t-mx-auto">
    <h1>Nutrition Facts 🥗</h1>
    <el-table class="t-mt-8" ref="multipleTableRef" :data="fruitNutritionRows">
      <el-table-column property="fruit" label="Name" />
      <el-table-column property="calories" label="Calories" />
      <el-table-column
        property="carbohydrates"
        label="Carbohydrates"
        width="180px"
      />
      <el-table-column property="fat" label="Fat" />
      <el-table-column property="protein" label="Protein" />
      <el-table-column property="sugar" label="Sugar" />
      <el-table-column label="Total">
        <template #default="scope">
          {{ calculateTotalNutrition(scope.row) }}
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
export default {};
</script>

<style></style>
