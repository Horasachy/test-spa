export default {
    actions: {
        async fetchCategories(commit, page = 1) {
            const resp = await fetch('api/category/categories?page='+page)
            const categories = await resp.json()
            commit.commit('rewriteCategories', categories)
        },

        async fetchAllCategories(commit) {
            const resp = await fetch('api/category/all')
            const categories = await resp.json()
            commit.commit('rewriteAllCategories', categories)
        },

        async getCategory(commit, id) {
            const resp = await fetch('category/'+id)
            const category= await resp.json()
            commit.commit('rewriteCategories', category)
        },

        async deleteCategory(commit, id) {
            await axios({
                method: 'DELETE',
                url: '/category/'+id+'/delete',
            })
            commit.commit('deleteCategory', id)
        },

        async createCategory(commit, data) {
            this.errors = []
            commit.commit('rewriteSuccess', false)
            commit.commit('rewriteErrors', this.errors)
            await axios.post('/category/store', {
                name: data.name,
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
        rewriteCategories(state, categories) {
            state.categories = categories
        },
        rewriteAllCategories(state, categories) {
            state.all = categories
        },
        deleteCategory(state, id){
            let index = state.categories.categories.data.findIndex(category => category.id === id)
            state.categories.categories.data.splice(index, 1)
        },
        rewriteErrors(state, errors) {
            state.errors = errors
        },
        rewriteSuccess(state, bool) {
            state.success = bool
        },
    },
    state: {
        categories: [],
        all: [],
        errors: [],
        success: false,
    },
    getters: {
        allCategories(state) {
            return state.categories
        },
        getAllCategories(state) {
            return state.all
        }
    }
}
