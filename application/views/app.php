<!DOCTYPE html>
<html>
<head>
    <title>ComPass - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/res/css/bootstrap.min.css" rel="stylesheet">
    <link href="/res/css/font-awesome.min.css" rel="stylesheet">
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8"/>

    <style type="text/css">
        .second {
            border-top: 1px solid;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .navbar-brand {
            text-transform: uppercase;
        }

        .tag {
            margin-right: 4px;
        }

        .tagLine {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            color: #fff;
            margin-top: 16px;
        }

        .compassEntry p {
            margin-bottom: 0;
        }

        .compassEntry .col-lg-4 {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .compassEntry .detail {
            display: block;
        }

        #categorySearch {
            display: block;
            width: 100%;
            border: none;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            outline: none;
            padding: 10px 15px;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            z-index: 1;
            margin-top: -1px;
        }

        #categorySearch:focus {
            border-left: 1px solid;
            border-right: 1px solid;
            border-color: #66afe9;
            padding-left: 14px;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
        }

        .panel-group .panel {
            margin-bottom: 20px;
        }

        .detail-entry {
            display: block;
            line-height: 25px;
        }

            /* Sticky footer styles
               -------------------------------------------------- */

        html,
        body {
            height: 100%;
            /* The html and body elements cannot have any padding or margin. */
        }

            /* Wrapper for page content to push down footer */
        #wrap {
            min-height: 100%;
            height: auto !important;
            height: 100%;
            /* Negative indent footer by its height */
            margin: 0 auto -60px;
            /* Pad bottom by footer height */
            padding: 0 0 60px;
        }

            /* Set the fixed height of the footer here */
        #footer {
            border-top: 1px solid #e7e7e7;
            background-color: #f8f8f8;
            height: 59px;
        }
    </style>
</head>
<body ng-app="compassMain" ng-controller="CompassController">

<div id="wrap">
    <div class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">com<strong>pass</strong></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">
                            <lang>Einstellungen</lang>
                        </a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"
                           data-toggle="dropdown"><?php echo $userData['NameFirst'] . ' ' . $userData['NameLast']; ?> <b
                                class="caret"></b></a>
                        <ul class="dropdown-menu">

                            <li><a href="#">
                                    <lang>Profil bearbeiten</lang>
                                </a></li>
                            <li><a href="#">
                                    <lang>Nachrichten</lang>
                                    <span class="badge pull-right">0</span></a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url("logout"); ?>">
                                    <lang>Ausloggen</lang>
                                </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-4 hidden-print">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <lang>Kunden</lang>
                        <button class="btn pull-right btn-xs btn-default">
                            <lang>Neuer Kunde</lang>
                        </button>
                    </div>

                    <input type="text" class="list-group-item" id="categorySearch" ng-model="categorySearch"
                           placeholder="Search...">

                    <!-- List group -->
                    <div class="list-group">
                        <a href="#/{{ customer._id }}" ng-repeat="customer in data | filter: categorySearch"
                           class="list-group-item {{ isActiveMenuLink(customer._id) }}">
                            {{ customer.name | decryptAES: false }}
                            <div class="pull-right"><span
                                    class="label label-default">{{ customer.entries.length }}</span></div>
                        </a>
                    </div>
                </div>

                <div class="panel-group hidden-xs" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <lang>Tips & Tricks</lang>

                            <button class="accordion-toggle btn pull-right btn-xs btn-default" data-toggle="collapse"
                                    data-parent="#accordion" href="#collapseOne"><i
                                    class="icon-ellipsis-horizontal"></i></button>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <lang>Hier könnten später mal wichtige Tipps und Tricks stehen</lang>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-sm-8">
                <div ng-view=""></div>
            </div>
        </div>
    </div>
</div>

<div id="footer" class="hidden-xs">
    <div class="container">
        <span style="line-height: 59px;">Version 0.2.1 Beta</span>

        <?php if ($customer['CompanyName'] != ""): ?>
            <span style="line-height: 59px;" class="pull-right">Angemeldet für <?php echo $customer['CompanyName']; ?></span>
        <?php endif; ?>
    </div>
</div>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/res/js/jquery.min.js"></script>
<script src="/res/js/bootstrap.min.js"></script>
<script src="/res/js/angular.min.js"></script>
<script src="/res/js/angular-resource.min.js"></script>
<script src="/res/js/parseURI.js"></script>
<script src="/res/js/sjcl.js"></script>

<!-- App code files -->
<script src="/res/js/app.js"></script>
<script src="/res/js/i18n.js"></script>
<script src="/res/js/filters.js"></script>
<script src="/res/js/directives.js"></script>
</body>
</html>