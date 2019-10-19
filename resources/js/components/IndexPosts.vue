<template>
    <div>

         <div v-bind:key="key" v-for="(post, key) in indexPosts">

            <div class="row postRow">

                <div class="col-12 postRowHeader">
                    <div class="d-flex align-items-center">
                            <span style="position:absolute;right:10px" class="text-secondary float-right">{{ post.created_at }}</span>

                        <div class="pr-3">
                                <a style="color:black" :href="'/profile/'+post.profile.id"><img style="width:40px" class="rounded-circle" :src="'storage/'+post.profile.image" alt=""></a>
                        </div>
                        <div>
                        <div class="font-weight-bold">
                            <a style="color:black" :href="'/profile/'+post.profile.id">{{post.user.username}}</a>
                        </div>

                        </div>

                    </div>


            </div>
            <div class="col-12">
                    <a :href="'/p/'+post.id"><img :src="'storage/'+post.image" class="w-100" alt=""></a>
            </div>
            <div class="col-12 postRowHeader">
                    <div class="d-flex align-items-center">
                            <a style="color:black" class="font-weight-bold pr-2" :href="'/profile/'+post.profile.id"> {{post.user.username}} </a> {{post.caption}}

                    </div>

                        <div v-if="post.likesuser">
                        <like-link :logged="loggedin" :likes="true" :postid="post.id"></like-link>
                        </div>
                        <div v-else>
                        <like-link :logged="loggedin" :likes="false" :postid="post.id"></like-link>
                        </div>


                                <div class="d-inline-block">{{ post.likes.length }} <span class="font-weight-bold pl-1">Likes</span></div>
            <div class="pl-1 d-inline-block">{{ post.commentscount.length }} <span class="font-weight-bold pl-1">Comments</span></div>


            </div>
        </div>

           </div>

                       <div v-if="postsCount == 10">
            <a href="#/" @click="loadMore(indexPosts.length)" class="d-block mt-2 text-center text-primary">View more</a>
            </div>
    </div>
</template>

<script>
    export default {
        props: ['logged'],

        data: function() {
            return {
                indexPosts: [],
                postsCount: '',
                loggedin: this.logged
            }
        },
        methods:{
            getPosts(){
            axios.get('/post/view/0')
            .then(res => {
                this.indexPosts = res.data;
                this.postsCount = this.indexPosts.length;
            })
            .catch(err => {
                console.error(err);
            })
            },
            loadMore(offset){
            axios.get('/post/view/'+offset)
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
