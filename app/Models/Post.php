<?php

namespace App\Models;

use DateTime;
use Exception;

class Post extends Model
{

    protected string $table = 'posts';

    /**
     * @return string
     * @throws Exception
     */
    public function getCreatedAt(): string
    {
        return (new DateTime($this->created_at))->format('d/m/Y  H:i');
    }

    /**
     * @return string
     */
    public function getExcerpt(): string
    {
        return nl2br(substr($this->content, 0, 80)).' ...';
    }

    public function getTags()
    {
        return $this->query("
                            select tags.id , tags.name from tags 
                            inner join (posts, post_tag) 
                            on (tags.id = post_tag.tag_id and posts.id = post_tag.post_id) where posts.id = ?
                           ",
                        [$this->id]
                    );

    }

    public function getTagsToString()
    {
        if(!empty($tags = $this->getTags())){
            $names = [];

            foreach ($tags as $tag){
                $names[] = $tag->name;
            }
            return implode(',',$names);
        }
        return "";

        return implode(', ',$this->getTags());
    }

    /**
     * @param int $id
     * @param array $data
     * @param array|null $relations
     * @return bool| mixed
     */
    public function update(int $id, array $data, ?array $relations = null): mixed
    {
        parent::update($id, $data);
        $oldTagsDeleted = $this->query("DELETE FROM post_tag WHERE post_id =  ?",[$id]);

        if($oldTagsDeleted){
            foreach ($relations['tags'] as $tagId){
                $this->query("INSERT INTO post_tag (post_id, tag_id) VALUES (?, ?)",[$id, $tagId]);
            }

            return true;
        }
        return false;
    }

    /**
     * @param array $data
     * @param array|null $relations
     * @return bool | mixed
     */
    public function create(array $data, ?array $relations = null): mixed
    {
        if(parent::create($data)){
            $id = $this->db->getPDO()->lastInsertId();

            foreach ($relations['tags'] as $tagId){
                $this->query("INSERT INTO post_tag (post_id, tag_id) VALUES (?, ?)",[$id, $tagId]);
            }
            return true;
        }
        return false;
    }
}