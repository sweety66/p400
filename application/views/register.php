<div class="register">
<form action="<?php echo base_url("user/registerForm"); ?>" method="post" class="reg-form auform">
<h1 class="uregister">User Register</h1>
    <div class="form-group">
        <label>User Name</label>
        <input type="text" name="username" class="form-control span12" required>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control span12 form-control" required />
    </div>
    <div class="form-group">
        <label>Retype Password</label>
        <input type="password" name="password_retype" class="form-control span12 form-control" required />
    </div>
    <div class="form-group">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control span12" required>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-lg btn-primary" value="Submit">
    </div>
</form>
</div>