<?php

namespace App\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    public function show(int $id)
    {
        $tag = new Tag($this->getDB());
        $tag = $tag->findById($id);

        return $this->view('blog.tags.show', compact('tag'));
    }
}