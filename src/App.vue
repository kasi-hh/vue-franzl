<template>
    <div id="app">
        <franzl-navigation></franzl-navigation>
        <router-view/>
    </div>
</template>

<script>
    import FranzlNavigation from './components/FranzlNavigation'

    export default {
        components: {
            FranzlNavigation
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
