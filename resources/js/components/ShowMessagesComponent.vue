<template>
    <div class="component-view">
        <AdminNavBar v-if="this.role == 'admin'"/>
        <BackofficeNavBar v-else-if="this.role == 'backoffice'"/>
        <h3>Announcements</h3>
        <div class="content-view">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Start Date</th>
                        <th>Expiration Date</th>
                        <th>Subject</th>
                        <th class="ghost-th"></th>
                        <th class="actions-th">Actions</th>
                        <th class="ghost-th"></th>
                        <th class="ghost-th"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="message in availableMessages" :key="message.id">
                        <td>{{ message.id }}</td>
                        <td>{{ message.start_date }}</td>
                        <td>{{ message.expiration_date }}</td>
                        <td>{{ message.subject }}</td>                        
                        <td><button class="btn btn-view" v-on:click="viewMessage(message.id)"><router-link to="/fullview" style="text-decoration: none; color: white;">View</router-link></button></td>
                        <td><button class="btn btn-delete" v-on:click="deleteMessage(message.id, message.user_id)">Delete</button></td> 
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import AdminNavBar from './AdminNavBar.vue';
import BackofficeNavBar from './BackofficeNavBar.vue';
import VueSimpleAlert from 'vue-simple-alert';

export default {
    components: { 
        'AdminNavBar': AdminNavBar,
        'BackofficeNavBar': BackofficeNavBar
    },
    data () {
        return {
            messages: [],
            message: null,
            role: localStorage.getItem('role')
        }        
    },
    computed: {
        availableMessages: function() {
            return this.messages.filter(function (message) {
                return message.deletedAt == null;
            });
        }
    },
    created () {
        this.getMessages();
    },
    methods: {
        viewMessage (id) {
            localStorage.setItem('message_view_id', id);
            let name = localStorage.getItem('name');
        },
        deleteMessage(message_id, user_id) {
            let loggedUserId = localStorage.getItem('user_id');
            let err;
            
            if(loggedUserId == user_id) {
                let url = `http://localhost:8000/api/message/${message_id}`;
                let access_token = localStorage.getItem('access_token');

                const fetchedData = this.axios.delete( url, { headers: {
                    "Access-Control-Allow-Origin" : "*",
                    "Content-type": "Application/json",
                    "Authorization": `Bearer ${access_token}`
                    }
                }).catch(err => {
                    if(err){
                        err = null;
                        this.$alert('An unexpected error ocurred!');
                    }
                }).finally(() => {
                    if ( !err ) {
                        this.$alert('The message has been deleted');
                        this.getMessages()
                    }                    
                });

            } else {
                this.$alert('You do not have enough permissions to delete this message!');
            }
        },
        getMessages(){ 
            let url = 'http://localhost:8000/api/message';
            let access_token = localStorage.getItem('access_token');

            const fetchedData = this.axios.get( url, { headers: {
                "Access-Control-Allow-Origin" : "*",
                "Content-type": "Application/json",
                "Authorization": `Bearer ${access_token}`
                }
            }).then(response => {
                this.messages = response.data.messages;
            });
        }
    }
}
</script>

<style>
    .component-view {
        height: 300;
    }

    h3 {
        text-align: center;
        margin-top: 10px;
    }

    .content-view {
        margin-top: 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 150px;
        bottom: 0;
        width: 100%;
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
        background-color: #f05454;
        color: #fff;
    }

    .ghost-th {
        background-color: #f05454;
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
        border-bottom: 2px solid #f05454;
    }

    table tbody tr.active-row {
        font-weight: bold;
        color: #000;
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
        background-color: green;
    }

    .btn-edit {
        background-color: #ff9a3c;
    }

    .btn-delete {
        background-color: #d72323;
    }
</style>