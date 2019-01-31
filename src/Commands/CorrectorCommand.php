<?php

namespace SmartHawk\Commands;

use SmartHawk\Utils\JsonBracketCorrector;
use SmartHawk\Exceptions\InvalidArgumentException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;


class CorrectorCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('correctors')
            ->setDescription('some description');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new Question('Введите необходимые скобки: ', '');
        $brackets = $helper->ask($input, $output, $question);

        try {
            $message = 'Введенные строки ' . (JsonBracketCorrector::check($brackets) ? 'корректны' : 'не корректны');
        } catch (InvalidArgumentException $e) {
            $message = 'Введенные скобки содержат неверные символы';
        } catch (\Exception $e) {
            $message = 'Произошла ошибка: ' . $e->getMessage();
        }

        $output->writeln($message);
    }
}