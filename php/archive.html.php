<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Archive</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/menu.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="/favicon.png" type="image/png">

    <!--  Colapse  -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="http://d3js.org/d3.v3.min.js"></script>
    <![endif]-->
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/nav.html.php'; ?>
<div class="container">
    <script>$(document).ready(function(){ //раскрытие/закрытие всех панелей
            $(".btn-primary").click(function(){
                $(".collapse").collapse('toggle');
            });
            $(".btn-success").click(function(){
                $(".collapse").collapse('show');
            });
            $(".btn-warning").click(function(){
                $(".collapse").collapse('hide');
            });
        });</script>
    <p><button type="button" class="btn btn-primary">Toggle</button>
        <button type="button" class="btn btn-success">Show</button>
        <button type="button" class="btn btn-warning">Hide</button> </p>
    <p>do here "search"</p>
    <div class="panel-group" id="accordion">
        <?php foreach($datesUnique as $key => $nowDate): //перебор по дате (каждая дата выводится только 1 раз)
            $dateFormat = date_create($nowDate); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $key + 1; ?>"><?php htmlOut(date_format($dateFormat, 'd.m.Y')); ?></a>
                </h4>
            </div>
            <div id="collapse<?php echo $key + 1; ?>" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="table table-striped">
                        <?php if(isset($nowDate)): ?>
                        <thead>
                        <tr>
                            <th>#</th><th>Work</th><th>Time</th><th>Remaining time</th><th>Comment</th><th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $numberOfRows = 1; foreach($allDates as $key2 => $data): ?>
                                <?php if($data['workdate'] == $nowDate): ?>
                            <tr>
                                <td><?php htmlOut($numberOfRows); //выводит отсчёт с 1 каждый день ?></td>
                                <td><?php htmlOut($data['main']); ?></td>
                                <td><?php htmlOut($data['worktime']); ?></td>
                                <td>{{remainingTime}}</td>
                                <td><?php echo(substr($data['comment'], 0, 175)); ?></td>
                                <td><?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/status.archive.php'; ?></td>
                            </tr>
                                <?php $numberOfRows++; endif; endforeach; ?>
                        <?php elseif(!isset($nowDate)): ?>
                        <h3 id="notificationNoNotes">Sorry, no notes for <?php htmlOut($nowDate); ?></h3>
                        </tbody>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/footer.html.php'; ?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/js/bootstrap.min.js"></script>
</body>
</html>