<template>
    <div class="col-md-4">
        <div class="card mb-4 box-shadow">
            <img class="card-img-top" :alt="product.title" style="height: 225px; width: 100%; display: block;"
                 :src="product.image"
                 data-holder-rendered="true">
            <div class="card-body">
                <p class="card-title">{{ product.title }}</p>
                <p class="card-text">{{ product.content }}</p>
                <div class="d-flex justify-content-between align-items-center">

                    <big>
                        {{ price }} {{ currency }}
                    </big>
                    <div class="btn-group">
                        <button @click="addToCart" type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-shopping-basket"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {add, total} from "cart-localstorage";

    export default {
        props: {
            product: Object,
            currency: String
        },
        data: () => ({
            count: 0,
            price: 0
        }),
        mounted() {
            this.updatePrice()
        },
        components: {

        },
        watch: {
            currency: function () {
                this.updatePrice()
            }
        },
        methods: {
            async addToCart() {
                this.count++

                const p = {
                    id: this.product.id,
                    name: this.product.title,
                    price: this.product.price,
                    image: this.product.image,
                }

                add(p, 1)

                this.$toast.success('Product added to cart');

                this.$emit('updateCart')
            },
            updatePrice() {
                this.price = Math.round(this.product.price / localStorage.getItem('__rate'))
            }
        }
    }
</script>
