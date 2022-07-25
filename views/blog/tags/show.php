<div class="row">
    <div class="col-lg-7">
        <h1><?= $params['tag']->name ?></h1>
        <div class="row">
            <?php foreach ($params['tag']->getPosts() as $post): ?>
                <div class="col col-md-4">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="/posts/<?=$post->id;?>"><?= $post->title ?></a>
                            </h5>
                            <span class="text-info"><?=$post->getCreatedAt();?></span>

                            <a href="/posts/<?=$post->id?>" class="btn btn-primary">Read post</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>