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
        }
    };
</script>
