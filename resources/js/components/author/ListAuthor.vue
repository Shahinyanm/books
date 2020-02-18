<template>
    <div>
        <div class="mb-sm-2 mt-sm-2 float-left">
            <h4 class="float-left">Authors</h4>
            <input type="text" class="col-md-8 float-left form-control ml-sm-3"
                   v-model="searchKeyword"
                   @keyup="filterList"
                   placeholder="Search by Name..."/>
        </div>
        <div class="mb-sm-2 mt-sm-2 float-right">
            <router-link to="/author/create" class="btn btn-primary">Create</router-link>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="author in authors" :key="author.id">
                <th>{{author.name}}</th>
                <td>
                    <router-link :to="{path:'/books/'+author.id}" class="btn btn-success">Books</router-link>
                    <router-link :to="{path:'/author/edit/'+author.id}" class="btn btn-primary">Edit</router-link>
                    <button type="button" class="btn btn-danger" @click="deleteAuthor(author.id)">Delete</button>
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
                authors: {},
                searchKeyword: '',
            }
        },
        created() {
            this.$http.get('authors').then((response) => {
                this.staticData = response.data.data.authors;
                this.authors = this.staticData;
            }).catch((error) => {
                console.log(error);
            });
        },
        methods: {
            deleteAuthor: function (id) {
                swal({
                    title: "Are you sure?",
                    text: "You want delete this author?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        this.$http.delete('author/' + id).then(() => {
                            let index = this.staticData.map(item => item.id).indexOf(id);
                            this.staticData.splice(index, 1);
                            this.authors = this.staticData;
                            swal("Author deleted", {
                                icon: "success",
                            });
                        });
                    }
                });
            },
            filterList() {
                this.authors = this.staticData.filter(author => {
                    return author.name.toLowerCase().includes(this.searchKeyword.toLowerCase())
                });
            }
        }
    }
</script>
