<template>
    <div>

      <div class="row">

    <div v-bind:key="key" v-for="(post, key) in indexPosts" class="col-s12 col-md-4 mt-4">
       <div style="position:relative"> <a :href="'/p/'+post.id"><img :src="'../storage/'+post.image" class="w-100" alt="">
                      <div class="containericonpos">
           <div class="lefticonpost"><span class="font-weight-bold pr-1"><i :class="{ 'text-danger': post.likesuser }" class="material-icons">favorite</i></span>{{ post.likes.length }}</div>
            <div class="righticonpost"><span class="font-weight-bold pr-1"><i class="material-icons">mode_comment</i></span>{{ post.commentscount.length }} </div>
        </div>
        </a></div>
        </div>

    </div>

        <div v-if="postsCount == 10">
            <a href="#/" @click="loadMore(indexPosts.length)" class="d-block mt-2 text-center text-primary">View more</a>
            </div>

    </div>
</template>

<script>
    export default {
        props: ['profile'],

        data: function() {
            return {
                indexPosts: [],
                postsCount: '',
                theprofile: this.profile
            }
        },
        methods:{
            getPosts(){
            axios.get('/post/profile/'+ this.theprofile +'/0')
            .then(res => {
                this.indexPosts = res.data;
                this.postsCount = this.indexPosts.length;
            })
            .catch(err => {
                console.error(err);
            })
            },
            loadMore(offset){
            axios.get('/post/profile/'+ this.theprofile +'/'+offset)
            .then(res => {
                for(var i in res.data){
                    this.indexPosts.push(res.data[i])
                  }
                this.postsCount = res.data.length;
            })
            .catch(err => {
                console.error(err);
            })
            },
            },
        mounted() {
            this.getPosts();
        },
    }

</script>
