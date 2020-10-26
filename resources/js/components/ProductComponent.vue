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
                        <button v-if="!inCart" @click="plus" type="button" class="btn btn-md btn-outline-secondary">
                            <i class="fas fa-shopping-basket"></i>
                        </button>
                        <button v-if="inCart" @click="minus" type="button" class="btn btn-md btn-dark">
                            -
                        </button>
                        <input v-if="inCart" type="number" style="width:70px" readonly v-model="count" class="form-control">
                        <button v-if="inCart" @click="plus" type="button" class="btn btn-md btn-dark">
                            +
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {add, quantity, remove} from "cart-localstorage";

    export default {
        props: {
            product: Object,
            currency: String
        },
        data: () => ({
            count: 0,
            price: 0,
            inCart: false
        }),
        mounted() {
            this.updatePrice()
            this.checkInCart()
        },
        components: {

        },
        watch: {
            currency: function () {
                this.updatePrice()
            }
        },
        methods: {
            async checkInCart() {
                if(localStorage.getItem('__cart') === null) return false

                const cart = JSON.parse(localStorage.getItem('__cart'))

                let found = false
                cart.forEach((element) => {
                    if(element.id === this.product.id) {
                        found = true
                        this.count = element.quantity
                    }
                })

                this.inCart = found
            },
            async minus() {
                if(this.count > 0) {
                    this.count--
                    quantity(this.product.id, -1)
                }else {
                    remove(this.product.id)
                }

                this.$toast.success('Product removed from cart');

                this.$emit('removeItem')
                this.$emit('updateCart')

                this.checkInCart()
            },
            async plus() {
                this.count++

                const p = {
                    id: this.product.id,
                    name: this.product.title,
                    price: this.product.price,
                    image: this.product.image,
                }

                add(p, 1)

                this.checkInCart()

                this.$toast.success('Product added to cart');

                this.$emit('updateCart')
            },
            updatePrice() {
                this.price = Math.round(this.product.price / localStorage.getItem('__rate'))
            }
        }
    }
</script>
