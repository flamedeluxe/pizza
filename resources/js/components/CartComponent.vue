<template>
    <div>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th></th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Remove</th>
                </tr>
                <tr v-if="emptyCart">
                    <td colspan="6">
                        Cart is empty, <router-link :to="`/`">buy pizza now!</router-link>
                    </td>
                </tr>
                <tr v-else v-for="item in cart" :key="item.id">
                    <td><img :src="item.image" width="80" alt=""></td>
                    <td>{{ item.name }}</td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button @click.prevent="minus(item)" type="button" class="btn btn-dark">-</button>
                            </div>
                            <input readonly style="max-width: 60px;background: #fff" type="number" :value="item.quantity" class="form-control">
                            <div class="input-group-append">
                                <button @click.prevent="plus(item)" type="button" class="btn btn-dark">+</button>
                            </div>
                        </div>
                    </td>
                    <td>{{ Math.round(item.price / rate) }} {{ currency }}</td>
                    <td>{{ Math.round(item.price / rate) * item.quantity }} {{ currency }}</td>
                    <td><button @click.prevent="remove(item)" type="button" class="btn btn-danger">&times;</button></td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td>
                        <b>Total:</b> {{ total }} {{ currency }}
                    </td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    import {quantity, remove} from "cart-localstorage";

    export default {
        props: {
            currency: String,
            cart: Object|Array,
            rate: String|Number
        },
        data: () => ({

        }),
        components: {
            remove, quantity
        },
        computed: {
            emptyCart: function () {
                return this.cart.length === 0
            },
            total: function () {
                let total = 0
                if(this.cart.length) this.cart.forEach(element => total += Math.round(element.price * element.quantity / this.rate))
                return total
            }
        },
        mounted() {

        },
        methods: {
            minus(item) {
                item.quantity--
                quantity(item.id, -1)
                this.remove(item.id)
            },
            plus(item) {
                item.quantity++
                quantity(item.id, +1)
            },
            remove(item) {
                remove(item.id)
                this.$emit('removeItem')
            }
        }
    }
</script>
