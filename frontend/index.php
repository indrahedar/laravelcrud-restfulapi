<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Dashboard</span></a>
            </div>
            <div class="clearfix"></div>
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="production/images/user.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>Admin</h2>
              </div>
            </div>
            <br />
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                  <li><a href="index.php"><i class="fa fa-user"></i> Profile</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Profile</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?php
                    if (empty($_GET['search'])) {
                      $url = 'http://localhost:8000/api/profile/';
                    } else {
                      $search = $_GET['search'];
                      $url = 'http://localhost:8000/api/profile/'.$search;
                    }
                    $data = file_get_contents($url);
                    $profiles = json_decode($data);
                    ?>
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No. </th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Job</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach ($profiles as $profile) {
                        ?>
                        <tr>
                          <td><?php echo $no++ ?>.</td>
                          <td><?php echo $profile->name; ?></td>
                          <td><?php echo $profile->email; ?></td>
                          <td><?php echo $profile->job; ?></td>
                          <td>
                            <form action="http://localhost:8000/api/profile/delete/<?php echo $profile->email ?>" method="POST">
                            <a href="?email=<?php echo $profile->email ?>" class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Edit </a>
                            <button class="btn btn-default btn-xs"><i class="fa fa-trash"></i> Delete </button>
                            </form>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Search Data</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="?" method="GET" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" name="search" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-primary confirm">Search</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <?php if (empty($_GET['email'])) { ?><h2>Add Data</h2> <?php } else { ?> <h2>Edit Data</h2> <?php } ?>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?php if (empty($_GET['email'])) { ?>
                    <form action="http://localhost:8000/api/profile" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                    <?php } else { ?>
                    <form action="http://localhost:8000/api/profile/edit" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                    <?php } ?>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="name" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php if (empty($_GET['email'])) { ?>
                          <input type="email" name="email" class="form-control col-md-7 col-xs-12" required="required">
                          <?php } else { ?>
                          <input type="email" name="email" value="<?php echo ($_GET['email']) ?>" class="form-control col-md-7 col-xs-12" required="required">
                          <?php } ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Job</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="job" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="reset" class="btn btn-default">Reset</button>
                          <button type="submit" class="btn btn-primary confirm">Save</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <footer>
          <div class="pull-right">
            CRUD Laravel API - 2018
          </div>
          <div class="clearfix"></div>
        </footer>
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

  </body>
</html>
