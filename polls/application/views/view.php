<!DOCTYPE html>
<!--
    A single page poll website that lets you vote and view polls.
    The website uses RESTful services and angular.js.
-->
<html lang="en" ng-app="pollsApp">
    <head>
        <meta charset="utf-8" />
        <title>Polls App</title>

        <link rel="stylesheet" type="text/css" href="styles/css.css" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" />
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
        <header class="center">
            <h1>Superior Polls App</h1>
            <nav>
                <a href="#/about">About</a>
                <a href="#/polls">Polls</a>
            </nav>
        </header>

        <div ng-view id="content"></div>
        <div id="credit" class="center">Written for Seng365. &copy; Matt Barton, 2014</div>
    </body>
</html>
