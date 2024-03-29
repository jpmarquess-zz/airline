<html>
	<head>
		<title>Companhia Aérea</title>
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
	</head>
	<body>
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">
              <strong>Airline</strong>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
            <?php if ($this->session->userdata('logged_in')): ?>
              <li class="nav-item">
                <a class="nav-link" style="color: black;" href="<?php echo base_url(); ?>voos">
                  Voos
                </a>
              </li>
            <?php endif;?>
            </ul>
            <ul class="nav navbar-nav ml-auto narbar-right">
              <?php if (!$this->session->userdata('logged_in')): ?>
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
              <?php endif;?>
              <?php if($this->session->userdata('isAdmin') && $this->session->userdata('logged_in')) : ?>
                <li class="nav-item active">
                  <a class="nav-link" href="<?php echo base_url(); ?>voos/voo_create">
                    Create Voo
                  </a>
                </li>
              <?php endif; ?>
              <?php if ($this->session->userdata('logged_in')): ?>
                <li class="nav-item active">
                  <a class="nav-link" href="<?php echo base_url(); ?>voos/create">
                    Create Reserva
                  </a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="<?php echo base_url(); ?>users/logout">
                    Logout
                  </a>
                </li>
              <?php endif;?>
            </ul>
          </div>
        </nav>

    <?php if ($this->session->flashdata('user_loggedin')): ?>
      <?php
          $output  = '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
          $output .= '<p class="m-0">' . $this->session->flashdata('user_loggedin') . '</p>';
          $output .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
          $output .= '<span aria-hidden="true">&times;</span>';
          $output .= '</button>';
          $output .= '</div>';
          echo $output;
        ?>
    <?php endif; ?>

    <?php if ($this->session->flashdata('user_loggedout')): ?>
      <?php
          $output  = '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
          $output .= '<p class="m-0">' . $this->session->flashdata('user_loggedout') . '</p>';
          $output .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
          $output .= '<span aria-hidden="true">&times;</span>';
          $output .= '</button>';
          $output .= '</div>';
          echo $output;
        ?>
    <?php endif; ?>

    <?php if ($this->session->flashdata('user_registered')): ?>
      <?php
          $output  = '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
          $output .= '<p class="m-0">' . $this->session->flashdata('user_registered') . '</p>';
          $output .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
          $output .= '<span aria-hidden="true">&times;</span>';
          $output .= '</button>';
          $output .= '</div>';
          echo $output;
        ?>
    <?php endif; ?>

    <?php if ($this->session->flashdata('login_failed')): ?>
      <?php
          $output  = '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">';
          $output .= '<p class="m-0">' . $this->session->flashdata('login_failed') . '</p>';
          $output .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
          $output .= '<span aria-hidden="true">&times;</span>';
          $output .= '</button>';
          $output .= '</div>';
          echo $output;
        ?>
    <?php endif; ?>

    <?php if ($this->session->flashdata('login_required')): ?>
      <?php
          $output  = '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">';
          $output .= '<p class="m-0">' . $this->session->flashdata('login_required') . '</p>';
          $output .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
          $output .= '<span aria-hidden="true">&times;</span>';
          $output .= '</button>';
          $output .= '</div>';
          echo $output;
        ?>
    <?php endif; ?>

    <?php if ($this->session->flashdata('reserva_deleted')): ?>
      <?php
          $output  = '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
          $output .= '<p class="m-0">' . $this->session->flashdata('reserva_deleted') . '</p>';
          $output .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
          $output .= '<span aria-hidden="true">&times;</span>';
          $output .= '</button>';
          $output .= '</div>';
          echo $output;
        ?>
    <?php endif; ?>

    <?php if ($this->session->flashdata('edit_reserva')): ?>
      <?php
          $output  = '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
          $output .= '<p class="m-0">' . $this->session->flashdata('edit_reserva') . '</p>';
          $output .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
          $output .= '<span aria-hidden="true">&times;</span>';
          $output .= '</button>';
          $output .= '</div>';
          echo $output;
        ?>
    <?php endif; ?>

    <?php if ($this->session->flashdata('create_reserva')): ?>
      <?php
          $output  = '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
          $output .= '<p class="m-0">' . $this->session->flashdata('create_reserva') . '</p>';
          $output .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
          $output .= '<span aria-hidden="true">&times;</span>';
          $output .= '</button>';
          $output .= '</div>';
          echo $output;
        ?>
    <?php endif; ?>

    <?php if ($this->session->flashdata('search')): ?>
      <?php
          $output  = '<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">';
          $output .= '<p class="m-0">' . $this->session->flashdata('search') . '</p>';
          $output .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
          $output .= '<span aria-hidden="true">&times;</span>';
          $output .= '</button>';
          $output .= '</div>';
          echo $output;
        ?>
    <?php endif; ?>