<h2>Edit post</h2>
<div class="edit">
<?php if($errors){?>
<div class="alert alert-danger">
  <strong>Внимание!</strong> <?= $errors?>
</div>
<?php }?>
<form action="/post/edit?id=<?= $post->getId()?>" method="POST">
    <input type="hidden" name="_method" value="UPDATE">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?= $post->getName()?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="text">Text:</label>
        <textarea name="text" id="text" cols="30" rows="3" class="form-control"><?= $post->getText()?></textarea>
    </div>
    <div class="form-group">
        <label for="author">Author:</label>
        <select name="author" id="author" class="form-control">
        <?php foreach($authors as $author):?>
            <option value="<?= $author->getId()?>" <?= ($post->getAuthorId()== $author->getId())? 'selected' :'' ?>>
                <?= $author->getName()?>
            </option>
        <?php endforeach;?>
        </select>
    </div>
    <button class="btn btn-primary">Save post</button>
</form>
</div>






