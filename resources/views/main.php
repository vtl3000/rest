<?php
/**
 *
 */
?>
<!DOCTYPE html>
<html lang="en" ng-app="rest">
<head>
    <meta charset="UTF-8">
    <title><?php echo empty($title) ? 'Title' : $title; ?></title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script type="text/javascript" src="/js/angular-1.4.8/angular.min.js"></script>
    <script type="text/javascript" src="/js/angular-1.4.8/angular-resource.min.js"></script>
    <script type="text/javascript" src="/js/angular-1.4.8/angular-route.min.js"></script>
    <script type="text/javascript" src="/js/app.js"></script>
</head>
<body>
<h2>Collections</h2>
<div ng-view></div>
</body>
</html>