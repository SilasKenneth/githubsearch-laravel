<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            @verbatim
            <div class="container" id="root">
                <div class="title m-b-md">
                    <h2>GitHub Users</h2>
                    <button @click="shuffle">Shuffle users</button>
                </div>
                <div class="search">
                    <search-form>
                        <input class="input" placeholder="Search here" type="text" v-model="searchText" v-on:keyup.enter="search"  />
                        <button class="btn" @click="search">Search</button>
                    </search-form>
                </div>
                <br><br>
                <h3 v-if="!fetched">Loading...</h3>
                <div v-if="fetched">
                    <h2 v-show="false"> Search results for {{searchText}} </h2>
                   <github-users-item v-for="user in users" v-bind:key="user.id" :user="user">
                    <a :href="user.html_url">
                        <h3>{{user.login}}</h3>
                        <img :src="user.avatar_url" class="avatar">
                    </a>
                   </github-users-item>
                </div>
                <script type="text/x-template" id="user-template">
                    <div>
                        <slot></slot>
                    </div>
                </script>
                <script type="text/x-template" id="search-form">
                    <p id="searchform">
                        <slot></slot>
                    </p>
                </script>
            </div>
            @endverbatim

        </div>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
        <script src="/js/app.js"></script>
    </body>
</html>
