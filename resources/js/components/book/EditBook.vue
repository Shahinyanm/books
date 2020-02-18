<template>
    <form class="col-md-3" v-on:submit.prevent="handleSubmit">
        <div class="alert alert-success" role="alert" v-if="updated">
            <strong>Success!</strong> Book is updated
        </div>
        <h4 class="mb-sm-2 mt-sm-2">Edit Author</h4>
        <div class="form-group">
            <label for="title" class="control-label">Title</label>
            <input type="text" class="form-control" id="title" v-model="form.title"
                   :class="{'is-invalid': errors.title}">
            <div class="invalid-feedback" v-if="errors.title">
                {{errors.title[0]}}
            </div>
        </div>
        <div class="form-group">
            <label for="published_at" class="control-label">Published</label>
            <input type="date" class="form-control" id="published_at" v-model="form.published_at"
                   :class="{'is-invalid': errors.published_at}">
            <div class="invalid-feedback" v-if="errors.published_at">
                {{errors.published_at[0]}}
            </div>
        </div>
        <div class="form-group">
            <label for="author" class="control-label">Author</label>
            <select class="form-control" v-model="form.author_id" id="author" :class="{'is-invalid': errors.author_id}">
                <option :value="0">Select Author</option>
                <option v-for="author in authors" :value="author.id">{{author.name}}</option>
            </select>
            <div class="invalid-feedback" v-if="errors.author_id">
                {{errors.author_id[0]}}
            </div>
        </div>
        <div class="form-group">
            <label for="author" class="control-label">Genre</label>
            <select class="form-control" v-model="form.genre_id" id="genre" :class="{'is-invalid': errors.genre_id}">
                <option :value="0">Select Genre</option>
                <option v-for="genre in genres" :value="genre.id">{{genre.genre}}</option>
            </select>
            <div class="invalid-feedback" v-if="errors.genre_id">
                {{errors.genre_id[0]}}
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
                authors: {},
                genres: {},
                form: {
                    title: "",
                    published_at:'31.05.2018'
                },
                errors: {}
            }
        },
        mounted() {
            this.$http.get('book/' + this.id).then((response) => {
                this.form = response.data.data.book;
            }).catch((error) => {
                this.errors = error.response.data.errors.validation;
            });

            this.$http.get('authors').then((response) => {
                this.authors = response.data.data.authors;
            }).catch((error) => {
                console.log(error);
            });

            this.$http.get('genres').then((response) => {
                this.genres = response.data.data.genres;
            }).catch((error) => {
                console.log(error);
            });
        },
        methods: {
            handleSubmit: function (e) {
                e.preventDefault();
                this.updated = false;
                this.errors = {};
                this.$http.post('book/' + this.id, this.form).then(() => {
                    this.updated = true;
                }).catch((error) => {
                    this.errors = error.response.data.errors.validation;
                });
            }
        }
    }
</script>
