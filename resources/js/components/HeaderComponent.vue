<template>
  <header class="header">
    <div class="container">
      <div class="header__block">
        <router-link to="/"><img style="width: 50px;height: 50px" src="/src/assets/img/logo.png" alt=""></router-link>
        <p class="header__block-address m-0">Томск</p>
        <div class="header__block-button">
          <div class="header__search">
            <button @click="$emit('showSearch')" v-if="searchIcon" class="header__search-icon"><i class="fas fa-search"></i></button>
            <div class="header__search-form" v-if="searchShow">
              <form action="/search" >
                <input @input="$emit('onChangeInputSearch',$event)" class="header__search-input" type="text" name="s" placeholder="Поиск">
                <button  @click="$emit('closeSearch')" type="button" class="header__search-close"><i class="fas fa-times"></i></button>
                <button @click="$emit('searchDataFromServer')" type="button" class="header__search-icon"><i class="fas fa-search"></i></button>
              </form>
            </div>
          </div>
          <div v-if="accessToken" class="header__wishlist">
            <router-link to="/wishlist"><i class="far fa-heart"></i></router-link>
          </div>
          <div class="dropdown">
            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
              <i class="far fa-user"></i>
            </a>
            <ul class="dropdown-menu">
              <li><router-link v-if="!accessToken" class="dropdown-item" to="/user/login">Логин</router-link></li>
              <li><router-link v-if="!accessToken" class="dropdown-item" to="/user/signup">Регистрация</router-link></li>

              <li><router-link  v-if="accessToken" class="dropdown-item" to="/personal">Кабинет</router-link></li>
              <li><a @click.prevent = "$emit('logout')" v-if="accessToken" class="dropdown-item" href="user/logout">Выйти</a></li>
            </ul>
          </div>
          <div class="header__cart">
            <router-link to="/cart"  id="get-cart" class="relative">
              <i class="fas fa-shopping-cart"></i>
              <span class="badge bg-danger rounded-pill count-items"></span>
            </router-link>
          </div>
        </div>
        <p class="header__block-phone m-0">8 (800) 900-90-90</p>
        <div class="header__language">
        </div>
      </div>
      <nav class="header__menu">
        <table class="header__menu-table">
          <tbody>
            <tr class="header__menu-row">
              <td class="header__menu-column header__menu-column-catalog">
                <button @click="$emit('catalogOpen')" class="header__menu-catalog">
                  Каталог
                </button>
                <ul class="header__menu-catalog-dropdown" v-if="store.getters.SEARCH_CATALOG" >
                  <li v-for="category in categories" class="header__menu-catalog-item">
                    <router-link :to="{name:'Categories',params:{id:category.id}}">
                      {{ category.title }}
                    </router-link>
                  </li>
                </ul>
              </td>
              <td class="header__menu-column">
                <router-link :to="{name:'Delivery'}">
                  Доставка
                </router-link>
              </td>
              <td class="header__menu-column">
                <router-link :to="{name:'Collections'}">
                  Коллекции
                </router-link>
              </td>
              <td class="header__menu-column">
                <router-link :to="{name:'Contacts'}">
                  Контакты
                </router-link>
              </td>
            </tr>
          </tbody>
        </table>
      </nav>
      <div class="header__btn">
        <a href="#" class="btn btn--green header__btn-link">ВИННАЯ КАРТА</a>
        <a href="#" class="btn btn--green header__btn-link">ДЕГУСТАЦИЯ</a>
      </div>
    </div>
  </header>
</template>

<script setup>
import store from "@/store.js";
let qty = ref(0)
defineProps({
  categories: Array,
  searchIcon: Boolean,
  searchShow: Boolean,
  catalog: Boolean,
  accessToken: String,
  user: Object
})

defineEmits(['showSearch','closeSearch','catalogOpen','onChangeInputSearch','searchDataFromServer','logout'])

//   const qtyProducts = computed(()=>{
//
//   const cart = JSON.parse(localStorage.getItem('cart'))
//
//  cart.forEach(function (product){
//     qty.value += product.qty
//  })
//   console.log(qty.value)
//
//  return qty.value
// })

import {computed, defineProps, onMounted, ref} from "vue";
import {defineEmits} from "vue";
</script>

<style scoped>

</style>