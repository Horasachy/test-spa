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
                    <div class="card-header">Create category</div>
                    <div class="card-body">
                        <form autocomplete="off" @submit.prevent="onCreateProduct" method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" v-model="name">
                            </div>
                            <div class="form-group">
                                <label for="external_id">External id</label>
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
            external_id: '',
        }
    },
    computed : {
        ...mapGetters(["getErrorProduct", "getSuccessProduct"])
    },
    methods: {
        onCreateProduct () {
            this.$store.dispatch('createCategory', this.$data);
        }
    }
}
</script>
