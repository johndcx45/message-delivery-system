<template>
    <div class="component-view">
        <AdminNavBar v-if="this.role == 'admin'"/>
        <BackofficeNavBar v-else-if="this.role == 'backoffice'"/>
        <h3>Announcements</h3>
        <div v-if="loading" class="text-center">
            <b-spinner label="Loading..."></b-spinner>
        </div>
        <div class="content-view" v-else>
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
                        <td><b-button variant="primary" v-on:click="viewMessage(message.id)"><router-link to="/fullview" style="text-decoration: none; color: white;">View</router-link></b-button></td>
                        <td><b-button variant="danger" v-on:click="deleteMessage(message.id, message.user_id)">Delete</b-button></td>
                        <td><b-button variant="success" v-b-modal="edit-announcement" @click="showMessage(message)">Edit</b-button></td> 
                    </tr>
                    <b-modal id="edit-announcement">
                            <b-form @submit.prevent="editMessage">
                                 <b-form-group
                                    id="input-group-1"
                                    label="Subject:"
                                    label-for="input-subject"
                                >
                                    <b-form-input
                                    id="input-subject"
                                    v-model="$v.subject.$model"
                                    placeholder="Subject"
                                    aria-describedby="input-subject-live-feedback"
                                    :state="validateState('subject')"
                                    ></b-form-input>
                                    <b-form-invalid-feedback
                                    id="input-subject-live-feedback"
                                    >Subject field is required and can not be null.</b-form-invalid-feedback>
                                </b-form-group>

                                <b-form-group id="input-group-2" label="Content:" label-for="input-content">
                                    <b-form-textarea
                                        id="input-content"
                                        placeholder="Content of the Announcement"
                                        rows="3"
                                        :state="validateState('content')"
                                        aria-describedby="input-content-live-feedback"                                        
                                        v-model="$v.content.$model"
                                    ></b-form-textarea>
                                    <b-form-invalid-feedback
                                    id="input-content-live-feedback"
                                    >Content is required and can not be null.</b-form-invalid-feedback>
                                </b-form-group>

                                <b-form-group id="input-group-3" label="Start Date:" label-for="input-start-date">
                                    <b-form-datepicker 
                                    id="input-start-date" 
                                    v-model="$v.startDate.$model"
                                    class="mb-2"
                                    :state="validateState('startDate')"
                                    aria-describedby="input-start-date-live-feedback"></b-form-datepicker>
                                    <b-form-invalid-feedback
                                    id="input-start-date-live-feedback"
                                    >Start date must be valid.</b-form-invalid-feedback>
                                </b-form-group>
                                
                                <b-form-group id="input-group-4" label="Expiration Date:" label-for="input-expiration-date">
                                    <b-form-datepicker 
                                    id="input-expiration-date" 
                                    v-model="$v.expirationDate.$model"
                                    class="mb-2"
                                    :state="validateState('expirationDate')"
                                    aria-describedby="input-expiration-date-live-feedback"></b-form-datepicker>
                                    <b-form-invalid-feedback
                                    id="input-expiration-date-live-feedback"
                                    >Expiration Date must be valid.</b-form-invalid-feedback>
                                </b-form-group>
                                <b-button type="submit" class="width: 60px" variant="primary">Submit</b-button>
                            </b-form>
                        </b-modal>
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
import { validationMixin } from "vuelidate";
import { required, minLength, maxLength } from "vuelidate/lib/validators";

export default {
    mixins: [validationMixin],
    components: { 
        'AdminNavBar': AdminNavBar,
        'BackofficeNavBar': BackofficeNavBar
    },
    data () {
        return {
            subject: null,
            content: null,
            startDate: null,
            expirationDate: null,
            messages: [],
            message: null,
            messageToShow: {
                id: 0
            },
            role: localStorage.getItem('role'),
            loading: false
        }        
    },
    computed: {
        availableMessages: function() {
            return this.messages.filter(function (message) {
                return message.deletedAt == null;
            });
        }
    },
    validations: {
        subject: {
            required,
            minLength: minLength(1),
            maxLength: maxLength(30)
        },
        content: {
            required,
            minLength: minLength(1),
            maxLength: maxLength(150)
        },
        startDate: {
            required
        },
        expirationDate: {
            required
        },
    },
    created () {
        this.loading = true;
        this.getMessages();
    },
    methods: {
        viewMessage (message_id) {
            let user_id = null;
            let userIdUrl = 'http://localhost:8000/api/userid';
            let access_token = localStorage.getItem('access_token');

            const resUserId = this.axios.get( userIdUrl, { headers: {
                "Access-Control-Allow-Origin" : "*",
                "Content-type": "Application/json",
                "Authorization": `Bearer ${access_token}`
            }
            }).then(response => {
                user_id = response.data.user_id;
                localStorage.setItem('user_id', user_id);
                localStorage.setItem('message_id', message_id);
                console.log(localStorage.getItem('message_id'));
            }).catch(err => {
                this.$alert('An unexpected error ocurred!');
            });
        },
        deleteMessage(message_id, user_id) {
            let access_token = localStorage.getItem('access_token');
            let err;
            let loggedUserId = null;

            let userIdUrl = 'http://localhost:8000/api/userid';
            
            const resUserId = this.axios.get( userIdUrl, { headers: {
                "Access-Control-Allow-Origin" : "*",
                "Content-type": "Application/json",
                "Authorization": `Bearer ${access_token}`
                }
            }).then(response => {
                loggedUserId = response.data.user_id;
                console.log(response);
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
            }).catch(err => {
                this.$alert('An unexpected error ocurred!');
            });
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
                this.loading = false;
            });
        },
        validateState(name) {
            const { $dirty, $error } = this.$v[name];
            return $dirty ? !$error : null;
        },
        editMessage () {
            this.$v.$touch(); // checks all inputs
            
            if (!this.$v.$anyError) { // if ANY fail validation
                var app = this;
                let access_token = localStorage.getItem('access_token');

                let id = this.messageToShow.id;
                let subject = app.subject;
                let content = app.content;
                let startDate = app.startDate;
                let expirationDate = app.expirationDate;

                let url = `http://localhost:8000/api/message/${id}`;

                const config = {
                    headers: { Authorization: `Bearer ${access_token}`}
                }
                let err = null;

                let response = axios.put(url, {
                    subject: subject,
                    content: content,
                    start_date: startDate,
                    expiration_date: expirationDate
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
                        this.$alert('The message has been updated!');
                    }
                });
            } else {
                this.$alert('Form validation failed!')
            }
        },
        showMessage(message) {
            this.messageToShow = message;
            this.$bvModal.show('edit-announcement');
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
</style>