<template>
    <form class="col-md-3" v-on:submit.prevent="handleSubmit">
        <div class="alert alert-success" role="alert" v-if="updated">
            <strong>Success!</strong> Team is updated
        </div>
        <h4 class="mb-sm-2 mt-sm-2">Edit Team</h4>
        <div class="form-group">
            <label for="name" class="control-label">Name</label>
            <input type="text" class="form-control" id="name" v-model="form.name" :class="{'is-invalid': errors.name}">
            <div class="invalid-feedback" v-if="errors.name">
                {{errors.name[0]}}
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
                form: {
                    name: ""
                },
                errors: {}
            }
        },
        mounted() {
            this.$http.get('team/' + this.id).then((response) => {
                this.form = response.data.data.team;
            }).catch((error) => {
                this.errors = error.response.data.errors.validation;
            });
        },
        methods: {
            handleSubmit: function (e) {
                e.preventDefault();
                this.updated = false;
                this.errors = {};
                this.$http.post('team/' + this.id, this.form).then(() => {
                    this.updated = true;
                }).catch((error) => {
                    this.errors = error.response.data.errors.validation;
                });
            }
        }
    }
</script>
