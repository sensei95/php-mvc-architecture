<h1>Posts's Admin</h1>
<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success" role="alert">You logged in successfully</div>
<?php endif; ?>
<p>
    <a href="/admin/posts/create" class="btn btn-primary">
        Create a new post
    </a>
</p>
<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($params['posts'] as $post): ;?>
        <tr>
            <td><?= $post->id ?></td>
            <td><?= $post->title ?></td>
            <td class="text-sm-center"><?= $post->getCreatedAt() ?></td>
            <td>
                <div class="btn-group btn-group-sm">
                    <a href="/admin/posts/<?=$post->id?>/edit" class="btn btn-warning">Edit</a>
                    <form action="/admin/posts/<?=$post->id?>/delete" method="post">
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
