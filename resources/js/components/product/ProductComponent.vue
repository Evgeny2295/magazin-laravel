<template>
  <div class="main__content">
    <div class="main__goods">
      <div class="main__product">
        <router-link :to="{name:'Product',params:{slug:product.slug}}" class="main__product-link">
          <img src="" class="main__product-img" alt="">
          <div class="main__product-wishlist">
            <a @click.prevent="changeLike(product.id)" class="main__product-wishlist-add-link"><span>{{product.countLikes}}</span>
              <i v-if="product.isFavorite" class="fas fa-heart"></i>
              <i v-else class="far fa-heart"></i>
            </a>
          </div>
          <h2 class="main__product-title"></h2>
        </router-link>
        <div class="main__product-description">
          <p class="main__product-description-text"><span class="main__product-text main__product-text--bold">Градусы: </span>{{product.strength}} %</p>
          <p class="main__product-description-text"><span class="main__product-text main__product-text--bold">Объем: </span>{{product.capacity}} л</p>
          <p class="main__product-description-text"><span class="main__product-text main__product-text--bold">Страна: </span>{{product.country}}</p>
        </div>
        <div class="main__product-rating">
          <div class="main__product-rating-price">
            <span class="main__product-text main__product-text--bold">Новая цена: </span> {{product.price}} Р
          </div>
          <div class="main__product-rating-price">
            <span class="main__product-text main__product-text--bold">Старая цена: </span>
            <del>{{product.old_price}} Р</del>
          </div>
          <div class="main__product-rating-stars"></div>
        </div>
        <div class="main__product-cart">
          <div class="main__product-qty">
            <label for="main__product-input-qtu"><span class="main__product-text--bold">Выберите количество</span></label>
            <input class="main__product-input-qty" style="color: #1a1e21" type="number" v-model="qty">
          </div>
          <div class="main__product-addtocart">
            <button v-if="!product.isAdded" @click="$emit('addToCart',qty)" type="button" class="main__product-addtocart-link" data-id="">
              В корзину <i class="fas fa-cart-plus"></i>
            </button>
            <button v-else @click="removeFromCart" type="button" class="main__product-addtocart-link" data-id="">
              Из корзины <i class="fas fa-cart-plus"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import {defineProps, ref} from "vue";
import {useRoute} from "vue-router";

defineProps({
  product: Object,
  isAdded:Boolean,
  changeLike: Function,
  removeFromCart: Function
})
defineEmits(["addToCart"])

const route = useRoute()
const cart = ref([])
const id = route.params.id
const qty = ref(1)

</script>

<style>

</style>