<div class="panel panel-success">
    <div class="panel-heading">
        <button type="submit" name="action" value="<?php echo $action; ?>" class="btn btn-primary"><?php echo $button; ?></button>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <label for="id">#:</label>
                    <input type="number" class="form-control" id="id" name="id" disabled value="<?php countNumberOfWork(); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="workToDo">Work:</label>
                    <input type="text" class="form-control" id="workToDo" name="workToDo" placeholder="What need to do" value="<?php htmlOut($workToDo); ?>">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="time">Time:</label>
                    <input type="text" class="form-control" id="time" name="time" placeholder="Enter time in minutes" value="<?php htmlOut($timeForWork) ; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control" rows="3" id="comment" name="comment" placeholder="Comment will be displayed, when you will hover the cursor in the list"><?php htmlOut($commentForWork);?></textarea>
                </div>
            </div>
        </div>
    </div>
</div>