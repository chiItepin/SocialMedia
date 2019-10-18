<template>
   
</template>

<script>
    export default {
        props: ['postid'],

        mounted() {

        },
        data: function() {
            return {
                post: this.postid,
                comment: '',
                csrf: document.querySelector('meta[name="csrf-token"]').content,
            }
        },
        methods:{
            submitForm(){
            axios.post('/comment/'+this.post, {
        comment: this.comment,
      }).then(res => {

            })
            .catch(err => {
                console.error(err);
            })
            },
      
        },
        computed:{

        },
        mounted() {

        },
    }
</script>
