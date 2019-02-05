<template>
    <div id="app">
        <franzl-navigation></franzl-navigation>
        <router-view/>
    </div>
</template>

<script>
    import FranzlNavigation from './components/FranzlNavigation'
    import axios from 'axios';
    /*
    axios.interceptors.response.use(undefined, function (error) {
        console.log('nono', error, error.request, error.config);
        if(error.response.status === 401) {
            return Promise.reject(error);
        }
    });
    */
    export default {
        components: {
            FranzlNavigation
        },
        created() {
            axios.interceptors.response.use(this.onServerResponse, this.onServerResponseError)
            axios.interceptors.request.use(this.onServerRequest);
            if (!localStorage.getItem('token')){
                this.$router.push('/login');
            }
        },
        methods:{
            onServerRequest(options){
                console.log('request options', options);
                const token = localStorage.getItem('token');
                if(token){
                    options.headers['Authorization'] = 'Bearer '+ token
                }
                return options;
            },
            onServerResponse(response){
                console.log('response', response);
                return response;
            },
            onServerResponseError(error) {
                const request = error.response || error.request;
                if (request.status === 401){
                    localStorage.removeItem('token')
                    this.$router.push('/login')
                }
                return Promise.reject(error);
            }
        }
    }
</script>
<style lang="scss">
    /*
    body {
        background-color:#000 !important;
        color:#fff !important;
    }
    a {
        text-decoration: none;
        color:#fff !important;
    }
    */
    #app {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
    }

</style>
