<template>
    <div class="component-view">
        <RegularNavBar />
        <h3>Announcements</h3>
        <div class="content-view">
            <table>
                <thead>
                    <tr>
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
                        <td><b-button variant="primary" v-on:click="viewMessage(message.id)"><router-link to="/fullview" style="text-decoration: none; color: white;">View</router-link></b-button></td> 
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import RegularNavBar from './RegularNavBar';

export default {
    components: { 
        'RegularNavBar': RegularNavBar
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

</style>