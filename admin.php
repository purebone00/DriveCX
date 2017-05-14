<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin Panel</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Material Design Theming -->
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.orange-indigo.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>

    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!--sb admin css -->
    <link href="resources/sb-admin.css" rel="stylesheet" type="text/css">

    <link href="resources/admin.css" rel="stylesheet" type="text/css">


    <!--Firebase-->
    <script src="https://www.gstatic.com/firebasejs/3.4.0/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/3.4.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/3.4.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/3.4.0/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/3.4.0/firebase-storage.js"></script>
        <script src="resources/admin.js"></script>

</head>

<body>


    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Admin <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href='javascript:;' onclick='signOut();'><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="#"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#addprojectpanel"><i class="fa fa-fw fa-edit"></i> Edit Calculator </a>
                    </li>
                    <li>
                        <a href="#currentProjectLink"><i class="fa fa-fw fa-laptop"></i> Statistics</a>
                    </li>
                    <li>
                        <a href="#editme"><i class="fa fa-fw fa-user"></i> API Keys </a>
                    </li>
                    <li>
                        <a href="#editprof"><i class="fa fa-fw fa-bars"></i> Change Password </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Hello Admin
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>

                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-github-alt fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge" id="finishedProjectNumber">0</div>
                                        <div>Average ROI</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div id="currentProjects" class="huge">0</div>
                                        <div>Leads Generated Today</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.container-fluid -->
            <div id="addprojectpanel">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div id="q_panelheading" class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-github-square fa-fw"></i> Edit Quick ROI Calculator </h3>
                        </div>
                        <div id="q_panelbody" class="panel-body">
                            <form>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Quick</label>
                                                <input class="mdl-textfield__input" style="width:100%;" min="0" max="100" type="number" id="q_quickRating" name="quickRating" placeholder="Quick %" />
                                            </div>
                                            <div class="form-group">
                                                <label>Complete Survey</label>
                                                <input class="mdl-textfield__input" style="width:100%;" min="0" max="100" type="number" id="q_csp" name="csp" placeholder="Survey %" />
                                            </div>
                                            <div class="form-group">
                                                <label>Vip Engagement</label>
                                                <input class="mdl-textfield__input" style="width:100%;" min="0" max="100" type="number" id="q_vipEngage" name="vipEngage" placeholder="VIP Engagement %" />
                                            </div>
                                            <div class="form-group">
                                                <label>Table Size</label>
                                                <input class="mdl-textfield__input" style="width:100%;" min="0" max="100" type="number" id="q_tableSize" name="tableSize" placeholder="Table Size" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>VIP</label>
                                                <input class="mdl-textfield__input" style="width:100%;" min="0" max="100" type="number" id="q_vip" name="vip" placeholder="VIP %" />
                                            </div>
                                            <div class="form-group">
                                                <label>Offers Sent</label>
                                                <input class="mdl-textfield__input" style="width:100%;" min="0" max="100" type="number" id="q_offerSent" name="offerSent" placeholder="Offer Sent %" />
                                            </div>
                                            <div class="form-group">
                                                <label>Return to Redeem</label>
                                                <input class="mdl-textfield__input" style="width:100%;" min="0" max="100" type="number" id="q_rtr" name="rtr" placeholder="Return to Redeem %" />
                                            </div>
                                            <div class="form-group">
                                                <label>Additional Visits</label>
                                                <input class="mdl-textfield__input" style="width:100%;" min="0" max="100" type="number" id="q_addVisits" name="addVisits" placeholder="# of Additional Visits" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <button id="FormulaSubmit" type="submit" onclick="return QuickFormulaSubmit()" class="btn btn-default">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>

                        </div>
                        <div id="quickSection" class="overlay">
                            <!-- Overlay content -->
                            <div class="overlay-content">
                                <div class="load-bar">
                                    <div class="bar"></div>
                                    <div class="bar"></div>
                                    <div class="bar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="addprojectpanel">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div id="f_panelheading" class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-github-square fa-fw"></i> Edit Full ROI Calculator </h3>
                        </div>
                        <div id="f_panelbody" class="panel-body">
                            <form>
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Full</label>
                                                <input class="mdl-textfield__input" style="width:100%;" min="0" max="100" type="number" id="f_fullRating" name="fullRating" placeholder="Full %" />
                                            </div>
                                            <div class="form-group">
                                                <label>Complete Survey</label>
                                                <input class="mdl-textfield__input" style="width:100%;" min="0" max="100" type="number" id="f_csp" name="csp" placeholder="Survey %" />
                                            </div>
                                            <div class="form-group">
                                                <label>Vip Engagement</label>
                                                <input class="mdl-textfield__input" style="width:100%;" min="0" max="100" type="number" id="f_vipEngage" name="vipEngage" placeholder="VIP Engagement %" />
                                            </div>
                                            <div class="form-group">
                                                <label>Table Size</label>
                                                <input class="mdl-textfield__input" style="width:100%;" min="0" max="100" type="number" id="f_tableSize" name="tableSize" placeholder="Table Size" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>VIP</label>
                                                <input class="mdl-textfield__input" style="width:100%;" min="0" max="100" type="number" id="f_vip" name="vip" placeholder="VIP %" />
                                            </div>
                                            <div class="form-group">
                                                <label>Return to Redeem</label>
                                                <input class="mdl-textfield__input" style="width:100%;" min="0" max="100" type="number" id="f_rtr" name="rtr" placeholder="Return to Redeem %" />
                                            </div>
                                            <div class="form-group">
                                                <label>Additional Visits</label>
                                                <input class="mdl-textfield__input" style="width:100%;" min="0" max="100" type="number" id="f_addVisits" name="addVisits" placeholder="# of Additional Visits" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <button id="FormulaSubmit" type="submit" onclick="return FullFormulaSubmit()" class="btn btn-default">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>

                        </div>
                        <div id="fullSection" class="overlay">
                            <!-- Overlay content -->
                            <div class="overlay-content">
                                <div class="load-bar">
                                    <div class="bar"></div>
                                    <div class="bar"></div>
                                    <div class="bar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="addprojectpanel">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div id="panelheading" class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Statistics </h3>
                        </div>
                        <div id="panelbody" class="panel-body">

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->




            <div id="editme">
                <div class="col-lg-6" style="margin-bottom:50px;">
                    <div class="panel panel-default">
                        <div id="api_panelHeading" class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> API Keys </h3>
                        </div>
                        <div id="api" class="overlay">
                            <!-- Overlay content -->
                            <div class="overlay-content">
                                <div class="load-bar">
                                    <div class="bar"></div>
                                    <div class="bar"></div>
                                    <div class="bar"></div>
                                </div>
                            </div>
                        </div>
                        <div id="api_panelBody" class="panel-body">
                            <div class="form-group">
                                <label>MailChimp</label>
                                <input class="mdl-textfield__input" style="width:100%;" type="text" id="mailchimpAPI" name="mailchimpAPI" placeholder="api" />
                            </div>
                            <div class="form-group">
                                <label>PipeDrive</label>
                                <input class="mdl-textfield__input" style="width:100%;" type="text" id="pipedriveAPI" name="pipedriveAPI" placeholder="api" />
                            </div>
                            <button id="FormulaSubmit" type="submit" onclick="return APISubmit();" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" id="editprof" style="margin-bottom:50px;">
                    <div class="panel panel-default">
                        <div class="pw_panel-heading">
                            <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Change Password</h3>
                        </div>
                        <div id="pw" class="overlay">
                            <!-- Overlay content -->
                            <div class="overlay-content">
                                <div class="load-bar">
                                    <div class="bar"></div>
                                    <div class="bar"></div>
                                    <div class="bar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Old Password</label>
                                <input class="mdl-textfield__input" style="width:100%;" type="text" id="oldPW" name="oldPW" placeholder="Old Password" />
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input class="mdl-textfield__input" style="width:100%;" type="text" id="newPW" name="newPW" placeholder="New Password" />
                            </div>
                            <div class="form-group">
                                <label>Confirm New Password</label>
                                <input class="mdl-textfield__input" style="width:100%;" type="text" id="newPWConfirm" name="newPWConfirm" placeholder="Confirm New Password" />
                            </div>
                            <button id="PasswordSubmit" type="submit" onclick="return changePassword()" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </div>


            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>