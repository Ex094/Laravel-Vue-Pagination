<template>
    <div class="container">
        <div class="row">

            <div class="col-md-4 mt-2">
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" placeholder="Search Users" v-model="searchTerm">
                </div>
            </div>


            <div class="col-md-12">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users">
                      <th scope="row">{{ user.id }}</th>
                      <td>{{ user.name }}</td>
                      <td>{{ user.email }}</td>
                    </tr>
                  </tbody>
                </table>

                <div class="d-flex flex-row-reverse">
                    <nav aria-label="Page navigation example">
                      <ul class="pagination">
                        <li :class="activePage == page ? 'page-item active' : 'page-item'" v-for="page in totalPages">
                            <a @click="paginationHandler(`${paginatePath}?page=${page}`, page)" class="page-link" href="#">{{ page }}</a>
                        </li>
                      </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                users: [],
                activePage: 1,
                paginatePath: '',
                totalPages: 0,
                searchTerm: '',
            };
        },

        mounted() {
           this.fetchUsers(); 
        },

        watch: {
            // On Search Input Change
            searchTerm(newVal, oldVal) {
                this.searchUsers(newVal);
            }
        },

        methods: {
            // Fetch Users
            fetchUsers(pageUrl = null) {

                let url = '/api/users';

                if(pageUrl != null) url = pageUrl; 

                axios.get(url)
                .then( response => {
                        this.paginatePath = response.data.path;
                        this.totalPages = response.data.last_page;
                        this.users = response.data.data;
                })
                .catch( error => {
                    console.log(error);
                });
            },

            paginationHandler(url, page) {
                this.fetchUsers(url);
                this.activePage = page;
            },

            // Search User
            searchUsers(term) {
              axios.get(`/api/users/search/${term}`).then( response => {
                this.totalPages = response.data.last_page;
                this.users = response.data.data; 
            })
              .catch( error => { console.log(error) });
            }
        }
    };
</script>
