<h2>Edit User</h2>
<hr />
<?php
$msg = $this->session->flashdata('msg');
if (isset($msg)) {
    echo $msg;
}
?>
<div class="panel-body" style="width:600px;">
    <form action="<?php echo base_url("user/updateUser"); ?>" method="post">
        <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
        <div class="form-group">
            <label>User Name</label>
            <input type="text" name="username" value="<?php echo $user->username; ?>" class="form-control span12">
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" value="<?php echo $user->phone; ?>" class="form-control span12">
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>

    </form>
</div>