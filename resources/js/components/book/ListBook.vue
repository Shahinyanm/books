<template>
    <div>
        <div class="mb-sm-2 mt-sm-2 float-left">
            <h4 class="float-left">Books</h4>
            <input type="text" v-model="searchKeyword" class="col-md-8 float-left form-control ml-sm-3"
                   @keyup="filterList"
                   placeholder="Search by title..."/>
        </div>
        <div class="mb-sm-2 mt-sm-2 float-right">
            <router-link to="/book/create" class="btn btn-primary">Create</router-link>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>published_at</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="book in books" :key="book.id">
                <th>{{book.title}}</th>
                <th>{{book.published_at}}</th>
                <th>{{book.author.name}}</th>
                <th>{{book.genre.genre}}</th>
                <td>
                    <router-link :to="{path:'/book/edit/'+book.id}" class="btn btn-primary">Edit</router-link>
                    <button type="button" class="btn btn-danger" @click="deleteBook(book.id)">Delete</button>
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
                books: {},
                searchKeyword: ""
            }
        },
        created() {
            let teamId = this.$route.params.team_id ? this.$route.params.team_id : '';
            this.$http.get('books/' + teamId).then((response) => {
                this.staticData = response.data.data.books;
                this.books = this.staticData;
            }).catch((error) => {
                console.log(error);
            });
        },
        methods: {
            deleteBook: function (id) {
                swal({
                    title: "Are you sure?",
                    text: "You want delete this book?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        this.$http.delete('book/' + id).then(() => {
                            let index = this.staticData.map(item => item.id).indexOf(id);
                            this.staticData.splice(index, 1);
                            this.books = this.staticData
                            swal("Book deleted", {
                                icon: "success",
                            });
                        });
                    }
                });
            },
            filterList() {
                this.books = this.staticData.filter(book => {
                    return book.title.toLowerCase().includes(this.searchKeyword.toLowerCase());
                });
            }
        }
    }
</script>
