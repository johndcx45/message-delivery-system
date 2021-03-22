<template>
    <div class="user-page-container">
        <AdminNavBar />
        <h3>User Registration</h3>
        <div class="user-list">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.username }}</td>
                        <td>{{ user.role }}</td>                        
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="user-form">
           <form class="create-form" method="POST" @submit.prevent="registerUser">
                <label for="name">Name</label>
                    <input type="text" class="input-text-create" name="name" v-model="name" placeholder="Name" required>
                <label for="username">Username</label>
                    <input type="text" class="input-text-create" name="username" v-model="username" placeholder="Username" required>
                <label for="role">Role</label>
                    <input type="text" class="input-text-create" name="role" v-model="role" placeholder="Role" required>
                <label for="password">Password</label>
                    <input type="password" name="password" class="input-text-create" v-model="password" placeholder="Password" required>
                <button class="btn-create">Create</button>
            </form>
        </div>
    </div>
</template>

<script>
import AdminNavBar from './AdminNavBar.vue';

export default {
    components: {
        'AdminNavBar': AdminNavBar
    },
    data () {
        return {
            name: null,
            username: null,
            role: null,
            password: null,
            users: []
        }
    },
    created () {
        let url = 'http://localhost:8000/api/user';
        let access_token = localStorage.getItem('access_token');

        const fetchedData = this.axios.get( url, { headers: {
            "Access-Control-Allow-Origin" : "*",
            "Content-type": "Application/json",
            "Authorization": `Bearer ${access_token}`
            }
        }).then(response => {
            this.users = response.data.users;
            console.log(response);
        });
    },
    methods:{
        registerUser () {
            var app = this;
            let access_token = localStorage.getItem('access_token');

            const config = {
                headers: { Authorization: `Bearer ${access_token}`}
            }

            let name = app.name;
            let username = app.username;
            let role = app.role;
            let password = app.password;

            let url = 'http://localhost:8000/api/user'

            let err = null;

            let response = axios.post(url, {
                name: name,
                username: username,
                role: role,
                password: password
            }, config
            ).then(response => {
                console.log(response);
            }).catch(err => {
                if(err){
                    err = null;
                    this.$alert('An unexpected error ocurred!');
                }
            }).finally(() => {
                if ( !err ) {
                    this.$alert('The user has been registered!');
                }
            })
        }

    }
}
</script>

<style scoped>

    .user-list {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }

    h3 {
        display: block;    
        text-align: center;
        margin-top: 45px;
    }

    .user-form {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        box-shadow: 3px 3px 5px 6px #eee;
        background-color: #fff;
        border-radius: 15px;
        width: 400px;
        height: 350px;
    }

    .input-text-create {
        display: block;
        margin: 8px 0px;
        border: 0 solid transparent;    
        border-bottom: 2px solid #e4fbff;
        padding: 5px;
        margin: 7px 10px;
    }

    .btn-create {
        border: 0px solid transparent;
        outline: none;
        background-color: #8ac4d0;
        width: 100px;
        height: 35px;
        color: white;
        float: right;
        border-radius: 3px;
    }

    table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    table thead {
        width: 100%;
    }

    table thead tr, table thead tr {
        background-color: #8ac4d0;
        color: #fff;
    }

    .ghost-th {
        background-color: #e4fbff;
    }

    .actions-th {
        text-align: center;
    }

    table th, table td {
        padding: 12px 15px;    
    }

    table tbody tr {
        border-bottom: 1px solid #ddd;
    }

    table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    table tbody tr:last-of-type {
        border-bottom: 2px solid #8ac4d0;
    }

    table tbody tr.active-row {
        font-weight: bold;
        color: #8ac4d0;
        width: 100%;
    }

    .btn {
        color: #fff;
        outline: none;
        border: 0 solid transparent;
        border-radius: 7px;
        width: 60px;
        height: 40px;
    }

    .btn-view {
        background-color: #2196F3;
    }
</style>