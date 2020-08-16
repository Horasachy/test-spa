<template>
    <div class="container mb-4">
        <div class="row justify-content-md-center">
            <div class="col-10">
                <div class="card card-default">
                    <div class="alert alert-danger" role="alert" v-for="error in getErrorProduct" v-if="getErrorProduct.length > 0">
                        <strong>{{error}}</strong>
                    </div>

                    <div class="alert alert-success" role="alert" v-if="getSuccessProduct === true">
                        <strong>Product added successfully!</strong>
                    </div>

                    <div class="card-header">Create product</div>
                    <div class="card-body">
                        <form autocomplete="off" @submit.prevent="onCreateProduct" method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" v-model="name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" id="description" class="form-control" v-model="description">
                            </div>
                            <div class="form-group">
                                <label for="cost">Cost</label>
                                <input type="text" id="cost" class="form-control" v-model="cost">
                            </div>
                            <div class="form-group">
                                <label for="count">Count</label>
                                <input type="text" id="count" class="form-control" v-model="count">
                            </div>
                            <div class="form-group">
                                <label for="count">Categories</label>
                                <select  class="form-control" v-model="category_id">
                                    <option v-for="category in getAllCategories.categories" v-bind:value="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="count">External id</label>
                                <input type="text" id="external_id" class="form-control" v-model="external_id">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {mapActions, mapGetters} from 'vuex'
export default {
    data() {
        return {
            name: '',
            email: '',
            cost:'',
            count: '',
            description: '',
            category_id: '',
            external_id: '',
        }
    },

    computed : {
        ...mapGetters(["getAllCategories", "getErrorProduct", "getSuccessProduct"])
    },
    async mounted() {
        await this.fetchAllCategories()
    },

    methods: {
        onCreateProduct () {
            this.$store.dispatch('createProduct', this.$data)
        },
        ...mapActions(["fetchAllCategories"]),

    }
}
</script>
