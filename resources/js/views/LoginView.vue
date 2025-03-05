<template>
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-light p-2">
        <li class="breadcrumb-item"><router-link :to="{name: 'Main'}" class="text-black-50"><i class="fas fa-home"></i>Главная</router-link></li>
      </ol>
    </nav>
  </div>
  <div class="container py-3">
    <div class="row">
      <div class="col-lg-12 category-content">
        <h2 class="errors"></h2>
        <h1 class="title section-title"></h1>
        <form class="row g-3" method="post">
          <div class="col-md-6 offset-md-3">
            <div class="form-floating mb-3" >
              <input v-model="email" type="email" name="email" class="form-control" placeholder="Введите email">
              <label style="color: #282828" class="required" for="email">Введите email</label>
            </div>
          </div>
          <div class="col-md-6 offset-md-3">
            <div class="form-floating mb-3">
              <input v-model="password" type="password" name="password" class="form-control" placeholder="password">
              <label style="color: #282828" class="required" for="password">Введите имя</label>
            </div>
          </div>
          <div class="col-md-6 offset-md-3">
            <button @click="login()" type="button" class="btn btn-danger">Войти</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>

import {onMounted,ref} from "vue";
import axios from "axios";
import {router} from "@/router/router.js";

const email = ref('')
const password = ref('')

const login = async ()=> {
  try{
    const {data} = await axios.post('http://127.0.0.1:8881/api/auth/login',{email:email.value,password:password.value})
    localStorage.access_token = data.access_token
    router.push({name:'Personal'})
  }catch(e){
    console.log(e)
  }
}

onMounted(async()=>{
  document.querySelector('.header').classList.add("header-products")
  document.querySelector('.header__btn').classList.add('hidden')
})

</script>

<style scoped>

</style>