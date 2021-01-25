<div class="show">
    <h2><?= $post->getName() ?></h2>
    <h6><?= $post->getAuthor()->getName() ?></h6>
    <h6><?= $post->getCreated_at() ?></h6>
    <p><?= $post->getText() ?></p>
</div>