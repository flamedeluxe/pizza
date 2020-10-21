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
                <tr v-for="item in cart" :key="item.id">
                    <td></td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.quantity }}</td>
                    <td>{{ Math.round(item.price / rate) }} {{ currency }}</td>
                    <td>{{ Math.round(item.price / rate) * item.quantity }} {{ currency }}</td>
                    <td><button type="button" class="btn btn-danger">&times;</button></td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            currency: String,
            cart: Object|Array,
            rate: String|Number
        },
        data: () => ({

        }),
        computed: {

        },
        mounted() {

        },
        methods: {

        }
    }
</script>
