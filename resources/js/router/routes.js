export const routes = [{
        name: 'Main',
        path: '/',
        component: ()=>import('@/views/MainView.vue')
    },
    {
        name: 'SearchProduct',
        path: '/products',
        component: ()=>import('@/views/SearchProductView.vue')
    },
    {
        name: 'Categories',
        path: '/categories/:id/products',
        component: ()=>import('@/views/CategoryView.vue')
    },
    {
        name: 'Login',
        path: '/user/login',
        component: ()=>import('@/views/LoginView.vue')
    },
    {
        name: 'Signup',
        path: '/user/signup',
        component: ()=>import('@/views/SignUpView.vue')
    },
    {
        name: 'Personal',
        path: '/personal',
        component: ()=>import('@/views/PersonalView.vue')
    },
    {
        name: 'Product',
        path: '/product/:slug',
        component: ()=>import('@/views/ProductView.vue')
    },
    {
        name: 'Wishlist',
        path: '/wishlist',
        component: ()=>import('@/views/WishListView.vue')
    },
    {
        name: 'Cart',
        path: '/cart',
        component: ()=>import('@/views/CartView.vue')
    },
    {
        name: 'Order',
        path: '/orders',
        component: ()=>import('@/views/OrdersView.vue')
    },
    {
        name: 'Delivery',
        path: '/delivery',
        component: ()=>import('@/views/DeliveryView.vue')
    },
    {
        name: 'Collections',
        path: '/collections',
        component: ()=>import('@/views/CollectionsView.vue')
    },
    {
        name: 'Contacts',
        path: '/contacts',
        component: ()=>import('@/views/ContactsView.vue')
    },

]