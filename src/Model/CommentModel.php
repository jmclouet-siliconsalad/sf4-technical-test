<?php

namespace App\Model;

class CommentModel implements ModelInterface
{
    public $depot;

    public $content;

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return [
            "depot" => $this->depot,
            "content" => $this->content,
        ];
    }
}
