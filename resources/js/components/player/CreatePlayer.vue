<template>
    <form class="col-md-3" @submit.prevent="handleSubmit">
        <h4 class="mb-sm-2 mt-sm-2">Create Player</h4>
        <div class="form-group">
            <label for="first_name" class="control-label">First Name</label>
            <input type="text" class="form-control" id="first_name"
                   v-model="teamMember.first_name"
                   :class="{'is-invalid': errors.first_name}">
            <div class="invalid-feedback" v-if="errors.first_name">
                {{errors.first_name[0]}}
            </div>
        </div>
        <div class="form-group">
            <label for="last_name" class="control-label">Last Name</label>
            <input type="text" class="form-control" id="last_name"
                   v-model="teamMember.last_name"
                   :class="{'is-invalid': errors.last_name}">
            <div class="invalid-feedback" v-if="errors.last_name">
                {{errors.last_name[0]}}
            </div>
        </div>
        <div class="form-group">
            <label for="team" class="control-label">Team</label>
            <select class="form-control" id="team"
                    v-model="teamMember.team_id"
                    :class="{'is-invalid': errors.team_id}">
                <option :value="0">Select Team</option>
                <option v-for="team in teams" :value="team.id">{{team.name}}</option>
            </select>
            <div class="invalid-feedback" v-if="errors.team_id">
                {{errors.team_id[0]}}
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                teams: {},
                teamMember: {
                    first_name: "",
                    last_name: "",
                    team_id: 0
                },
                errors: {}
            }
        },
        mounted() {
            this.$http.get('teams').then((response) => {
                this.teams = response.data.data.teams;
            }).catch((error) => {
                console.log(error);
            });
        },
        methods: {
            handleSubmit: function (e) {
                this.errors = {};
                e.preventDefault();
                this.$http.post('player/create', this.teamMember).then(() => {
                    this.$router.push('/');
                }).catch((error) => {
                    this.errors = error.response.data.errors.validation;
                });
            }
        }
    }
</script>
