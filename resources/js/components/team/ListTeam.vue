<template>
    <div>
        <div class="mb-sm-2 mt-sm-2 float-left">
            <h4 class="float-left">Teams</h4>
            <input type="text" class="col-md-8 float-left form-control ml-sm-3"
                   v-model="searchKeyword"
                   @keyup="filterList"
                   placeholder="Search by Name..."/>
        </div>
        <div class="mb-sm-2 mt-sm-2 float-right">
            <router-link to="/team/create" class="btn btn-primary">Create</router-link>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="team in teams" :key="team.id">
                <th>{{team.name}}</th>
                <td>
                    <router-link :to="{path:'/players/'+team.id}" class="btn btn-success">Players</router-link>
                    <router-link :to="{path:'/team/edit/'+team.id}" class="btn btn-primary">Edit</router-link>
                    <button type="button" class="btn btn-danger" @click="deleteTeam(team.id)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    import swal from 'sweetalert';

    export default {
        data() {
            return {
                staticData: {},
                teams: {},
                searchKeyword: '',
            }
        },
        created() {
            this.$http.get('teams').then((response) => {
                this.staticData = response.data.data.teams;
                this.teams = this.staticData;
            }).catch((error) => {
                console.log(error);
            });
        },
        methods: {
            deleteTeam: function (id) {
                swal({
                    title: "Are you sure?",
                    text: "You want delete this team?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        this.$http.delete('team/' + id).then(() => {
                            let index = this.staticData.map(item => item.id).indexOf(id);
                            this.staticData.splice(index, 1);
                            this.teams = this.staticData;
                            swal("Team deleted", {
                                icon: "success",
                            });
                        });
                    }
                });
            },
            filterList() {
                this.teams = this.staticData.filter(team => {
                    return team.name.toLowerCase().includes(this.searchKeyword.toLowerCase())
                });
            }
        }
    }
</script>