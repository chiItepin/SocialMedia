<template>
    <div>
    
    <div v-if="loggedin != 1">
       <!-- Button trigger modal -->
<a data-toggle="modal" data-target="#notLogged">
          <i :class="[(status) ? 'red-text' : 'black-text', '']"  v-text="buttonText" class="material-icons"></i>
</a>

<!-- Modal -->
    <div id="notLogged" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Whoops!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>You are not logged in!</p>
      </div>

    </div>
  </div>
</div>
    </div>


    <div v-if="loggedin == 1">
        <a href="#/" class="" @click="likePost">

        <i :class="[(status) ? 'red-text' : 'black-text', '']"  v-text="buttonText" class="material-icons"></i>

        </a>
    </div>

    </div>
</template>

<script>
    export default {
        props: ['postid','likes','logged'],

        mounted() {

        },
        data: function() {
            return {
                status: this.likes,
                loggedin: this.logged
            }
        },
        methods:{
            likePost(){
                axios.post('/like/'+this.postid)
                .then(res => {
                    // toggle boolean
                    this.status = ! this.status;

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
                return (this.status) ? 'favorite' : 'favorite_border';
            }
        },
    }
</script>
<style scoped>
.black-text{
    color:black !important;
}
.red-text{
    color:rgb(226, 72, 72) !important;
}
</style>
