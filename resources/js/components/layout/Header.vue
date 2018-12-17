<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <router-link to="/" class="navbar-brand">Test Task Team Player</router-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <router-link to="/" tag="li" class="nav-item" exactActiveClass="active">
                    <a class="nav-link">Teams</a>
                </router-link>
                <router-link to="/players" path="f" tag="li" class="nav-item" activeClass="active">
                    <a class="nav-link">Players</a>
                </router-link>
            </ul>
        </div>
    </nav>
</template>
