<template>
  <main class="main main-products">
    <section class="main__block">
      <div class="container">
        <h1 class="title d-flex justify-content-center">Понравившиеся товары</h1>
        <div class="load" v-if="load">
          Load
        </div>
        <div v-else class="mt-0">
          <div class="main__content">
            <div>
              <div v-if="products.length>0">
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
              </div>
              <div v-else class="wishlist__empty">Нет понравившихся товаров</div>
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


import api from "@/api.js";
import {onMounted, ref, watch} from "vue";

const emit = defineEmits(['changeLike','addToCart','removeFromCart'])

const products = ref([])
const qty = ref(1)
const cart = ref([])
const load = ref(true)

const getLikedProducts = async ()=>{
  const {data} = await api.value.get('http://127.0.0.1:8881/api/auth/wishlist')

  products.value = data
  products.value = products.value.map((obj)=>({
    ...obj,
    isFavorite:true
  }))
}
const changeLike = async (id)=>{
  await api.value.post(`http://127.0.0.1:8881/api/auth/wishlist/${id}`)
  await getLikedProducts();
}

onMounted(async ()=>{
  document.querySelector('.header').classList.add("header-products")
  document.querySelector('.header__btn').classList.add('hidden')

  await getLikedProducts()

  const localCart = localStorage.getItem('cart')

  cart.value = localCart ? JSON.parse(localCart) : []

  products.value = products.value.map((item)=>({
    ...item,
    isAdded: cart.value.some((cartItem) => cartItem.id === item.id)
  }))

  setTimeout(()=>{
    load.value = false
  },400)

})

const addToCart = async (product)=>{
  product.qty = qty.value
  cart.value.push(product)
  console.log(cart.value)

}

const removeFromCart = async (product)=>{
  cart.value.splice(cart.value.indexOf(product),1)
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

watch(cart,()=>{

  localStorage.setItem('cart',JSON.stringify(cart.value))

  products.value = products.value.map((product)=>({
    ...product,
    isAdded: cart.value.some((cartItem) => cartItem.id === product.id)
  }))
},{deep:true})
</script>

<style scoped>

</style>