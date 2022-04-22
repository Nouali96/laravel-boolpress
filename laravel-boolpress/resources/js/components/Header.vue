<template>
    <header class="container-fluid">
            <nav class="navbar navbar-expand navbar-light bg-light">

                <router-link class="navbar-brand" :to="{name: 'home'}">Boolpress</router-link>
            
                <ul class="navbar-nav mr-auto">

                    <li class="nav-item active" v-for="itemMenu in navMenu" :key="itemMenu.routeName">
                        <router-link class="nav-link" :to="{name: itemMenu.routeName}">{{itemMenu.label}}</router-link>
                    </li>

                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/home">Area Admin</a>
                    </li>
                </ul>
              

            </nav>
    </header>
</template>

<script>
    export default {
        name: "Header",

        data(){
            return{
                navMenu: [
                    {
                        routeName: "home",
                        label: "Home"
                    },
                    {
                        routeName: "abouts",
                        label: "Chi siamo"
                    },
                    {
                        routeName: "contacts",
                        label: "Contattaci"
                    },
                    {
                        routeName: "blog",
                        label: "Blog"
                    },
                ]
            }
        }
    }
</script>

<style lang="scss">

    nav ul .active .router-link-exact-active{
        font-weight: bold;
        text-decoration: underline;
        font-size: 1rem;
    }

</style>