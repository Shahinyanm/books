import VueRouter from 'vue-router'

import ListTeam from "../components/team/ListTeam";
import CreateTeam from "../components/team/CreateTeam";
import EditTeam from "../components/team/EditTeam";
import ListPlayer from "../components/player/ListPlayer";
import CreatePlayer from "../components/player/CreatePlayer";
import EditPlayer from "../components/player/EditPlayer";

const routes = [
    {path: '/', component: ListTeam},
    {path: '/team/create', component: CreateTeam},
    {path: '/team/edit/:id', component: EditTeam},

    {path: '/players/:team_id?', component: ListPlayer},
    {path: '/player/create', component: CreatePlayer},
    {path: '/player/edit/:id', component: EditPlayer}
];

export const router = new VueRouter({
    routes
});