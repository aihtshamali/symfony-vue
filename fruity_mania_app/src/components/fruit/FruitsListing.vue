<script setup>
import { computed, onMounted, ref } from "vue";
import { useMainStore } from "@/stores/mainStore";

const mainStore = useMainStore();
const multipleTableRef = ref();
const searchByName = ref("");
const searchByFamily = ref("");
const pageLimit = 10;

const favoritesLimitExceed = computed(() => {
  return mainStore.favoriteFruits?.length >= 10 ? true : false;
});

const isFruitPin = (fruit) => {
  return mainStore.favoriteFruits.some(
    (fruitItem) => JSON.stringify(fruitItem) === JSON.stringify(fruit)
  );
};

const onPageChange = (newPage) => {
  mainStore.fetchFruits(pageLimit, (newPage - 1) * pageLimit);
};

const fruitRows = computed(() => {
  let fruits = [];
  if (searchByName.value || searchByFamily.value) {
    fruits = mainStore.fruits.filter((fruit) => {
      return (
        fruit.name
          .toLowerCase()
          .includes(searchByName.value.trim().toLowerCase()) &&
        fruit.family
          .toLowerCase()
          .includes(searchByFamily.value.trim().toLowerCase())
      );
    });
  } else {
    fruits = mainStore.fruits;
  }

  return fruits;
});

onMounted(() => {
  mainStore.fetchFruits();
});
</script>

<template>
  <div class="t-w-3/5 t-mx-auto">
    <h1>Welcome to Fruity Mania! 🍓</h1>
    <div class="t-flex t-gap-4">
      <el-input
        class="t-w-[200px]"
        v-model="searchByName"
        placeholder="Search by Name"
        clearable
      />
      <el-input
        class="t-w-[200px]"
        v-model="searchByFamily"
        placeholder="Search by Family"
        clearable
      />
    </div>
    <el-table class="t-mt-4" ref="multipleTableRef" :data="fruitRows">
      <el-table-column property="name" label="Name" />
      <el-table-column property="genus" label="Genus" />
      <el-table-column property="family" label="Family" />
      <el-table-column property="fruitOrder" label="Order" />
      <el-table-column label="Actions">
        <template #default="scope">
          <el-button
            v-if="!isFruitPin(scope.row)"
            link
            :disabled="favoritesLimitExceed"
            type="primary"
            @click="mainStore.addToFavorites(scope.row)"
            >Add To Favorites
          </el-button>
          <el-button
            v-else
            link
            type="danger"
            @click="mainStore.removeFromFavorites(scope.row)"
          >
            Remove from Favorites
          </el-button>
        </template>
      </el-table-column>
    </el-table>
    <el-pagination
      background
      style="margin-top: 16px"
      layout="prev, pager, next"
      :total="mainStore.totalFruits"
      @update:current-page="onPageChange"
    />
  </div>
</template>

<script>
export default {};
</script>

<style></style>
