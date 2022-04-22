<template>

    <div class="card">
        <div class="card-body">
            <h2 class="card-title font-weight-bold">{{title}}</h2>
            <h5 class="card-text">{{ category ? category.name : ''}}</h5>
            <p class="card-text font-italic ms_height">{{truncateStr(content)}}</p>

            <img :src="img" :alt="'img ' + title">

            <div class="d-flex justify-content-center my-4">
                <router-link class="btn btn-primary ms_btn" :to="{name: 'single-post', params: {slug: slug}}">Vai al post</router-link>
            </div>
         
        </div>
    </div>

</template>

<script>
    export default {
        name: "Post",

        props:{
            "title": String,
            "content": String,
            "category": Object,
            "slug": String,
            "img": String
        },

        methods:{
            truncateStr(str){

                let stringCharacters = 50;

                if(str.length > stringCharacters){

                    while(str[stringCharacters] != " " &&  str.length > stringCharacters ){
                        stringCharacters++;
                    }

                    str = str.substring(0, stringCharacters) + "...";
                }

                return str;
            }
        }


    }
</script>

<style lang="scss" scoped>

    .card{
       
       .ms_height{
           min-height: 3rem;
       }

        img{
            width:100%;
            height: 10rem;
            object-fit: cover;
        }
        
        
    }
</style>