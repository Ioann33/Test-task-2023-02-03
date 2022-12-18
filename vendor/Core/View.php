<?php


namespace Core;


class View
{
    const VIEWS_DIR = 'Views';
    /**
     * name of template file
     * @var string
     */
    protected $template = 'default';

    /**
     * View constructor.
     * @param string|null $template
     */
    public function __construct(string $template = null)
    {
        if ($template !== null){
            $this->template = $template;
        }
    }

    public function render(string $pageTemplate,array $data = []){
        extract($data);
        include_once 'vendor'.DIRECTORY_SEPARATOR.self::VIEWS_DIR.DIRECTORY_SEPARATOR.$this->template.'.php';
    }
}