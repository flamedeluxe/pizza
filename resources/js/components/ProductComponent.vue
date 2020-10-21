<template>
    <div class="col-md-4">
        <div class="card mb-4 box-shadow">
            <img class="card-img-top" :alt="product.title" style="height: 225px; width: 100%; display: block;"
                 :src="product.image"
                 data-holder-rendered="true">
            <div class="card-body">
                <p class="card-title">{{ product.title }}</p>
                <p class="card-text">{{ product.text }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary">
                            <span class="material-icons">shopping_basket</span>
                        </button>
                    </div>
                    <small class="text-muted">{{ product.count }} items</small>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            products: Object
        },
        data () {
            return {

            }
        },
        mounted() {

        }
    }
</script>
