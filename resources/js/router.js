import Vue from 'vue'
import VueRouter from 'vue-router'

import Checkout from './views/layout/CheckoutPage.vue'
import Inquiry from './views/layout/InquiryPage.vue'
import Cancel from './views/layout/CancelPage.vue'
import Result from './views/result/ResultPage.vue'
import OtherError from './views/result/OtherError.vue'

Vue.use(VueRouter)

export default {
    mode: 'history',
    routes: [

        {
            path: '/checkout',
            name: 'checkout',
            component: Checkout
        },
        {
            path: '/inquiry',
            name: 'inquiry',
            component: Inquiry
        },
        {
            path: '/cancel',
            name: 'cancel',
            component: Cancel
        },
        {
            path: '/result',
            name: 'result',
            component: Result
        },
        {
            path: '/otherError',
            name: 'otherError',
            component: OtherError
        },
        {
            path: '*',
            redirect: '/checkout',
            // name: 'checkout',
            // component: Checkout
        }
    ],
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active"
}