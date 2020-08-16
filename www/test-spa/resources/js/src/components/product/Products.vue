<template>
    <div>
        <div class="container">
            <form-product></form-product>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col" class="th-table">Category</th>
                    <th scope="col">Cost</th>
                    <th scope="col">Count</th>
                    <th scope="col" class="th-table">External id</th>
                    <th scope="col">Create at</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody v-for="product in allProducts.products.data" :key="product.id">
                    <tr>
                        <th scope="row">{{ product.id }}</th>
                        <td>{{ product.name }}</td>
                        <td class="wrap">{{ product.description }}</td>
                        <td>{{ product.category.name }}</td>
                        <td>{{ product.cost }}</td>
                        <td>{{ product.count }}</td>
                        <td>{{ product.external_id }}</td>
                        <td>{{ product.created_at }}</td>
                        <td><button @click="deleteProduct(product.id)">Delete</button></td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <pagination :data="allProducts.products" @pagination-change-page="fetchProducts"></pagination>
            </div>

        </div>
    </div>
</template>

<script>
import FormProduct from "./FormProduct";
import { mapGetters, mapActions } from 'vuex'
export default {
    components: {FormProduct},
    computed : mapGetters(["allProducts"]),
    methods: mapActions(["fetchProducts", "deleteProduct"]),
    async mounted() {
        await this.fetchProducts()
        console.log(errors)
    },
}
</script>

<style scoped>
    .th-table {
        width: 10%
    }
</style>
