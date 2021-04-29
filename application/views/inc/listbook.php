<h2>Book List</h2>
<hr />
<?php
$msg = $this->session->flashdata('msg');
if (isset($msg)) {
  echo $msg;
}
?>
<table class="display" id="sweety">
  <thead>
    <tr>
      <th>No.</th>
      <th>Bookshelf No</th>
      <th>Book Name</th>
      <th>Category Name</th>
      <th>Author</th>
      <th>Total Book</th>
      <th style="width: 3.5em;">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 0;
    foreach ($allbook as $bdata) {
      $i++;
    ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $bdata->s_no; ?></td>
        <td><?php echo $bdata->book_name; ?></td>

        <td>
          <?php
          $catid = $bdata->cat_id;
          $getcat = $this->category_model->getCategoryById($catid);
          if (isset($getcat)) {
            echo $getcat->cat_name;
          }
          ?>
        </td>
        <td><?php echo $bdata->author; ?></td>
        <td><?php echo $bdata->stock; ?></td>
        <td>
          <a href="<?php echo base_url("book/viewBook/$bdata->book_id"); ?>"><i class="fas fa-info-circle"></i></a>
          <?php if ($this->session->userdata("role") === "admin") { ?>
            <a href="<?php echo base_url("book/editbook/$bdata->book_id"); ?>"><i class="fa fa-pencil"></i></a>
            <a onclick="return confirm('Are you sure to remove ?');" href="<?php echo base_url("book/delbook/$bdata->book_id"); ?>" role="button" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>