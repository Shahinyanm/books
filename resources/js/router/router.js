import VueRouter from 'vue-router'

import ListAuthor from "../components/author/ListAuthor";
import CreateAuthor from "../components/author/CreateAuthor";
import EditAuthor from "../components/author/EditAuthor";
import ListBook from "../components/book/ListBook";
import CreateBook from "../components/book/CreateBook";
import EditBook from "../components/book/EditBook";

const routes = [
    {path: '/', component: ListAuthor},
    {path: '/author/create', component: CreateAuthor},
    {path: '/author/edit/:id', component: EditAuthor},

    {path: '/books/:author_id?', component: ListBook},
    {path: '/book/create', component: CreateBook},
    {path: '/book/edit/:id', component: EditBook}
];

export const router = new VueRouter({
    routes
});
