import vue from "vue";
import VueRouter from "vue-router";

vue.use(VueRouter);

import Home from "./pages/Home";
import Abouts from "./pages/Abouts";
import Contacts from "./pages/Contacts";
import Posts from "./pages/Posts";
import SinglePost from "./pages/SinglePost";
import NotFound from "./pages/NotFound";

const router = new VueRouter({

    mode: "history",
    routes:[
        {
            path:"/",
            name: "home",
            component: Home
        },
        {
            path:"/chi-siamo",
            name: "abouts",
            component: Abouts
        },
        {
            path:"/contatti",
            name: "contacts",
            component: Contacts
        },
        {
            path:"/blog",
            name: "blog",
            component: Posts
        },
        {
            path:"/blog/:slug",
            name: "single-post",
            component: SinglePost
        },
        {
            path:"/*",
            name: "not-found",
            component: NotFound
        },
    ]
});

export default router;