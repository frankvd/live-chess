<?php declare(strict_types=1);
namespace frankvd\LiveChess;

class Board
{
    protected $cells;

    public function __construct()
    {
        $this->cells = [];

        foreach (range(0, 7) as $row) {
            foreach (range(0, 7) as $column) {
                $this->cells[$row][$column] = new Cell(($row+$column) % 2);
            }
        }
    }

    public function render()
    {
        $out = '';
        foreach ($this->cells as $row) {
            foreach ($row as $cell) {
                $out .= (string) $cell;
            }
            $out .= "\n";
        }
        
        return $out;
    }

    public function set($row, $column, ?Piece $piece)
    {
        $this->cells[$row][$column]->setPiece($piece);
    }
}
