<template>
    <div>
        <a href="#" class="pl-3 text-primary float-right" @click="followUser" v-text="buttonText"></a>
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
                    // toggle boolean
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
