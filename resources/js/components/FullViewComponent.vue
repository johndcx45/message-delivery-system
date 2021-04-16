<template>
    <div class="full-view-component">
        <AdminNavBar v-if="this.role == 'admin'"/>
        <BackofficeNavBar v-else-if="this.role == 'backoffice'"/>
        <h3>Announcement Details</h3>
        <div v-if="loading">
            <div class="text-center mt-5">
                <b-spinner label="Loading..."></b-spinner>
            </div>
            
        </div>
        <div v-else>
            <div class="mx-auto" style="width: 600px;">
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Created by</th>
                            <th>Subject</th>
                            <th>Content</th>
                            <th>Start Date</th>
                            <th>Expiration Date</th>
                            <th>Viewed By</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                            <td>{{ message.id }}</td>
                            <td>{{ message.created_by }}</td>
                            <td>{{ message.subject }}</td>
                            <td>{{ message.content }}</td>
                            <td>{{ message.start_date }}</td>
                            <td>{{ message.expiration_date }}</td>
                            <td v-if="!viewedByLoading">{{ viewed_by }}</td>
                            <td v-else><span style="font-weight: bold;">Loading...</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import AdminNavBar from './AdminNavBar.vue'
import BackofficeNavBar from './BackofficeNavBar';

export default {
    components: { 
        'AdminNavBar': AdminNavBar,
        'BackofficeNavBar' : BackofficeNavBar
    },
    data () {
        return {
            message: [],
            viewed_by: null,
            viewedByLoading: false,
            role: localStorage.getItem('role'),
            loading: false
        }
    },
    created () {
        this.loading = true;
        this.markAsRead();
        let message_id = localStorage.getItem('message_id');

        let url = `http://localhost:8000/api/message/${message_id}`;

        let access_token = localStorage.getItem('access_token');

        const fetchedData = this.axios.get( url, { headers: {
            "Access-Control-Allow-Origin" : "*",
            "Content-type": "Application/json",
            "Authorization": `Bearer ${access_token}`
            }
        }).then(response => {
            this.message = response.data.message
            this.loading = false;
        });
    },
    methods:{
         markAsRead() {
            let message_id = localStorage.getItem('message_id');
            let user_id = localStorage.getItem('user_id');

            let url = `http://localhost:8000/api/read`;

            let access_token = localStorage.getItem('access_token');

            const fetchedData = this.axios.post( url,{
                user_id: user_id,
                message_id: message_id
            }, { headers: {
                "Access-Control-Allow-Origin" : "*",
                "Content-type": "Application/json",
                "Authorization": `Bearer ${access_token}`
                }
            }).then(() => {
                this.fetchViewedBy();
            })
        },
        fetchViewedBy() {
            this.viewedByLoading = true;
            let viewedByUrl = `http://localhost:8000/api/viewedby`;
            let access_token = localStorage.getItem('access_token');
                        
            const viewedByResponse = this.axios.get(viewedByUrl, { headers: {
                "Access-Control-Allow-Origin" : "*",
                "Content-type": "Application/json",
                "Authorization": `Bearer ${access_token}`
                }
            }).then(res => {
               let viewedByString = this.convertViewedByToString(res.data.viewed_by);
               console.log(viewedByString);
               this.viewed_by = viewedByString;
               this.viewedByLoading = false;
            });
        },
        convertViewedByToString(viewed_by) {
            let string = viewed_by[0].name;
            
            for(let i in viewed_by) {
                if(i != 0) {
                    string = string + ', ' + viewed_by[i].name;
                }
            }

            console.log(string);
            return string;
        }
    }
}

</script>

<style>

</style> 