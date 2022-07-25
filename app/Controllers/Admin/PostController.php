<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    public function index()
    {
        $this->isAdmin();

        $posts = (new Post($this->getDB()))->all();

        return $this->view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $this->isAdmin();

        $tags = (new Tag($this->getDB()))->all();
        return $this->view('admin.posts.create',compact('tags'));
    }

    public function store()
    {
        $this->isAdmin();

        if(isset($_POST['submit'])){
            extract($_POST);
            if($title && $content){
                $post = (new Post($this->getDB()))->create([
                    'title' => $title,
                    'content' => $content
                ],['tags' => $tags]);

                if($post){
                    return header("Location: /admin/posts");
                }
            }
            return header("Location: /admin/posts/create");
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();

        $post = (new Post($this->getDB()))->findById($id);
        $tags = (new Tag($this->getDB()))->all();
        return $this->view('admin.posts.edit',compact('post','tags'));
    }

    public function update(int $id)
    {
        $this->isAdmin();

        if(isset($_POST['submit']))
        {
            ['title' => $title, 'content' => $content, 'tags' => $tags] = $_POST;
            if($title && $content){

                $post = new Post($this->getDB());
                if($post->update($id, ['title' => $title, 'content' => $content],['tags' => $tags])){
                    return header("Location: /admin/posts");
                }

            }
            return header("Location: /admin/posts/$id/edit");
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();

        $post = (new Post($this->getDB()));
        $result = $post->destroy($id);

        if($result){
            return header('Location: /admin/posts');
        }
    }
}