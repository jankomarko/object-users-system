<?php
?>
<form action="index.php?opcija=login" method="post">
    <div align="center" class="form-group row">
        <label for="inputUsername" class="col-sm-2 col-form-label">Username:</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="inputUsername" name="username">
        </div>
    </div>
    <div align="center" class="form-group row">
        <label align="center" for="inputPassword3" class="col-sm-2 col-form-label">Password:</label>
        <div class="col-sm-2">
            <input type="password" class="form-control" id="inputPassword3" name="password" placeholder="Password">
        </div>
    </div>


    <div align="center" class="form-group row">
        <div class="col-sm-2">
            <button type="submit" class="btn btn-primary" name="submit">Prijavi se</button>
            <br>
        </div>
    </div>
</form>


<?php

if (isset($_POST['submit'])) {
    require('controllers/login.php');
  //  login($_POST['username'], $_POST['password']);
    require "errorpage.php";

}
?>

<h6><br> Ako nemate nalog <a href="index.php?opcija=register"> registrujte se</a></h6>
<hr>