<h1>All posts</h1>

<div class="row">
    <?php foreach ($params['posts'] as $post): ;?>
        <div class="col col-md-4">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/posts/<?=$post->id;?>"><?= $post->title ?></a>
                    </h5>
                    <div class="">
                        <?php foreach ($post->getTags() as $tag) : ?>
                            <a href="/tags/<?=$tag->id?>" class="badge bg-info"><?= $tag->name ?></a>
                        <?php endforeach; ?>
                    </div>
                    <span class="text-info"><?=$post->getCreatedAt();?></span>
                    <p class="card-text">
                        <?= $post->getExcerpt() ;?>
                    </p>
                    <a href="/posts/<?=$post->id?>" class="btn btn-primary">Read post</a>
                </div>
            </div>
        </div>
    <?php endforeach;?>
</div>
