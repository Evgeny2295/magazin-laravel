<template>
  <div id="main-block">
    <main class="main main-products">
      <section class="main__block">
        <div class="container">
          <div class="main__block-row">
            <SideBarComponent/>
            <div class="d-flex gap-3">
              <ProductComponent
                :product = "product"
                :is-added="product.isAdded"
                :change-like="()=>emit('changeLike',product.id)"
                @add-to-cart="(qty)=>emit('addToCart',[product,qty])"
                :remove-from-cart="()=>emit('removeFromCart',product)"
              />
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</template>

<script setup>

import ProductComponent from "@/components/product/ProductComponent.vue";
import SideBarComponent from "@/components/sidebar/SideBarComponent.vue";

const emit = defineEmits(['changeLike','addToCart','removeFromCart'])

import {ref, onMounted, inject} from "vue";
import {useRoute} from "vue-router";
import axios from "axios";
import api from "@/api.js";

const route = useRoute()
const product = ref([])
const slug = ref('')
const likedProducts = ref([])
const categories = inject('categories')

const getLikedProducts =async ()=>{
  const {data} = await api.value.get('http://127.0.0.1:8881/api/auth/wishlist')
  likedProducts.value = data
}

const getProduct = async ()=>{
  const {data} = await axios.get(`http://127.0.0.1:8881/api/product/${slug.value}`)
  await getLikedProducts()
  product.value = data
  product.value['isFavorite'] = likedProducts.value.some((prod) => prod.id === product.value.id)
}

onMounted(async ()=>{
  document.querySelector('.header').classList.add("header-products")
  document.querySelector('.header__btn').classList.add('hidden')

  slug.value = route.params.slug
  await getProduct()
})
</script>

<style>

</style>