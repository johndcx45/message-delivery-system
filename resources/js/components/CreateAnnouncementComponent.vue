<template>
    <div class="component-view">
        <AdminNavBar v-if="this.role == 'admin'"/>
        <BackofficeNavBar v-else-if="this.role == 'backoffice'"/>
        <RegularNavBar v-else/>
        <h3>Create Announcement</h3>
        <div class="content-view-create">
            <div class="input-container">
                <div class="ghost">
                </div>
                <div class="mx-auto" style="width: 500px;">
                    <b-card style="max-width: 40rem;" title="Create Announcement Form" class="mt-5">
                        <b-form @submit.prevent="createMessage">
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
                                    >This is a required field and can not be null.</b-form-invalid-feedback>
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
                                    >This is a required field and can not be null.</b-form-invalid-feedback>
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
                    </b-card>
                </div>
            </div>
        </div>
    </div>  
</template>

<script>
import AdminNavBar from './AdminNavBar';
import VueSimpleAlert from 'vue-simple-alert';
import Vue from 'vue';
import BackofficeNavBar from './BackofficeNavBar';
import RegularNavBar from './RegularNavBar.vue';
import { required, minLength, maxLength } from "vuelidate/lib/validators";
import { validationMixin } from "vuelidate";

Vue.use(VueSimpleAlert);

export default {
    mixins: [validationMixin],
    components: {
        'AdminNavBar': AdminNavBar,
        'BackofficeNavBar': BackofficeNavBar,
        'RegularNavBar': RegularNavBar
    },
    data () {
        return {
            subject: null,
            content: null,
            startDate: null,
            expirationDate: null,
            role: localStorage.getItem('role')
        }
    },
    validations: {
        subject: {
            required,
            minLength: minLength(1),
            maxLength: maxLength(60)
        },
        content: {
            required,
            minLength: minLength(10),
            maxLength: maxLength(150)
        },
        startDate: {
            required
        },
        expirationDate: {
            required
        },
    },
    methods: {
        validateState(name) {
            const { $dirty, $error } = this.$v[name];
            return $dirty ? !$error : null;
        },
        createMessage () {
            this.$v.$touch(); // checks all inputs
            
            if (!this.$v.$anyError) { // if ANY fail validation

                var app = this;
                let access_token = localStorage.getItem('access_token');

                const config = {
                    headers: { Authorization: `Bearer ${access_token}`}
                }

                let subject = app.subject;
                let content = app.content;
                let startDate = app.startDate;
                let expirationDate = app.expirationDate;

                let url = 'http://localhost:8000/api/message';

                let err = null;

                let response = axios.post(url, {
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
                        this.$alert('The message has been created!');
                    }
                })       
            } else {
                this.$alert('Form failed validation')
            }
        }
    }
}
</script>

<style>

</style>