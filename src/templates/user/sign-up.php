<h2>Sign Up</h2>
<div class="signUp">
<?php if($errors){?>
<div class="alert alert-danger">
  <strong>Внимание!</strong> <?= $errors?>.
</div>
<?php }?>
<form action="/user/register" method="POST">
    <div  class="form-group">
        <label for="">Name:</label>
        <input type="name" name="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Email:</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Password:</label>
        <input type="password" name="password" class="form-control">
    </div>
    <button class="btn btn-primary">Sing Up</button>
</form>
</div>