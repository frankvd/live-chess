<?php 
namespace frankvd\LiveChess;

use IntlChar;

class Piece 
{
    const UNICODE_START = 9812;
    const WHITE = 0;
    const BLACK = 1;

    const KING   = 0;
    const QUEEN  = 1;
    const ROOK   = 2;
    const BISHOP = 3;
    const KNIGHT = 4;
    const PAWN   = 5;
    
    protected string $piece;
    protected string $color;

    public function __construct($piece = self::PAWN, $color = self::WHITE)
    {
        $this->piece = $piece;
        $this->color = $color;
    }

    public function __toString()
    {
        $codepoint = self::UNICODE_START + $this->piece + ($this->color * 6);
        return mb_chr($codepoint, 'UTF-8'); 
    }
}