<template>
    <div class="full-view-component">
        <RegularNavBar />
        <div class="message-fullview">
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
                        <th>Read By All</th>
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
                        <td>{{ message.viewed_by }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import RegularNavBar from './RegularNavBar';

export default {
    components: { 
        'RegularNavBar': RegularNavBar
    },
    data () {
        return {
            message: []
        }
    },
    created () {
        this.markAsRead();
        let message_view_id = localStorage.getItem('message_view_id');

        let url = `http://localhost:8000/api/message/${message_view_id}`;

        let access_token = localStorage.getItem('access_token');

        const fetchedData = this.axios.get( url, { headers: {
            "Access-Control-Allow-Origin" : "*",
            "Content-type": "Application/json",
            "Authorization": `Bearer ${access_token}`
            }
        }).then(response => {
            this.message = response.data.message
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
        getMessage() {
            let message_view_id = localStorage.getItem('message_view_id');

            let url = `http://localhost:8000/api/message/${message_view_id}`;

            let access_token = localStorage.getItem('access_token');

            const fetchedData = this.axios.get( url, { headers: {
                    "Access-Control-Allow-Origin" : "*",
                    "Content-type": "Application/json",
                    "Authorization": `Bearer ${access_token}`
                }
            }).then(response => { 
                //console.log(response.data.message);
            });
        },
        fetchViewedBy() {
            let viewedByUrl = `http://localhost:8000/api/viewedby`;
            let access_token = localStorage.getItem('access_token');
                        
            const viewedByResponse = this.axios.get(viewedByUrl, { headers: {
                "Access-Control-Allow-Origin" : "*",
                "Content-type": "Application/json",
                "Authorization": `Bearer ${access_token}`
                }
            }).then(res => {
                console.log(res);
            });
        }
    }
}

</script>

<style>

</style> 