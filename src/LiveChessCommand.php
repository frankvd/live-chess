<?php declare(strict_types=1);

namespace frankvd\LiveChess;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LiveChessCommand extends Command
{
    protected function configure()
    {
        $this->setName('livechess:run');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fen = new FEN();
        $board = $fen->parse('rnbqkbnr/pp1ppppp/8/2p5/4P3/8/PPPP1PPP/RNBQKBNR w KQkq c6 0 2');

        $board->walk(function(Cell $cell) use ($output) {
            $output->write((string) $cell);
        }, function() use ($output) {
            $output->writeln('');
        });
        
        return self::SUCCESS;
    }
}
