import Vue from "vue"
import Vuex from "vuex"
import product from "./modules/product"
import category from "./modules/category"

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        product,
        category
    }
})
