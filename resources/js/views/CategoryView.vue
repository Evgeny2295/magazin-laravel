<template>
  <div id="main-block">
    <main class="main main-products">
      <section class="main__block">
        <div class="container">
          <div class="main__breadcrumbs">
            <ul class="main__breadcrumbs-list">
              <ol class="breadcrumb bg-light p-2">
                <li class="breadcrumb-item"><router-link :to="{name: 'Main'}" class="text-black-50"><i class="fas fa-home"></i>Главная</router-link></li>
                <li v-if="products.length > 0" class="main__breadcrumbs-item">{{products[0]['categoryTitle']}}</li>
              </ol>
            </ul>
          </div>
          <h1 v-if="products.length > 0" class="text-center">{{products[0]['categoryTitle']}}</h1>
          <div class="main__block-row">
            <SideBarComponent/>
            <div v-if="products.length > 0" >
              <div class="main__sort">
                <select @change="onChangeSelect" name="" id="">
                  <option  value="titleUp">По названию <i class="fa-solid fa-arrow-up"></i></option>
                  <option  value="titleDown">По названию <i class="fas fa-arrow-down"></i></option>
                  <option value="priceUp">По цене <i class="fas fa-arrow-up"></i></option>
                  <option value="priceDown">По цене <i class="fas fa-arrow-down"></i></option>
                </select>
              </div>
              <ProductsComponent v-if="products.length > 0"
                :products = "products"
                @change-like = "changeLike"
                @add-to-cart = "(data)=>emit('addToCart',data)"
                @remove-from-cart = "(product)=>emit('removeFromCart',product)"
              />
              <div class="products__pagination mt-3">
                <nav aria-label="...">
                  <ul class="pagination">
                    <li v-if="pagination.current_page !== 1" class="page-item">
                      <a @click.prevent = getProducts(pagination.current_page-1) class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>

                    <li v-for="link in pagination.links" :class="link.active ? 'page-item active' : 'page-item'">
                      <template v-if="Number(link.label)">
                        <a @click.prevent = getProducts(link.label) class="page-link" href="#">{{link.label}}</a>
                      </template>
                    </li>
                    <li v-if="pagination.current_page !== pagination.last_page" class="page-item">
                      <a @click.prevent = getProducts(pagination.current_page+1) class="page-link" href="#">Next</a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
            <div v-else>
             <h3>В этой категории еще нет товаров</h3>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</template>

<script setup>

import ProductsComponent from "@/components/product/ProductsComponent.vue";
import SideBarComponent from "@/components/sidebar/SideBarComponent.vue";
defineProps({
  likedProducts: Array
})
const emit = defineEmits(['changeLike','addToCart','removeFromCart'])

import {inject, onMounted, reactive, ref, watch} from "vue";
import {useRoute} from "vue-router";
import axios from "axios";
import store from "@/store.js";
import api from "@/api.js";

const products = ref([])
const route = useRoute()
const id = route.params.id
const cart = ref([])
const qty = ref(1)
const likedProducts = ref([])
const pagination = ref([])
const page = ref(1)


const getProducts = async (quickPage = null)=>{
  if(quickPage !== null){
    localStorage.setItem('page',quickPage)
  }
  if(localStorage.getItem('page') != null){
    page.value = localStorage.getItem('page');
  }

  const {data} = await axios.get(`http://localhost:8881/api/categories/${id}/products`,{
    params:{page:page.value}
  })

  products.value = data.data

  pagination.value = data

  if(likedProducts.value){
    products.value = products.value.map((product)=>({
      ...product,
      isFavorite: likedProducts.value.some((prod) => prod.id === product.id)
    }))
  }
}

const changeLike = async (id)=>{
  await api.value.post(`http://127.0.0.1:8881/api/auth/wishlist/${id}`)
  await getProducts();
}

const onChangeSelect = (event)=>{
    if(event.target.value === 'titleUp'){
      products.value.sort((a, b) => a.title > b.title ? 1 : -1)
    }else if(event.target.value === 'titleDown'){
      products.value.sort((a, b) => a.title < b.title ? 1 : -1)
    }else if(event.target.value === 'priceUp'){
      products.value.sort((a, b) => a.price > b.price ? 1 : -1)
    }else if(event.target.value === 'priceDown'){
      products.value.sort((a, b) => a.price < b.price ? 1 : -1)
    }
}

onMounted(async()=>{
  document.querySelector('.header').classList.add("header-products")
  document.querySelector('.header__btn').classList.add('hidden')

  await getProducts()
  const localCart = localStorage.getItem('cart')
  cart.value = localCart ? JSON.parse(localCart) : []

  products.value = products.value.map((item)=>({
    ...item,
    isAdded: cart.value.some((cartItem) => cartItem.id === item.id)
  }))

  if(store.getters.SEARCH_ICON_STATE == false){
    store.dispatch("TOGGLE_SEARCH")
  }
})

watch(cart,()=>{
  localStorage.setItem('cart',JSON.stringify(cart.value))
},{deep:true})

const categories = inject('categories')
const user = inject('user')

</script>

<style>
.header-products {
  height: 200px !important;
}
</style>