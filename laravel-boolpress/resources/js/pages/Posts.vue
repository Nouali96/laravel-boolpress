<template>
        <div class="container">

            <div class="row">
                <h1 class="my-3">Elenco dei post</h1>
            </div>
            
             <div class="row row-cols-4">
                <div class="col-4 my-3 card-group" v-for="post in posts" :key="post.id">

                    <Post
                        
                        :title="post.title"
                        :category="post.category"
                        :content="post.content"
                        :slug="post.slug"
                        :img="post.cover"
                    
                    />

                </div>
            </div>

            <div class="row justify-content-center my-5">

                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">

                        <li class="page-item" :class="(currentPage == 1) ? 'disabled' : '' ">
                            <span class="page-link" @click="getPosts(currentPage -1)">&lt;&lt;&lt;&lt;</span>
                        </li>

                        <li class="page-item" @click="mJS_selectedPage(page)" :class="(page == currentPage) ? 'active' : ''" v-for="page in lastPage" :key="page">
                            <span class="page-link">{{page}}</span>
                        </li>

                        <li class="page-item" :class="(currentPage == lastPage) ? 'disabled' : '' ">
                            <span class="page-link" @click="getPosts(currentPage +1)">&gt;&gt;&gt;&gt;</span>
                        </li>
                    </ul>
                </nav>

            </div>

        </div>
</template>

<script>

    import Post from "./../components/partials/Post";

    export default {
        name: "Posts",

        components: {
            Post
        },

        mounted(){
            this.getPosts(1);
        },

        data() {
            return {
                posts: [],
                currentPage: 1,
                lastPage: null
            };
        },

        methods:{

            getPosts(RequestpPage){
                axios.get('/api/posts', {
                    "params": {
                        "page":RequestpPage
                    }
                })
                    .then(response => {
                        // handle success
                        this.currentPage = response.data.results.current_page;
                        this.posts = response.data.results.data;
                        this.lastPage = response.data.results.last_page;
                    })
                    .catch(error => {
                        // handle error
                        console.log(error);
                    })

            },

            mJS_selectedPage(selectedPage){
                this.currentPage = selectedPage;
                this.getPosts(this.currentPage);
            }
            
        },

    
    }
</script>

<style scoped>

    div.container{
        min-height: 80vh;
    }

</style>