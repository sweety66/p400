<h2>Request Issue Book</h2>
<hr />
<?php
$msg = $this->session->flashdata('msg');
if (isset($msg)) {
    echo $msg;
}
?>
<div class="panel-body" style="width:600px;">
    <form action="<?php echo base_url("issue/addIssueForm"); ?>" method="post">

        <div class="form-group">
            <label>User Name</label>
            <input type="text" name="username" class="form-control span12">
        </div>

        <div class="form-group">
            <label>Book Categories</label>
            <select id="cats" name="category" class="cat">
                <option disabled value="">Select One</option>
                <?php
                foreach ($allcat as $ddata) {
                ?>
                    <option value="<?php echo $ddata->cat_id; ?>"><?php echo $ddata->cat_name; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Book Name</label>
            <select name="book_name" id="books" class="book">
                <option disabled value="">Select One</option>
            </select>
        </div>

        <div class="form-group">
            <label>Return Date (hints:YYYY-MM-DD)</label>
            <input type="text" name="return" class="form-control span12">
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>

    </form>
</div>