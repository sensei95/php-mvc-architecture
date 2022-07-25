<div class="row">
    <div class="col-lg-7">
        <h1><?= $params['post']->title ?></h1>
        <?php if(!empty($params['post'])):?>
            <div class="">
                <?php foreach ($params['post']->getTags() as $tag) : ?>
                    <a href="/tags/<?=$tag->id?>" class="badge bg-info"><?= $tag->name ?></a>
                <?php endforeach; ?>
            </div>
        <?php endif;?>
        <span class="badge bg-secondary"><?= $params['post']->getCreatedAt(); ?></span>
        <div class="">
            <?= nl2br($params['post']->content);?>
        </div>
    </div>
</div>