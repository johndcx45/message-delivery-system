<template>
    <div id="login">
        <div class="login-container">
            <img :src="'/img/delorean.png'" class="delorean">
            <div class="ghost"></div>
            <h1>Time Machine Login</h1>
            <div class="ghost"></div>
            <div class="login-form">
                <form method="POST" action="/homepage" @submit.prevent="login">
                    <input type="hidden" name="_token" :value="csrf">
                    <label class="label-text">Username</label>
                    <input type="text" class="input-text" id="input-username" 
                        placeholder="Username" v-model="username" required>
                    <label class="label-text">Password</label>
                    <input type="password" class="input-text" id="input-password" 
                        placeholder="Password" v-model="password" required >
                    <button type="submit" class="btn-login">Login</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

const axios = require('axios')

export default {
    computed: {
        csrf(){
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }
    },
    data () {
        return {
            username: null,
            password: null,
            has_error: false
        }
    },
    methods: {
        login() {
            var app = this;            
            axios.post('/api/login', {
                username: app.username,
                password: app.password
            }).then(response => {
                console.log(response);
                let status = response.status;
                let token = response.data.token;

                if( status === 200 ){
                    let role = response.data.role;
                    localStorage.setItem('access_token', token);
                    
                    if(role === 'admin'){
                        this.$router.push({ name: `${role}`, query: { redirect: `${role}` }});
                    } else if(role === 'backoffice'){
                        this.$router.push({ name: `${role}`, query: { redirect: `${role}` }});
                    } else if(role === 'regular') {
                        this.$router.push({ name: `${role}`, query: { redirect: `${role}` }});
                    }
                } else {
                    this.$router.push({ name: "FailedLogin", query: { redirect: '/failed' }});
                }
            });

        }
    }
}
</script>

<style scoped>
    #login {
        display: flex;
        width: 100%;
        height: 720px;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }

    .login-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 450px;
        height: 600px;
        box-shadow: 3px 3px 5px 6px #eee;
        background-color: #fff;
        border-radius: 15px;
    }

    .delorean {
        width: 100px;
        height: 100px;
    }

    .ghost {
        width: 100%;
        height: 50px;
    }

    .login-form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .input-text {
        display: block;
        margin: 8px 0px;
        padding: 3px;
        border: 0 solid transparent;    
        border-bottom: 2px solid #2196F3;
        border-radius: 2px;
    }

    .btn-login {
        float: right;
        background-color: #2196F3;
        color: #fff;
        width: 80px;
        height: 40px;
        border: 0 solid transparent;
        outline: none;
        border-radius: 7px;
    }
</style>