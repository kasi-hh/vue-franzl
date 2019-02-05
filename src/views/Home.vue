<template>
    <div class="home">
        <h1>Franzl</h1>
        <figure v-for="item in items">
            <img alt="" :src="item.href"></img>
            <figcaption>{{item.title}}</figcaption>
        </figure>
    </div>
</template>

<script>

    import axios from 'axios';

    export default {
        name: 'home',
        data() {
            return {
                items:[]
            }
        },
        components: {},
        mounted() {
            axios.get('/api/image/list').then((response)=>{
                const result = response.data;
                if(result.success){
                    this.items = result.data;
                }
            });
        }
    }
</script>
