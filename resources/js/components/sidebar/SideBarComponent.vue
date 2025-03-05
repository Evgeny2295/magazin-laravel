<template>
  <div class="main__navbar">
    <ul class="main__navbar-list">
      <li v-for="category in categories" class="main__navbar-item">
        <router-link class="main__navbar-link" to="">{{category.title}}</router-link>
        <span class="main__navbar-item-qty"></span>
      </li>
    </ul>
  </div>
</template>

<script setup>
import {inject} from "vue";

const categories = inject('categories')

</script>

<style scoped>

</style>