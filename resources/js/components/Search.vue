<template>
    <div>
        <input v-model="message" @keyup="send" placeholder="Search" class="d-none d-md-block searchInput" type="text">

        <ul class="searchResults">
            <li v-bind:key="key" v-for="(post, key) in indexPosts" ><a :href="'../profile/'+post.profile.id"><img class="rounded-circle" :src=" '../storage/'+post.profile.image " alt=""><span style="font-weight:600" >{{ post.name }}</span>{{ post.posts_count.length }} posts<span></span></a></li>
        </ul>
    </div>
</template>

<script>
    export default {
        // props: ['userId','follows'],

        mounted() {

        },
        data: function() {
            return {
                message: '',
                indexPosts: [],
            }
        },
        methods:{
              send(){
            if(this.message != ''){
            axios.get('/search/'+this.message)
            .then(res => {
                this.indexPosts = res.data;
            })
            .catch(err => {
                console.error(err);
            })
              }else{
                this.indexPosts = [];
              }
        }
        },
        computed:{

        },
    }
</script>
