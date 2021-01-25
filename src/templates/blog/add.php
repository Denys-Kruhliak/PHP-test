<h2>Add Post</h2>
<div class="add">
<?php if($errors){?>
<div class="alert alert-danger">
  <strong>Внимание!</strong> <?= $errors?>
</div>
<?php }?>
<form action="/post/add" method="POST">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="Name post" class="form-control">
    </div>
    <div class="form-group">
        <label for="text">Text:</label>
        <textarea name="text" id="text" cols="30" rows="3" class="form-control">Text post</textarea>
    </div>
    <button class="btn btn-primary">Add post</button>
</form>
</div> 