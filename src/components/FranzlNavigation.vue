<template>
    <b-navbar toggleable="md" type="dark" variant="light">

        <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

        <b-navbar-brand to="/">Franzl</b-navbar-brand>

        <b-collapse is-nav id="nav_collapse">
            <b-navbar-nav>
                <b-nav-item to="/add">Neues Bild</b-nav-item>
            </b-navbar-nav>

            <!-- Right aligned nav items -->
            <b-navbar-nav class="ml-auto">

            </b-navbar-nav>

        </b-collapse>
    </b-navbar>
</template>

<script>
    export default {
        name: "FranzlNavigation"
    }
</script>

<style scoped>

</style>