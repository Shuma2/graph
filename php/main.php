<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Graph</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <link rel="shortcut icon" href="favicon.png" type="image/png">
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

<div class="main">
    <div class="container">
        <div class="panel-group">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <button type="submit" class="btn btn-primary disabled">Add work</button>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="id">#:</label>
                                <input type="text" class="form-control" id="id" name="id" disabled value="{{id}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="workToDo">Work:</label>
                                <input type="text" class="form-control" id="workToDo" name="workToDo" placeholder="What need to do">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="time">Time:</label>
                                <input type="text" class="form-control" id="time" name="time" placeholder="Enter time in minutes">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="comment">Comment:</label>
                                <textarea class="form-control" rows="3" id="comment" name="comment" placeholder="Comment will be displayed, when you will hover the cursor in the list"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-info">
                <div class="panel-heading">List for {{datetime}}</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Work</th>
                            <th>Time</th>
                            <th>Remaining time</th>
                            <th>Comment</th>
                            <th>Timer</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <?php if(isset($resultTable)): ?>
                        <tbody>
                            <?php foreach($resultTable as $table): ?>
                            <tr>
                                <td><?php htmlOut($table['id']); ?></td>
                                <td><?php htmlOut($table['work']); ?></td>
                                <td><?php htmlOut($table['workTime']); ?></td>
                                <td>{{remainingTime}}</td>
                                <td>{{comment}}</td>
                                <td>
                                    <div class="player">
                                        <button type="button" id="button_play" class="btn btn-xs" onclick='buttonPlayPress()'>
                                            <i class="fa fa-play"></i>
                                        </button>

                                        <button type="button" id="button_stop" class="btn btn-xs" onclick='buttonStopPress()'>
                                            <i class="fa fa-stop"></i>
                                        </button>
                                    </div>
                                </td>
                                <th><button type="button" class="btn btn-info btn-xs">Edit</button> </th>
                                <th><button type="button" class="btn btn-danger btn-xs">Delete</button></th>
                            </tr>
                            <?php endforeach; ?>
                        <?php elseif(!isset($resultTable)): ?>
<!--                            <tr>-->
<!--                                <td>2</td>-->
<!--                                <td>AARBI</td>-->
<!--                                <td>60</td>-->
<!--                                <td>40</td>-->
<!--                                <td>Problems with configmanager</td>-->
<!--                                <td>-->
<!--                                    <div class="player">-->
<!--                                        <!--                                            <button type="button" id="button_play" class="btn btn-xs" onclick='buttonPlayPress()'>-->-->
<!--                                        <!--                                                <i class="fa fa-play"></i>-->-->
<!--                                        <!--                                            </button>-->-->
<!--                                        <!---->-->
<!--                                        <!--                                            <button type="button" id="button_stop" class="btn btn-xs" onclick='buttonStopPress()'>-->-->
<!--                                        <!--                                                <i class="fa fa-stop"></i>-->-->
<!--                                        <!--                                            </button>-->-->
<!--                                    </div>-->
<!--                                </td>-->
<!--                                <th><button type="button" class="btn btn-info btn-xs">Edit</button> </th>-->
<!--                                <th><button type="button" class="btn btn-danger btn-xs">Delete</button></th>-->
<!--                            </tr>-->
<!--                            <tr>-->
<!--                                <td>3</td>-->
<!--                                <td>Graph</td>-->
<!--                                <td>180</td>-->
<!--                                <td>60</td>-->
<!--                                <td>Add AngularJS</td>-->
<!--                                <td>-->
<!--                                    <div class="player">-->
<!--                                        <!--                                            <button type="button" id="button_play" class="btn btn-xs" onclick='buttonPlayPress()'>-->-->
<!--                                        <!--                                                <i class="fa fa-play"></i>-->-->
<!--                                        <!--                                            </button>-->-->
<!--                                        <!---->-->
<!--                                        <!--                                            <button type="button" id="button_stop" class="btn btn-xs" onclick='buttonStopPress()'>-->-->
<!--                                        <!--                                                <i class="fa fa-stop"></i>-->-->
<!--                                        <!--                                            </button>-->-->
<!--                                    </div>-->
<!--                                </td>-->
<!--                                <th><button type="button" class="btn btn-info btn-xs">Edit</button> </th>-->
<!--                                <th><button type="button" class="btn btn-danger btn-xs">Delete</button></th>-->
<!--                            </tr>-->
                            </tbody>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/footer.html.php'; ?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/player.js"></script>
</body>
</html>