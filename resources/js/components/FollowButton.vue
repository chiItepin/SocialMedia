<template>
    <div>
        <button class="mb-2 ml-4 btn btn-primary" v-text="buttonText" @click="followUser" ></button>
    </div>
</template>

<script>
    export default {
        props: ['userId','follows'],

        mounted() {
            console.log('Component mounted.')
        },
        data: function() {
            return {
                status: this.follows,
            }
        },
        methods:{
            followUser(){
                axios.post('/follow/'+this.userId)
                .then(res => {
                    this.status = ! this.status;
                    // console.log(res)
                })
                .catch(err => {
                    if(err.res.status == 401){
                        window.location = '/login';
                    }
                })
            }
        },
        computed:{
            buttonText(){
                return (this.status) ? 'Unfollow' : 'Follow';
            }
        },
    }
</script>
