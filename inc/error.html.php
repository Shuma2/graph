<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="/css/main.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="jumbotron">
        <h1>We’re sorry, something went wrong</h1>
        <p class="lead">Developer will see the error in the log.</p>
        <p><a onclick=javascript:checkSite(); class="btn btn-default btn-lg"><span class="green">Homepage</span></a>
            <script type="text/javascript">
                function checkSite(){
                    var currentSite = window.location.hostname;
                    window.location = "http://" + currentSite;
                }
            </script>
        </p>
    </div>
</div>
<div class="container">
    <div class="body-content">
        <div class="row">
            <div class="col-md-6">
                <h2>What happened?</h2>
                <p class="lead">A 404 error status implies that the file or page that you're looking for could not be found.</p>
            </div>
            <div class="col-md-6">
                <h2>What can I do?</h2>
                <p class="lead">Please use your browsers back button and check that you're in the right place. If you need immediate assistance, please send us an email instead.</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>