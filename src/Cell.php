<?php declare(strict_types=1);
namespace frankvd\LiveChess;

class Cell 
{
    const WHITE = 0;
    const BLACK = 1;

    protected ?Piece $piece;
    protected int $color;

    public function __construct($color = self::WHITE, ?Piece $piece = null)
    {
        $this->color = $color;
        $this->piece = $piece;
    }

    public function setPiece($piece)
    {
        $this->piece = $piece;
    }

    public function __toString()
    {
        if ($this->color == self::WHITE) {
            $s = "<bg=white;fg=black> %s </>";
        } else {
            $s = "<bg=gray;fg=black> %s </>";
        }

        if (is_null($this->piece)) {
            $p = ' ';
        } else {
            $p = (string) $this->piece;
        }

        return sprintf($s, $p);
    }
}
