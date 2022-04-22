<template>
    <div class="container my-5">
        <div class="row">
          <div class="col">

                
                <div v-if="success" class="alert alert-success">
                    Email inviata con successo!
                </div>
                

                <form @submit.prevent="sendForm()">

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" :class="{'is-invalid': errors.name}" id="name" name="name" v-model="name">
                        <div v-for="(error, index) in errors.name" :key="'error_name' + index" class="invalid-feedback">
                            {{error}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" :class="{'is-invalid': errors.email}" id="email" name="email" v-model="email">
                         <div v-for="(error, index) in errors.email" :key="'error_email' + index" class="invalid-feedback">
                            {{error}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message">Messaggio</label>
                        <textarea class="form-control" :class="{'is-invalid': errors.message}" name="message" id="message" rows="10" placeholder="Scrivi qui il tuo messaggio..." v-model="message"></textarea>
                         <div v-for="(error, index) in errors.message" :key="'error_message' + index" class="invalid-feedback">
                            {{error}}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">{{sending ? "invio in corso" : "Invia"}}</button>
                    
                </form>

          </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Contacts",

        data(){
            return{
                name: null,
                email: null,
                message: null,
                errors: {},
                sending: false,
                success: false
            }
        },

        methods:{
            sendForm(){

                this.sending = true;

                axios.post("api/contacts", {
                    "name": this.name,
                    "email": this.email,
                    "message": this.message
                }).then(response => {

                    if(response.data.success){
                        this.success = true;
                        this.name = null;
                        this.email = null;
                        this.message =  null;
                        this.errors = {};
                    }else{
                        this.errors = response.data.errors;
                    }

                    this.sending = false;
                });
            }
        }
    }
</script>

<style scoped>

    div.container{
        min-height: 80vh;
    }

</style>