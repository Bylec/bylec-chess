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

            Echo.channel('move-made')
                .listen('MoveMade', (e) => {
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
