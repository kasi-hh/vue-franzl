<template>
    <b-container>
        <b-row>
            <b-col>
                <div class="login">
                    <h2>Login</h2>
                    <b-form>
                        <b-form-input v-model="user" placeholder="Username"></b-form-input>
                        <b-form-input type="password" v-model="password"> </b-form-input>
                        <b-button @click="doLogin">Login</b-button>
                    </b-form>
                </div>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'login',
        components: {},
        data(){
            return {
                password:'',
                user:''
            }
        },
        methods:{
            doLogin() {
                axios.post('/api/auth/login',{
                    user:this.user,
                    password:this.password
                }).then(response => {
                    const data = response.data;
                    if (data.success){
                        localStorage.setItem('token',data.token);
                        this.$router.push('/')
                    }
                })
            }

        }

    }
</script>
