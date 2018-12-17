<template>
    <div>
        <div class="mb-sm-2 mt-sm-2 float-left">
            <h4 class="float-left">Players</h4>
            <input type="text" v-model="searchKeyword" class="col-md-8 float-left form-control ml-sm-3"
                   @keyup="filterList"
                   placeholder="Search by First Name..."/>
        </div>
        <div class="mb-sm-2 mt-sm-2 float-right">
            <router-link to="/player/create" class="btn btn-primary">Create</router-link>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Team</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="player in players" :key="player.id">
                <th>{{player.first_name}}</th>
                <th>{{player.last_name}}</th>
                <th>{{player.team.name}}</th>
                <td>
                    <router-link :to="{path:'/player/edit/'+player.id}" class="btn btn-primary">Edit</router-link>
                    <button type="button" class="btn btn-danger" @click="deletePlayer(player.id)">Delete</button>
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
                players: {},
                searchKeyword: ""
            }
        },
        created() {
            let teamId = this.$route.params.team_id ? this.$route.params.team_id : '';
            this.$http.get('players/' + teamId).then((response) => {
                this.staticData = response.data.data.players;
                this.players = this.staticData;
            }).catch((error) => {
                console.log(error);
            });
        },
        methods: {
            deletePlayer: function (id) {
                swal({
                    title: "Are you sure?",
                    text: "You want delete this player?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        this.$http.delete('player/' + id).then(() => {
                            let index = this.staticData.map(item => item.id).indexOf(id);
                            this.staticData.splice(index, 1);
                            this.players = this.staticData
                            swal("Player deleted", {
                                icon: "success",
                            });
                        });
                    }
                });
            },
            filterList() {
                this.players = this.staticData.filter(player => {
                    return player.first_name.toLowerCase().includes(this.searchKeyword.toLowerCase());
                });
            }
        }
    }
</script>
