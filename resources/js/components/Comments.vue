<template>
    <div>
            <div id="commentsContainer" class="commentsContainer">

         <div v-bind:key="key" v-for="(comment, key) in comments" class="rowComment align-items-center">
                    <a style="color:black" :href="'/profile/'+comment.profile.id">
             <img style="width:40px" class="rounded-circle" :src="'/storage/'+comment.profile.image" alt="">
                    </a>
                    <a style="color:black" class="pl-1" :href="'/profile/'+comment.profile.id"><b>{{ comment.user.username }}</b></a>
            <span class="pl-2">{{comment.comment}}</span>
            <span class="commentDate">{{ comment.created_at }}</span>
            </div>

            <div v-if="commentsCount == 10">
            <a href="#/" @click="loadMore(comments.length)" class="d-block mt-2 text-center text-primary">View more</a>
            </div>

             </div>
<div class="footerpostComment">

  <form v-on:submit.prevent="submitForm" >

<!-- <input type="hidden" name="_token" v-model="csrf"> -->

                <input v-model="comment" type="text" placeholder="Add a comment" name="comment" id="">
            </form>

    </div>
</div>
    </div>
</template>

<script>
    export default {
        props: ['postid'],

        data: function() {
            return {
                post: this.postid,
                comments: [],
                commentsCount: '',
                comment:'',
            }
        },
        methods:{
            getComments(){
            axios.get('/commented/'+this.post+'/0')
            .then(res => {
                this.comments = res.data;
                this.commentsCount = this.comments.length;
            })
            .catch(err => {
                console.error(err);
            })
            },
            loadMore(offset){
            axios.get('/commented/'+this.post+'/'+offset)
            .then(res => {
                for(var i in res.data){
                    this.comments.push(res.data[i])
                  }
                this.commentsCount = res.data.length;
            })
            .catch(err => {
                console.error(err);
            })
            },
             submitForm(){
            axios.post('/comment/'+this.post, {
        comment: this.comment,
      }).then(res => {
          // unshift to push at the beginning of the array
            this.comments.unshift(res.data[0]);
            this.comment = '';
             var commentsContainer = document.getElementById("commentsContainer");
            commentsContainer.scrollTop = 0;
            })
            .catch(err => {
                console.error(err);
            })
            },
        },
        computed:{

        },
        mounted() {
            this.getComments();
        },
    }
</script>
