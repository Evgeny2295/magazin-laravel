<template>
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-light p-2">
        <li class="breadcrumb-item"><router-link :to="{name: 'Main'}" class="text-black-50"><i class="fas fa-home"></i>Главная</router-link></li>
      </ol>
    </nav>
  </div>
  <h2 style="color:#282828"></h2>

  <div class="container py-3">
    <div class="row">

      <div class="col-lg-12 category-content">
        <h1 class="section-title"></h1>

        <form class="row g-3" method="post">

          <div class="col-md-6 offset-md-3">
            <div class="form-floating mb-3">
              <input v-model="name" type="text" name="name" class="form-control" id="name" value="" placeholder="Name">
              <label style="color: #282828" class="required" for="name">Введите имя</label>
            </div>
          </div>

          <div class="col-md-6 offset-md-3">
            <div class="form-floating mb-3">
              <input v-model="email" type="email" name="email" class="form-control" id="email" value="" placeholder="name@example.com">
              <label style="color: #282828" class="required" for="email">Введите e-mail</label>
            </div>
          </div>

          <div class="col-md-6 offset-md-3">
            <div class="form-floating mb-3">
              <input v-model="password" type="password" name="password" class="form-control" id="password" placeholder="password">
              <label style="color: #282828" class="required" for="password">Введите пароль</label>
            </div>
          </div>
          <div class="col-md-6 offset-md-3">
            <div class="form-floating mb-3">
              <input v-model="password_confirmation" type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="password">
              <label style="color: #282828" class="required" for="confirm_password">Повторите пароль</label>
            </div>
          </div>
          <div class="col-md-6 offset-md-3">
            <button @click="storeUser" type="button" class="btn btn-danger">Добавить</button>
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
import store from "@/store.js";

const name = ref('')
const email = ref('')
const password = ref('')
const password_confirmation = ref('')

const storeUser = async () => {
  try{
    const {data} = await axios.post('http://localhost:8881/api/users',
{
        name:name.value,
        email:email.value,
        password:password.value,
        password_confirmation:password_confirmation.value
    })
    console.log(data.value)
    localStorage.access_token = data.access_token
    store.dispatch('TOGGLE_WISHLIST_OPEN')
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