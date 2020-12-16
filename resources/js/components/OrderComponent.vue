<template>
    <div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>قیمت</th>
                        <th>وضعیت</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!--                    @foreach($orders as $order)-->
                    <!--                    <tr>-->
                    <!--                                            <td><a href="{{route('orders.list' , $order->id)}}">{{$order->id}}</a></td>-->
                    <!--                                            <td>{{$order->amount}}</td>-->
                    <!--                                            @if($order->status == 1)-->
                    <!--                                            <td><span class="label label-success ">فعال</span></td>-->
                    <!--                                            @else-->
                    <!--                                            <td><span class="label label-danger ">غیر فعال</span></td>-->
                    <!--                                            @endif-->
                    <!--                    </tr>-->
                    <!--                    @endforeach-->

                    <tr v-for="order in orders">
                        <td><a>{{order.id}}</a></td>
                        <td>{{order.amount}}</td>
                        <td v-if="order.status == 1"><span class="label label-success ">فعال</span></td>
                        <td v-if="order.status == 0"><span class="label label-danger ">غیر فعال</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                orders: [],
            }
        },
        mounted() {
            axios.get('/api/orders').then(
                res => {
                    this.orders = res.data.order;
                }
            ).catch(err => {
                console.log(err)
            })
        },
        methods: {
        }
    }
</script>
