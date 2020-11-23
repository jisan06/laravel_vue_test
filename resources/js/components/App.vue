<template>
    <div class="page">
        <nav class='navbar navbar-dark bg-dark'>
            <div class='container'>
                <span class="navbar-brand">Airlines System</span>
                <div>
                	<router-link :to="{ name: 'home' }" class="navbar-brand">Services</router-link>

                	<router-link :to="{ name: 'passengers' }" class="navbar-brand">Passengers</router-link>
                </div>
                
            </div>
        </nav>
        <router-view></router-view>
    </div>
</template>