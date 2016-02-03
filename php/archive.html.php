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
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <!--  My  -->
    <link href="/css/menu.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/datepicker.css" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.png" type="image/png">

    <!--  Collapse  -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

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
    <div class="panel-group">
        <form action="" method="get" autocomplete="off">
        <div class="panel panel-success">
            <div class="panel-heading">
                <input type="hidden" name="action" value="search">
                <input type="submit" class="btn btn-primary" value="Search">
            </div>
                <div class="panel-body">
                    <?php if(!isset($_GET['error'])) {
                        echo "<p class=\"text-muted\">NOTE: For search please fill one or more fields. One date, or range of dates are optional.</p>";}
                        else{ echo "<p class=\"text-danger bg-danger\">NOTE: For search please fill one or more fields. One date, or range of dates are optional.</p>";} ?>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="workSearch">Work:</label>
                                <input type="text" class="form-control" id="workSearch" name="workSearch" placeholder="Part or full title" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="dateSearch">Date:</label>
                                <div class="hero-unit input-group input-daterange">
                                    <input type="text" class="form-control" name="dateSearch" id="dateSearch" placeholder="Choose date" data-date-end-date="0d">
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="form-control" name="dateSearch2" id="dateSearch2" placeholder="Choose date" data-date-end-date="0d">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="commentSearch">Comment:</label>
                                <input type="text" class="form-control" id="commentSearch" name="commentSearch" placeholder="Part or full comment" value="">
                            </div>
                        </div>
                    </div>
                </div>
            <?php if(isset($datesUnique)): ?>
            <div class="panel-footer">
                <button type="button" class="btn btn-info">Toggle</button>
                <button type="button" class="btn btn-success">Show all</button>
                <button type="button" class="btn btn-warning">Hide all</button>
            </div>
            <?php endif; ?>
        </form>
        </div>
    </div>
    <?php if(isset($_GET['action']) && ($_GET['action']) == 'search'): ?>
        <div class="panel panel-info">
            <div class="panel-heading">Search result</div>
            <div class="panel-body">
                <?php if(isset($searchResult)): ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th><th>Work</th><th>Time</th><th>Date</th><th>Comment</th><th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($searchResult as $key => $table):
                        $dateFormat = date_create($table['workdate']); ?>
                        <tr>
                            <td><?php htmlOut($key + 1); //выводит отсчёт с 1 каждый день ?></td>
                            <td><?php htmlOut($table['main']); ?></td>
                            <td><?php htmlOut($table['worktime']); ?></td>
                            <td><?php htmlOut(date_format($dateFormat, 'd.m.Y')); ?></td>
                            <td><?php htmlOut($table['comment']); ?></td>
                            <td><?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/status.php'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php elseif(!isset($searchResult)): ?>
                    <h3 id="notificationNoNotes">No matches</h3>
                    </tbody>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    <?php else: ?>
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
                        <thead>
                        <tr>
                            <th>#</th><th>Work</th><th>Time</th><th>Remaining time</th><th>Comment</th><th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $numberOfRows = 1; foreach($allDates as $key2 => $table): ?>
                                <?php if($table['workdate'] == $nowDate): ?>
                            <tr>
                                <td><?php htmlOut($numberOfRows); //выводит отсчёт с 1 каждый день ?></td>
                                <td><?php htmlOut($table['main']); ?></td>
                                <td><?php htmlOut($table['worktime']); ?></td>
                                <td>{{remainingTime}}</td>
                                <td><?php echo(substr($$table['comment'], 0, 175)); ?></td>
                                <td><?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/status.php'; ?></td>
                            </tr>
                                <?php $numberOfRows++; endif; endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/footer.html.php'; ?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/js/bootstrap.min.js"></script>
<script src="/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    // When the document is ready
    // datepicker
    $(document).ready(function () {

        $('#dateSearch').datepicker({
            format: "dd.mm.yyyy"
        });
        $('#dateSearch2').datepicker({
            format: "dd.mm.yyyy"
        });

    });
</script>
<script>
    $(document).ready(function(){ //раскрытие/закрытие всех панелей
        $(".btn-info").click(function(){
            $(".collapse").collapse('toggle');
        });
        $(".btn-success").click(function(){
            $(".collapse").collapse('show');
        });
        $(".btn-warning").click(function(){
            $(".collapse").collapse('hide');
        });
    });
    </script>
</body>
</html>