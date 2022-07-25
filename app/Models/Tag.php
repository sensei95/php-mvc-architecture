<?php

namespace App\Models;

use DateTime;
use Exception;

class Tag extends Model
{
    protected string $table = 'tags';

    /**
     * @return string
     * @throws Exception
     */
    public function getCreatedAt(): string
    {
        return (new DateTime($this->created_at))->format('d/m/Y  H:i');
    }

    public function getPosts()
    {
        return $this->query("
                            select posts.id , title, content, posts.created_at from posts 
                            inner join (post_tag) 
                            on (posts.id = post_tag.post_id) where post_tag.tag_id = ?
                           ",
            [$this->id]);
    }
}