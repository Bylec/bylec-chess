<template>
    <div id="board" style="width: 800px"></div>
</template>
<script>
    import chess from '@/js/chessboard/chessboard.js'

    export default {
        mounted() {
            const chessgame = new chess('board', {
                draggable: true,
                position: 'start',
            })

            // Echo.private('move-made.5')
            //     .listen('MoveMade', (e) => {
            //         chessgame.makeMove(e.move)
            //         console.log(chessgame.getCurrentPosition())
            //         console.log('ele')
            //     })

            Echo.join('move-made.5')
                .here((users) => {
                    console.log('here');
                    console.log(users);
                })
                .joining((user) => {
                    console.log('joining');
                    console.log(user);
                })
                .leaving((user) => {
                    console.log('leaving');
                    console.log(user);
                })
                .listen('MoveMade', (e) => {
                    console.log('making move');
                    chessgame.makeMove(e.move)
                })
        },
        methods: {
            resetPosition() {
                console.log('reset position');
            }
        }
    };
</script>
