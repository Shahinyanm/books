<template>
    <form class="col-md-3" v-on:submit.prevent="handleSubmit">
        <div class="alert alert-success" role="alert" v-if="updated">
            <strong>Success!</strong> Player is updated
        </div>
        <h4 class="mb-sm-2 mt-sm-2">Edit Team</h4>
        <div class="form-group">
            <label for="first_name" class="control-label">First Name</label>
            <input type="text" class="form-control" id="first_name" v-model="form.first_name"
                   :class="{'is-invalid': errors.first_name}">
            <div class="invalid-feedback" v-if="errors.first_name">
                {{errors.first_name[0]}}
            </div>
        </div>
        <div class="form-group">
            <label for="last_name" class="control-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" v-model="form.last_name"
                   :class="{'is-invalid': errors.last_name}">
            <div class="invalid-feedback" v-if="errors.last_name">
                {{errors.last_name[0]}}
            </div>
        </div>
        <div class="form-group">
            <label for="team" class="control-label">Team</label>
            <select class="form-control" v-model="form.team_id" id="team" :class="{'is-invalid': errors.team_id}">
                <option :value="0">Select Team</option>
                <option v-for="team in teams" :value="team.id">{{team.name}}</option>
            </select>
            <div class="invalid-feedback" v-if="errors.team_id">
                {{errors.team_id[0]}}
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                id: this.$route.params.id,
                updated: false,
                teams: {},
                form: {
                    name: ""
                },
                errors: {}
            }
        },
        mounted() {
            this.$http.get('player/' + this.id).then((response) => {
                this.form = response.data.data.player;
            }).catch((error) => {
                this.errors = error.response.data.errors.validation;
            });

            this.$http.get('teams').then((response) => {
                this.teams = response.data.data.teams;
            }).catch((error) => {
                console.log(error);
            });
        },
        methods: {
            handleSubmit: function (e) {
                e.preventDefault();
                this.updated = false;
                this.errors = {};
                this.$http.post('player/' + this.id, this.form).then(() => {
                    this.updated = true;
                }).catch((error) => {
                    this.errors = error.response.data.errors.validation;
                });
            }
        }
    }
</script>
