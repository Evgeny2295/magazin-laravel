<template>
  <main class="main main-products">
    <section class="main__block">
      <div class="container">
        <h1 class="text-center">Поиск по: {{query}}</h1>
        <div class="main__block-row">
          <SideBarComponent/>
          <div v-if="products.value">
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
        </div>
      </div>
    </section>
  </main>
</template>

<script setup>

import ProductsComponent from "@/components/product/ProductsComponent.vue";
import SideBarComponent from "@/components/sidebar/SideBarComponent.vue";
import {inject, onMounted, ref, watch} from "vue";
import axios from "axios";
import {useRoute} from 'vue-router'
import store from "@/store.js";
import api from "@/api.js";

const emit = defineEmits(['changeLike','addToCart','removeFromCart'])

const route = useRoute()
const search = ref('')
const products = ref([])
const likedProducts = ref([])
const qty = ref(1)
const cart = ref([])
const query = ref()
const page = ref()
const changeLike = async (id)=>{

  await api.value.post(`http://127.0.0.1:8881/api/auth/wishlist/${id}`)
  await getProducts();

}

const getProducts = async(quickPage = null)=>{

  query.value = route.query.search

  if(quickPage !== null){
    localStorage.setItem('page',quickPage)
  }
  if(localStorage.getItem('page') != null){
    page.value = localStorage.getItem('page');
  }

  const params = {
    s:query.value,
    page:page.value
  }

  if(query.value){
    const {data} = await axios.get('http://localhost:8881/api/search_product',{
      params
    })
    products.value = data

    if(likedProducts.value && products.value.length>0){
      products.value = products.value.map((product)=>({
        ...product,
        isFavorite: likedProducts.value.some((prod) => prod.id === product.id)
      }))
    }
  }


  if(store.getters.SEARCH_ICON_STATE == false){
    store.dispatch("TOGGLE_SEARCH")
  }
}


onMounted(async () => {
  document.querySelector('.header').classList.add("header-products")
  document.querySelector('.header__btn').classList.add('hidden')

  await getProducts()
  if(products.value.length>0){
    const localCart = localStorage.getItem('cart')
    cart.value = localCart ? JSON.parse(localCart) : []

    products.value = products.value.map((item)=>({
      ...item,
      isAdded: cart.value.some((cartItem) => cartItem.id === item.id)
    }))
  }


  if(store.getters.SEARCH_ICON_STATE == false){
    store.dispatch("TOGGLE_SEARCH")
  }
})

watch(cart,()=>{
  localStorage.setItem('cart',JSON.stringify(cart.value))

  products.value = products.value.map((product)=>({
    ...product,
    isAdded: cart.value.some((cartItem) => cartItem.id === product.id)
  }))
},{deep:true})

</script>

<style>
.header-products {
  height: 200px !important;
}
</style>