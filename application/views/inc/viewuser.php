<h2>User Details</h2>
<hr />
<div class="panel-body" style="width:600px;">
    <div class="form-group">
        <label>User Name: </label>
        <label><?php echo $user->username; ?></label>
    </div>
    <div class="form-group">
        <label>Phone No: </label>
        <label><?php echo $user->phone; ?></label>
    </div>
    <div class="form-group">
        <label>Book Issue: </label>
        <label><?php $issue ?></label>
        <ol>
            <?php foreach ($issue as $book) { ?>
                <li>
                    <?php echo $book->book_name; ?>
                </li>
            <?php } ?>
            <ol>
    </div>

    <div class="form-group">
        <?php $name = $this->session->userdata("username") ?>
        <a  href="<?php echo base_url("user/editUserByName/$name"); ?>">
            Edit Profile
        </a>
    </div>
</div>