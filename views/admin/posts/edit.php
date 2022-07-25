<h1>Edit post</h1>

<p>
    <a href="/admin/posts" class="btn btn-secondary">
        Back
    </a>
</p>
<form method="post" action="/admin/posts/<?=$params['post']->id?>/update">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" aria-describedby="titleHelp" name="title" value="<?= $params['post']->title ?? '' ?>">
        <div id="titleHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" rows="3" name="content">
            <?= $params['post']->content ?? '' ?>
        </textarea>
    </div>
    <div class="mb-3">
        <label for="tags" class="form-label">Tags</label>
        <select name="tags[]" id="tags" multiple class="form-control">
            <?php foreach ($params['tags'] as $tag): ?>
                <option value="<?= $tag->id ?>"
                    <?php
                        foreach ($params['post']->getTags() as $postTag){
                            echo ($tag->id === $postTag->id) ? 'selected' : '';
                        }
                    ?>
                >
                    <?= $tag->name ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>