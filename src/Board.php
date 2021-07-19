<?php
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

        $this->set(6, 1, new Piece());
    }

    public function walk($cellFunc, $rowFunc)
    {
        foreach ($this->cells as $row) {
            foreach ($row as $cell) {
                $cellFunc($cell);
            }
            $rowFunc();
        }
    }

    public function set($row, $column, ?Piece $piece)
    {
        $this->cells[$row][$column]->setPiece($piece);
    }
}
