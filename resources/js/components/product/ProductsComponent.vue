<template>
  <div class="d-flex gap-3">
    <ProductComponent
        v-for="product in products"
        :key="product.id"
        :product = "product"
        :is-added="product.isAdded"
        :change-like="()=>emit('changeLike',product.id)"
        @add-to-cart="(qty)=>emit('addToCart',[product,qty])"
        :remove-from-cart="()=>emit('removeFromCart',product)"
    />
  </div>
</template>

<script setup>
  import ProductComponent from "@/components/product/ProductComponent.vue";

  defineProps({
    products: Array
  })

  const emit = defineEmits(['changeLike','addToCart','removeFromCart','onChangeQty'])

</script>

<style>

</style>