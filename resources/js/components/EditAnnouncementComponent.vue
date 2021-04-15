<template>
  <div class="component-view">
        <AdminNavBar v-if="this.role == 'admin'"/>
        <BackofficeNavBar v-else-if="this.role == 'backoffice'"/>
        <h3>Edit Announcement</h3>
            <div class="mx-auto" style="width: 500px;">
                    <b-card style="max-width: 40rem;" title="Edit Announcement Form" class="mt-5">
                        <b-form @submit.prevent="editMessage">
                                 <b-form-group
                                    id="input-group-0"
                                    label="ID:"
                                    label-for="input-id"
                                >
                                    <b-form-input
                                    id="input-id"
                                    v-model="$v.id.$model"
                                    placeholder="ID of the message"
                                    aria-describedby="input-id-live-feedback"
                                    :state="validateState('id')"
                                    ></b-form-input>
                                    <b-form-invalid-feedback
                                    id="input-id-live-feedback"
                                    >ID can't be null</b-form-invalid-feedback>
                                </b-form-group>
                                
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
</template>

<script>
import AdminNavBar from './AdminNavBar';
import BackofficeNavBar from './BackofficeNavBar';
import { required, minLength, maxLength } from "vuelidate/lib/validators";
import { validationMixin } from "vuelidate";

export default {
    mixins: [validationMixin],
    components: {
        'AdminNavBar': AdminNavBar,
        'BackofficeNavBar': BackofficeNavBar
    },
    data () {
        return {
            id: null,
            subject: null,
            content: null,
            startDate: null,
            expirationDate: null,
            role: localStorage.getItem('role')
        }
    },
    validations: {
        id: {
            required
        },
        subject: {
            required,
            minLength: minLength(1),
            maxLength: maxLength(30)
        },
        content: {
            required,
            minLength: minLength(10),
            maxLength: maxLength(100)
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
        editMessage () {
            this.$v.$touch(); // checks all inputs
            
            if (!this.$v.$anyError) { // if ANY fail validation
                var app = this;
                let access_token = localStorage.getItem('access_token');

                let id = app.id;
                let user = localStorage.getItem('name');
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
        }
    }
}
</script>

<style scoped>
    .content-view-create {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }

    h3 {
        display: block;    
        text-align: center;
        margin-top: 45px;
    }
    .input-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        box-shadow: 3px 3px 5px 6px #eee;
        background-color: #fff;
        border-radius: 15px;
        width: 450px;
        height: 400px;
        margin-top: 100px;
    }

    .ghost {
        display: block;
        height: 40px;
    }

    label {
        text-align: left;
    }

    .input-text-create {
        display: block;
        margin: 8px 0px;
        border: 0 solid transparent;    
        border-bottom: 2px solid #2196F3;
        padding: 5px;
        margin: 7px 10px;
    }

    .btn-create {
        border: 0px solid transparent;
        outline: none;
        background-color: #2196F3;
        width: 100px;
        height: 35px;
        color: white;
        float: right;
        border-radius: 3px;
    }
</style>