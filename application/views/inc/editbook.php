<h2>Update Book</h2>
<hr />
<?php
$msg = $this->session->flashdata('msg');
if (isset($msg)) {
    echo $msg;
}
?>
<div class="panel-body" style="width:600px;">
    <form action="<?php echo base_url("book/updateBookForm"); ?>" method="post">
        <input type="hidden" name="book_id" value="<?php echo $bookbyid->book_id; ?>" />
        <div class="form-group">
            <label>Book Name</label>
            <input type="text" name="book_name" value="<?php echo $bookbyid->book_name; ?>" class="form-control span12">
        </div>
        <div class="form-group">
            <label>Book Categories</label>
            <select name="category" class="cat">
                <option value="">Select One</option>
                <?php
                foreach ($cat_name as $ddata) {
                ?>
                    <option value="<?php echo $ddata->cat_id; ?>"><?php echo $ddata->cat_name; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Author</label>
            <input type="text" name="author" value="<?php echo $bookbyid->author; ?>" class="form-control span12">
        </div>

        <div class="form-group">
            <label>Total Book</label>
            <input type="text" name="stock" value="<?php echo $bookbyid->stock; ?>" class="form-control span12">
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>

    </form>
</div>