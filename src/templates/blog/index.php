<h2><?= $title ?></h2>
<h4><a href="post/add">Add Post <i class="fas fa-plus"></i></a></h4>
<?php foreach($posts as $post): ?>
<article >
    <h3><a href="/post?id=<?= $post->getId()?>"><?= $post->getName()?></a></h3>
    <p><?= $post->getText()?></p>
    <div class="index-blog">
        <a href="/post/edit?id=<?= $post->getId()?>">Edit</a>
        <a href="" class="delete-post" data-id="<?= $post->getId()?>">Delete</a>
    </div>
</article> 
<?php endforeach;?>
