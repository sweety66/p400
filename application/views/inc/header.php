<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Library Management</title>

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url("lib/bootstrap/css/bootstrap.css"); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url("lib/font-awesome/css/font-awesome.css"); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url("lib/jquery.dataTables.css"); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url("style/theme.css"); ?>">
</head>

<body class="theme-blue">
  <div class="navbar navbar-default" role="navigation">
    <div class="navbar-header custommenu"><a href="<?php echo base_url("library/home"); ?>" class="brand">Library Management</a></div>

    <div class="navbar-collapse menu" style="height: 1px;">
      <ul id="main-menu" class="nav navbar-nav navbar-left">
        <?php if ($this->session->userdata("logged_in") !== true) { ?>
          <li><a href="<?php echo base_url("user/register"); ?>">Register</a></li>
        <?php } ?>
        <?php if ($this->session->userdata("logged_in") === true) { ?>
          <li class="dropdown hidden-xs menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span>
              <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu">
              <li>
                <?php $name = $this->session->userdata("username") ?>
                <a href="<?php echo base_url("user/viewUser/$name"); ?>">
                  <?php echo $name ?>
                </a>
              </li>
              <li>
                <a href="<?php echo base_url("user/logout"); ?>">Logout</a>
              </li>
            </ul>
          </li>
        <?php } ?>
      </ul>
    </div>

  </div>