<html>
	<head>
		<title>Companhia Aérea</title>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<!-- 		<script src="http://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->
	</head>
	<body>
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="<?php echo base_url(); ?>voos">
              <strong>Airline</strong>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="nav navbar-nav ml-auto narbar-right">
              <?php if(!$this->session->userdata('logged_in')) : ?>
                <li class="nav-item active">
                  <a class="nav-link" href="<?php echo base_url(); ?>users/login">
                    Login
                  </a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="<?php echo base_url(); ?>users/register">
                    Register
                  </a>
                </li>
              <?php endif; ?>
              <?php if($this->session->userdata('logged_in')) : ?>
                <li class="nav-item active">
                  <a class="nav-link" href="<?php echo base_url(); ?>voos/create">
                    Create
                  </a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="<?php echo base_url(); ?>users/logout">
                    Logout
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </div>
        </nav>

    <?php if($this->session->flashdata('user_loggedin')) : ?>
      <?php echo '<p class="alert alert-success mt-3">'.$this->session->flashdata('user_loggedin').'</p>'; ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('user_loggedout')) : ?>
      <?php echo '<p class="alert alert-success mt-3">'.$this->session->flashdata('user_loggedout').'</p>'; ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('user_registered')) : ?>
      <?php echo '<p class="alert alert-success mt-3">'.$this->session->flashdata('user_registered').'</p>'; ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('login_failed')) : ?>
      <?php echo '<p class="alert alert-danger" mt-3>'.$this->session->flashdata('login_failed').'</p>'; ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('login_required')) : ?>
      <?php echo '<p class="alert alert-danger my-4">'.$this->session->flashdata('login_required').'</p>'; ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('reserva_deleted')) : ?>
      <?php echo '<p class="alert alert-success mt-3">'.$this->session->flashdata('reserva_deleted').'</p>'; ?>
    <?php endif; ?>