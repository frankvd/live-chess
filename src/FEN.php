<?php declare(strict_types=1);
namespace frankvd\LiveChess;

class FEN
{
    public function parse(string $fen)
    {
        $board = new Board();

        $characters = str_split($fen);

        $row = 0;
        $column = 0;
        foreach ($characters as $c) {
            switch($c) {
                case '/':
                    $row++;
                    $column = 0;
                    break;
                case ' ':
                    break 2;
                default:
                    if (is_numeric($c)) {
                        $i = intval($c);
                        $column += $i;
                    } else {
                        $board->set($row, $column, $this->getPiece($c));
                        $column++;
                    }
                    break;
            }
        }

        return $board;
    }

    public function getPiece($c)
    {
        $lower = strtolower($c);
        $color = ($c == $lower) ? Piece::BLACK : Piece::WHITE;

        return [
            'p' => new Piece(Piece::PAWN, $color),
            'r' => new Piece(Piece::ROOK, $color),
            'n' => new Piece(Piece::KNIGHT, $color),
            'b' => new Piece(Piece::BISHOP, $color),
            'q' => new Piece(Piece::QUEEN, $color),
            'k' => new Piece(Piece::KING, $color),
        ][strtolower($c)];
    }
}
