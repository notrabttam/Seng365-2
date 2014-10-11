<!doctype html>
<!-- A rudimentary 2-view Angular app, for SENG365 2014. RJL. -->
<html lang="en" ng-app="pollsApp">
<head>
    <meta charset="utf-8">
    <title>Items</title>
    
    <link rel="stylesheet" type="text/css" href="styles/css.css" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


    <script src="scripts/angular.js"></script>
    <script src="scripts/angular-route.js"></script>
    <script src="scripts/app.js"></script>
    <script src="scripts/controllers.js"></script>
</head>
<body>
    <div class="banner">
        <img src="images/premiumPolls.jpg" />
        <div class="navigation">
            <a href="#/about">About</a>
            <a href="#/polls">Polls</a>
        </div>
    </div>

    <div ng-view></div>
</body>
</html>
