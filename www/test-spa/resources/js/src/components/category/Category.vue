<template>
    <div>
        <form-category></form-category>
        <div class="container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">External id</th>
                    <th scope="col">Create at</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody v-for="category in allCategories.categories.data" :key="category.id">
                    <tr>
                        <th scope="row">{{ category.id }}</th>
                        <td>{{ category.name }}</td>
                        <td>{{ category.external_id }}</td>
                        <td>{{ category.created_at }}</td>
                        <td><button @click="deleteCategory(category.id)">Delete</button></td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <pagination :data="allCategories.categories" @pagination-change-page="fetchCategories"></pagination>
            </div>

        </div>
    </div>
</template>

<script>
import FormCategory from "./FormCategory";
import { mapGetters, mapActions } from 'vuex'
export default {
    components: {FormCategory},
    computed : mapGetters(["allCategories"]),
    methods: mapActions(["fetchCategories", "deleteCategory"]),
    async mounted() {
        await this.fetchCategories()
    },
}
</script>

<style scoped>

</style>
