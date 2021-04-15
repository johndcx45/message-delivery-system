<template>
    <div class="user-page-container">
        <AdminNavBar />
        <h3>User Registration</h3>
        <div v-if="loading" class="mx-auto">
            Loading...
        </div>
        <div v-else>
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
            <div class="mx-auto" style="width: 500px;">
                    <b-card style="max-width: 40rem;" title="Regiser User Form" class="mt-5">
                        <b-form @submit.prevent="registerUser">
                                <b-form-group
                                    id="input-group-1"
                                    label="Name:"
                                    label-for="input-name"
                                >
                                    <b-form-input
                                    id="input-name"
                                    v-model="$v.name.$model"
                                    placeholder="Subject"
                                    aria-describedby="input-name-live-feedback"
                                    :state="validateState('name')"
                                    ></b-form-input>
                                    <b-form-invalid-feedback
                                    id="input-name-live-feedback"
                                    >Name is required and can not be null.</b-form-invalid-feedback>
                                </b-form-group>

                                <b-form-group
                                    id="input-group-2"
                                    label="Username:"
                                    label-for="input-username"
                                >
                                    <b-form-input
                                    id="input-username"
                                    v-model="$v.username.$model"
                                    placeholder="Username"
                                    aria-describedby="input-username-live-feedback"
                                    :state="validateState('username')"
                                    ></b-form-input>
                                    <b-form-invalid-feedback
                                    id="input-username-live-feedback"
                                    >Username must be at least 5 characters long.</b-form-invalid-feedback>
                                </b-form-group>

                                <b-form-group
                                    id="input-group-3"
                                    label="Role:"
                                    label-for="input-role"
                                >
                                    <b-form-input
                                    id="input-role"
                                    v-model="$v.role.$model"
                                    placeholder="Role"
                                    aria-describedby="input-role-live-feedback"
                                    :state="validateState('role')"
                                    ></b-form-input>
                                    <b-form-invalid-feedback
                                    id="input-role-live-feedback"
                                    >Role is required and can not be null.</b-form-invalid-feedback>
                                </b-form-group>
                                <b-form-group
                                    id="input-group-4"
                                    label="Password:"
                                    label-for="input-password"
                                >
                                    <b-form-input
                                    id="input-password"
                                    v-model="$v.password.$model"
                                    placeholder="Password"
                                    aria-describedby="input-password-live-feedback"
                                    :state="validateState('password')"
                                    type="password"
                                    ></b-form-input>
                                    <b-form-invalid-feedback
                                    id="input-password-live-feedback"
                                    >Password must be at least 8 characters long.</b-form-invalid-feedback>
                                </b-form-group>

                                <b-button type="submit" class="width: 60px" variant="primary">Submit</b-button>
                            </b-form>
                    </b-card>
                </div>
        </div>
    </div>
</template>

<script>
import AdminNavBar from './AdminNavBar.vue';
import { required, minLength, maxLength } from "vuelidate/lib/validators";
import { validationMixin } from "vuelidate";

export default {
    mixins: [validationMixin],
    components: {
        'AdminNavBar': AdminNavBar
    },
    data () {
        return {
            name: null,
            username: null,
            role: null,
            password: null,
            users: [],
            loading: false
        }
    },
    validations: {
        name: {
            required,
            minLength: minLength(1),
            maxLength: maxLength(30)
        },
        username: {
            required,
            minLength: minLength(3),
            maxLength: maxLength(25)
        },
        role: {
            required,
        },
        password: {
            required,
            minLength: minLength(8),
            maxLength: maxLength(30)
        },
    },
    created () {
        this.loading = true;
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
            this.loading = false;
        }).catch(error => {
            this.loading = false;
            this.$alert(error);
        })

    },
    methods:{
        validateState(name) {
            const { $dirty, $error } = this.$v[name];
            return $dirty ? !$error : null;
        },
        registerUser () {
             this.$v.$touch(); // checks all inputs
            
            if (!this.$v.$anyError) { // if ANY fail validation
                var app = this;
                let access_token = localStorage.getItem('access_token');

                const config = {
                    headers: { Authorization: `Bearer ${access_token}`}
                }

                let name = app.name;
                let username = app.username;
                let role = app.role.toLowerCase();
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
            } else {
                this.$alert('Error in user registration!');
            }
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
        width: 100%;
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