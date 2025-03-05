import { createWebHistory, createRouter } from 'vue-router'

import {routes} from './routes.js'
import store from "@/store.js";
export const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

router.beforeEach((to,from,next)=>{

    const  accessToken = localStorage.access_token

    if(store.getters.SEARCH_ICON_STATE == false){
        store.dispatch('TOGGLE_SEARCH')
    }

    store.dispatch('TOGGLE_CATALOG_CLOSE')

    if(!accessToken){
        if(to.name === 'Login' || to.name==='Signup'){
            return next()
        }else if (to.name === 'Personal' || to.name === 'Wishlist'){
            return next({name:'Login'})
        }
    }

    if(to.name == 'Login' || to.name == 'Signup' && accessToken ){
        return next({name:'Personal'})

    }
    next()
})