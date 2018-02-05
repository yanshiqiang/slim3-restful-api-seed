<?php

namespace App\Command\Post;

use App\Command\Command;
use App\Model\PostModel;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class PostCreateCommand
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Command
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class PostCreateCommand extends Command
{

    /**
     * 
     * @return array
     */
    public function arguments(): array
    {
        return [
            ['title', InputArgument::REQUIRED, 'The title of the post.'],
            ['content', InputArgument::REQUIRED, 'The content of the post.']
        ];
    }

    /**
     * 
     * @return string
     */
    public function description(): string
    {
        return '';
    }

    /**
     * 
     * @return void
     */
    public function handle()
    {
        $repeat = $this->option('repeat');
        $progress = new ProgressBar($this->output(), $repeat);
        $progress->start();

        for ($i = 0; $i < $repeat; $i ++) {
            $post = new PostModel;
            $post->title = $this->argument('title');
            $post->content = $this->argument('content');
            $post->save();

            $this->writeInfo(sprintf('Post #%s created!', $post->id));
            $progress->advance();
        }
        $progress->finish();
    }

    /**
     * 
     * @return string
     */
    public function help(): string
    {
        return '';
    }

    /**
     * 
     * @return string
     */
    public function name(): string
    {
        return 'post:create';
    }

    /**
     * 
     * @return array
     */
    public function options(): array
    {
        return [
            ['repeat', 'r', InputOption::VALUE_OPTIONAL, 'Times to repeat output', 1]
        ];
    }

}
