<template>
    <footer class="container-fluid">
        <div class="row">
            <h1>footer</h1>
        </div>
    </footer>
</template>

<script>
    export default {
        name: "Footer",
    }
</script>

<style lang="scss">

    @import "./../../sass/_variables.scss";

    footer{
        background-color: $black;
        position: relative;
        bottom: 0;
        color: $white;       
    }
</style>