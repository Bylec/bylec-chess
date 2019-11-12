import chessboard from '@/../node_modules/@chrisoakman/chessboardjs/dist/chessboard-1.0.0.js';
import axios from 'axios';

class chess {
    constructor(initialElement, config) {
        this.setIsAllowedToMove(true);
        this.onDrop = this.onDrop.bind(this)
        config.onDrop = this.onDrop
        this.board = Chessboard(initialElement, config);
    }

    onDrop(source, target, piece, newPos, oldPos, orientation) {
        if (this.isAllowedToMove()) {
            this.sendMove()
                .then(response => {
                    this.setIsAllowedToMove(false)
                })
                .catch(err => {
                    this.setIsAllowedToMove(true)
                })
        } else {
            setTimeout(() => {
                this.board.position(oldPos, false)
            }, 1)
        }
    }

    isAllowedToMove() {
        return this.allowedToMove;
    }

    setIsAllowedToMove(isAllowed) {
        this.allowedToMove = isAllowed;
    }

    sendMove() {
        return axios.get('api/test')
    }

}

export default chess
