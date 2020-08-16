export default {
    actions: {
        async fetchProducts(commit, page = 1) {
            const resp = await fetch('api/product/products?page='+page)
            const products = await resp.json()
            commit.commit('rewriteProducts', products)
        },

        async getProduct(commit, id) {
            const resp = await fetch('api/product/'+id)
            const products = await resp.json()
            commit.commit('rewriteProducts', products)
        },

        async deleteProduct(commit, id) {
            await axios({
                method: 'DELETE',
                url: '/product/'+id+'/delete',
            })
            commit.commit('deleteProducts', id)
        },

        async createProduct(commit, data) {
            this.errors = []
            commit.commit('rewriteSuccess', false)
            commit.commit('rewriteErrors', this.errors)
            await axios.post('/product/store', {
                name: data.name,
                description: data.description,
                cost:data.cost,
                count: data.count,
                category_id: data.category_id,
                external_id: data.external_id
            })
                .then(response => {
                    commit.commit('rewriteSuccess', true)
                })
                .catch((error) => {
                    if (error.response) {
                        const errors = error.response.data.errors
                        Object.keys(error.response.data.errors).map((key, index) => {
                            errors[key].forEach(element => {
                                this.errors.push(element)

                            })
                        })
                        commit.commit('rewriteErrors', this.errors)
                    }
                })
        }
    },
    mutations: {
        rewriteProducts(state, products) {
            state.products = products
        },
        deleteProducts(state, id){
            let index = state.products.products.data.findIndex(product => product.id === id)
            state.products.products.data.splice(index, 1)
        },
        rewriteErrors(state, errors) {
            state.errors = errors
        },
        rewriteSuccess(state, bool) {
            state.success = bool
        },
    },
    state: {
        products: [],
        errors: [],
        success: false,
    },
    getters: {
        allProducts(state) {
            return state.products
        },
        getErrorProduct(state) {
            return state.errors
        },
        getSuccessProduct(state) {
            return state.success
        }
    }
}
