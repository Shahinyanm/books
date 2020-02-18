<template>
    <form class="col-md-3" @submit.prevent="handleSubmit">
        <h4 class="mb-sm-2 mt-sm-2">Create Book</h4>
        <div class="form-group">
            <label for="title" class="control-label">Title</label>
            <input type="text" class="form-control" id="title"
                   v-model="authorMember.title"
                   :class="{'is-invalid': errors.title}">
            <div class="invalid-feedback" v-if="errors.title">
                {{errors.title[0]}}
            </div>
        </div>
        <div class="form-group">
            <label for="published_at" class="control-label">Last Name</label>
            <input type="text" class="form-control" id="published_at"
                   v-model="authorMember.published_at"
                   :class="{'is-invalid': errors.published_at}">
            <div class="invalid-feedback" v-if="errors.published_at">
                {{errors.published_at[0]}}
            </div>
        </div>
        <div class="form-group">
            <label for="author" class="control-label">Author</label>
            <select class="form-control" id="author"
                    v-model="authorMember.author_id"
                    :class="{'is-invalid': errors.author_id}">
                <option :value="0">Select Author</option>
                <option v-for="author in authors" :value="author.id">{{author.name}}</option>
            </select>
            <div class="invalid-feedback" v-if="errors.author_id">
                {{errors.author_id[0]}}
            </div>
        </div>

        <div class="form-group">
            <label for="genre" class="control-label">Genre</label>
            <select class="form-control" id="genre"
                    v-model="authorMember.genre_id"
                    :class="{'is-invalid': errors.genre_id}">
                <option :value="0">Select Genre</option>
                <option v-for="genre in genres" :value="genre.id">{{genre.name}}</option>
            </select>
            <div class="invalid-feedback" v-if="errors.author_id">
                {{errors.author_id[0]}}
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                authors: {},
                genres: {},
                authorMember: {
                    title: "",
                    published_id: "",
                    author_id: 0,
                    genre_id: 0
                },
                errors: {}
            }
        },
        mounted() {
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
                this.errors = {};
                e.preventDefault();
                this.$http.post('book/create', this.authorMember).then(() => {
                    this.$router.push('/');
                }).catch((error) => {
                    this.errors = error.response.data.errors.validation;
                });
            }
        }
    }
</script>
