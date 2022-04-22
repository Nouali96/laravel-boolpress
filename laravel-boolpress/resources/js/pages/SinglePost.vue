<template>
    <div class="container">
        <div class="row row-cols-2">

            <div class="col">

               <div v-if="post">

                    <h1>{{post.title}}</h1>
                    <h2 v-if="post.category">{{post.category.name}}</h2>
                    <p>{{post.content}}</p>
    
                    <div v-if="post.tags.length > 0">
                        <ul class="p-0">
                            <li class="badge badge-pill badge-primary ms_badge" :style="mJS_backgroundColor()" v-for="tag in post.tags" :key="tag.id">
                                {{tag.name}}
                            </li>
                        </ul>
                    </div>

                    <router-link class="btn btn-primary my-3" :to="{name: 'blog'}">Torna ai posts</router-link>

                </div>

            </div>

            <div class="col">
                <div v-if="post" class="img_post">
                    <img :src="post.cover" :alt="'img' + post.title">
                </div>
            </div>

        </div>

        
        <h4 class="font-italic mt-5 mb-3">Post simili</h4>
        <div class="row mb-5">

            <div class="col card-group" v-for="post in similarPosts" :key="post.id">
                
                <Post
                        
                    :title="post.title"
                    :category="post.category"
                    :content="post.content"
                    :slug="post.slug"
                    :img="post.cover"
                
                />

            </div>
        </div>

        
        

    </div>
</template>

<script>

    import Post from "./../components/partials/Post";
    
    import * as functionJS from "./../functionsJS/getRandomColor.js";

    export default {
        name: "SinglePost",

        components:{
            Post 
        },

        data(){
            return{
                post: null,
                similarPosts: null
            }
        },

        mounted(){
            const $slug = this.$route.params.slug;

            axios.get(`/api/posts/${$slug}`)
            .then(response => {
                if(response.data.success == true){
                    this.post = response.data.showPost;
                    this.similarPosts = response.data.similarPosts;
                }else{
                    this.$route.push({name: "not-found"});
                }
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            });
             
        },

        methods:{
            mJS_backgroundColor(){

                const randomColor = functionJS.getRandomColor();

                return `background-color: ${randomColor}`;
            }
        }

    }
</script>

<style lang="scss" scoped>

    div.container{
        min-height: 80vh;
    }

    .img_post img{
        height: 30rem;
        width: 30rem;
        object-fit: cover;
    }

   
    .ms_badge{
        font-size: 0.8rem;
        margin-right: 1rem;
    }
    
    
</style>