<div class="sidebar-nav">
    <ul>
        <li>
            <a href="#" data-target=".dashboard-menu" class="nav-header" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i>Dashboard<i class="fa fa-collapse"></i></a>
        </li>
        <li>
            <ul class="dashboard-menu nav nav-list collapse in lefts">
                <?php if ($this->session->userdata("role") === "admin") { ?>
                    <li><a href="<?php echo base_url("user/register"); ?>"><span class="fa fa-caret-right"></span>Add User</a></li>
                <?php } ?>
                <?php if ($this->session->userdata("role") === "admin") { ?>
                    <li><a href="<?php echo base_url("user/userList"); ?>"><span class="fa fa-caret-right"></span>User List</a></li>
                <?php } ?>
                <?php if ($this->session->userdata("role") === "admin") { ?>
                    <li><a href="<?php echo base_url("category/addCategory"); ?>"><span class="fa fa-caret-right"></span>Add Category</a></li>
                <?php } ?>

                <li><a href="<?php echo base_url("category/categoryList"); ?>"><span class="fa fa-caret-right"></span>Category List</a></li>

                <?php if ($this->session->userdata("role") === "admin") { ?>
                    <li><a href="<?php echo base_url("book/addBook"); ?>"><span class="fa fa-caret-right"></span>Add Book</a></li>
                <?php } ?>

                <li><a href="<?php echo base_url("book/bookList"); ?>"><span class="fa fa-caret-right"></span>Book List</a></li>

                <li><a href="<?php echo base_url("issue/issuebook"); ?>"><span class="fa fa-caret-right"></span>Request Issue Book</a></li>

                <?php if ($this->session->userdata("role") === "admin") { ?>
                    <li><a href="<?php echo base_url("issue/requestlist"); ?>"><span class="fa fa-caret-right"></span>Request Issue Book List</a></li>
                <?php } ?>

                <?php if ($this->session->userdata("role") === "admin") { ?>
                    <li><a href="<?php echo base_url("issue/issuelist"); ?>"><span class="fa fa-caret-right"></span>Issue Book List</a></li>
                <?php } ?>

               

            </ul>
        </li>
    </ul>
</div>