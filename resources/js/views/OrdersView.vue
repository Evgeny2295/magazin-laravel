<template>
  <div class="personal personal__credentials">
    <div class="container">
      <div class="col-12">
        <h1 class="section-title personal__title"></h1>
      </div>
      <div class="personal__content">
        <div class="personal__sidebar">
          <table class="personal__sidebar-table">
            <tr class="personal__sidebar-table-row">
              <td class="personal__sidebar-table-column">
                <li class="personal__sidebar-table-item">
                  <a href="/orders" class="personal__sidebar-link">Заказы</a>
                </li>
              </td>
            </tr>
            <tr class="personal__sidebar-table-row">
              <td class="personal__sidebar-table-column">
                <li class="personal__sidebar-table-item">
                  <router-link :to="{name:'Personal'}" class="personal__sidebar-link">Личный кабинет</router-link>
                </li>
              </td>
            </tr>
            <tr class="personal__sidebar-table-row">
              <td class="personal__sidebar-table-column">
                <li class="personal__sidebar-table-item">
                  <a href="/personal/logout" class="personal__sidebar-link">Выйти</a>
                </li>
              </td>
            </tr>
          </table>
        </div>
        <table class="table">
          <thead>
          <tr>
            <th scope="col">№ заказа</th>
            <th scope="col">Дата заказа</th>
            <th scope="col">Количество товара</th>
            <th scope="col">Сумма</th>
            <th scope="col">Статус</th>
            <th scope="col">Действие</th>
          </tr>
          </thead>
          <tbody v-for="order in orders" :key="order.id">
          <tr>
            <th scope="row">{{order.id}}</th>
            <td>{{order.created_at}}</td>
            <td>{{order.qty}}</td>
            <td>{{ order.total}}</td>
            <td>{{order.status != 0 ? 'Обработан' : 'Не обработан'}}</td>
            <td><i @click="showOrder(order.id)" class="fas fa-arrow-down"></i></td>
          </tr>
          <tr v-if="orderShow == order.id">
            <th scope="col">Наименование</th>
            <th scope="col">Цена</th>
            <th scope="col">Количество продукта</th>
            <th scope="col">Стоимость</th>
            <th></th>
            <th></th>
          </tr>
          <tr v-if="orderShow == order.id" v-for="orderProduct in order.orderProducts" :key="order.id">
            <td>{{orderProduct.title}}</td>
            <td>{{orderProduct.price}}</td>
            <td>{{orderProduct.qty}}</td>
            <td>{{orderProduct.sum}}</td>
            <td></td>
            <td></td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>

import {onMounted, ref} from "vue";
import api from "@/api.js";

const orders = ref([])
const orderShow = ref(false)

const getOrders = async ()=>{
  const {data} =  await api.value.get("http://127.0.0.1:8881/api/auth/orders")
  orders.value = data
}

const showOrder = (id)=>{
  if(orderShow.value == false){
    orderShow.value = id
  }else if(orderShow.value !== id){
    orderShow.value = id
  }else{
    orderShow.value = false
  }
}

onMounted(()=>{
  document.querySelector('.header').classList.add("header-products")
  document.querySelector('.header__btn').classList.add('hidden')

  getOrders()
})

</script>

<style scoped>

</style>