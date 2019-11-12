<template>
    <div id="app">
        <div class="container">
            <Header/>
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    import Header from '@/js/components/Header.vue';

    export default {
        components: {
            Header
        }
    }
</script>
