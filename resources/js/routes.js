import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from '@/js/components/Home.vue'
import Board from '@/js/components/Board.vue'

Vue.use(VueRouter)

const router = new VueRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/board',
            name: 'board',
            component: Board
        }
    ]
})

export default router;
