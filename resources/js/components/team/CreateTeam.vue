<template>
    <form class="col-md-3" v-on:submit.prevent="handleSubmit">
        <h4 class="mb-sm-2 mt-sm-2">Create Team</h4>
        <div class="form-group">
            <label for="name" class="control-label">Name</label>
            <input type="text" class="form-control" id="name" v-model="form.name" :class="{'is-invalid': errors.name}">
            <div class="invalid-feedback" v-if="errors.name">
                {{errors.name[0]}}
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    name: ""
                },
                errors: {}
            }
        },
        methods: {
            handleSubmit: function (e) {
                this.errors={};
                e.preventDefault();
                this.$http.post('team/create', this.form).then(() => {
                    this.$router.push('/');
                }).catch((error) => {
                    this.errors = error.response.data.errors.validation;
                });
            }
        }
    }
</script>
