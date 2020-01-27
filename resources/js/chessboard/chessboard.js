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
            this.sendMove([source, target])
                .then(response => {
                    if (response.data) {
                        this.setIsAllowedToMove(false)
                    } else {
                        this.setPreviousPosition(oldPos, false)
                    }
                })
                .catch(err => {
                    this.setIsAllowedToMove(true)
                    this.setPreviousPosition(oldPos, false)
                })
        } else {
            setTimeout(() => {
                this.setPreviousPosition(oldPos, false)
            }, 1)
        }
    }

    setPreviousPosition(oldPos)
    {
        this.board.position(oldPos, false)
    }

    isAllowedToMove() {
        return this.allowedToMove;
    }

    setIsAllowedToMove(isAllowed) {
        this.allowedToMove = isAllowed;
    }

    sendMove(moves) {
        return axios.post('api/move', moves)
    }

    makeMove(moves) {
        this.board.move(moves.join('-'))
        this.setIsAllowedToMove(true)
    }

}

export default chess
