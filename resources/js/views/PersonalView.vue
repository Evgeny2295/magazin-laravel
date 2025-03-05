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
                  <router-link :to="{name:'Order'}" class="personal__sidebar-link">Заказы</router-link>
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
                  <router-link :to = "{name:'Main'}" class="personal__sidebar-link">Выйти</router-link>
                </li>
              </td>
            </tr>
          </table>
        </div>
        <div v-if="user" class="personal__user-credentials">
          <div class="col-md-9 order-md-1">
            <div class="table-responsive">
              <table class="table text-start table-bordered border-dark credential__table">
                <tbody>
                <tr>
                  <th>Email</th>
                  <th v-if="!updation">{{ user.email }}</th>
                  <th v-else><input type="email" v-model="email" :placeholder=user.email></th>
                </tr>
                <tr>
                  <th>Имя</th>
                  <th v-if="!updation">{{ user.name }}</th>
                  <th v-else><input type="text" v-model="name" :placeholder="user.name"></th>
                </tr>
                <tr class="credential__table-col">
                  <th v-if="!updation"  colspan="2"><button type="button"  class="credential__table-link" @click="updateUser()">Внести изменения</button></th>
                  <th v-else  colspan="2"><button class="credential__table-link" type="button" @click="storeUser()">Сохранить изменения</button></th>
                </tr>
                </tbody>
              </table>
            </div>
            <h3 class="personal__orders-title"></h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

import {onMounted, ref, watch} from "vue";
import {useRoute} from "vue-router";
import api from "@/api.js";

const user = ref([])
const route = useRoute()
const updation = ref(false)
const message = ref('')
const email = ref('')
const name=ref('')

const getPersonal = async ()=>{
  try{
    const {data} = await api.value.get('http://127.0.0.1:8881/api/auth/personal')
    user.value = data
  }catch(e){

  }
}
const updateUser = async()=>{
  updation.value = true
}

const storeUser = async()=>{
  try {
    const {data} = await api.value.patch('http://127.0.0.1:8881/api/auth/personal',{email:email.value,name:name.value})
    if(data){
      message.value = 'Данные успешно обновлены'
      updation.value(false)
    }
  }catch(e){
    console.log(e)
  }
}

onMounted(async ()=>{

  await getPersonal()
  document.querySelector('.header').classList.add("header-products")
  document.querySelector('.header__btn').classList.add('hidden')

})

watch(route,()=>{
  message.value=''
})

</script>

<style scoped>

</style>