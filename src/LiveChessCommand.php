<?php declare(strict_types=1);
namespace frankvd\LiveChess;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\NativeHttpClient;

class LiveChessCommand extends Command
{
    protected function configure()
    {
        $this->setName('livechess:run');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$output instanceof ConsoleOutputInterface) {
            throw new \LogicException('This command accepts only an instance of "ConsoleOutputInterface".');
        }
        $fen = new FEN();
        $client = new NativeHttpClient();
        $response = $client->request('GET', 'https://lichess.org/api/tv/feed');

        $section = $output->section();
        foreach ($client->stream($response) as $chunk) {
            $json = json_decode($chunk->getContent(), true);
            if (!isset($json['d']['fen'])) continue;
            $board = $fen->parse($json['d']['fen']);
            $text = $board->render();
            $section->clear();
            $section->writeln($text);
        }
        
        return self::SUCCESS;
    }
}
