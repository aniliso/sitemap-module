<?php namespace Modules\Sitemap\Entities\Helpers;


class SitemapPriority
{
    private $priority = ['0.0', '0.1', '0.2', '0.3', '0.4', '0.5', '0.6', '0.7', '0.8', '0.9', '1.0'];

    private $priorities;

    public function __construct()
    {
        $this->priorities = array_combine($this->priority, $this->priority);
    }

    public function lists()
    {
        return $this->priorities;
    }

    public function get($priority)
    {
        if(isset($this->priorities[$priority]))
        {
            return $this->priorities[$priority];
        }
        return $this->priorities[$this->priority[9]];
    }
}