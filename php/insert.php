<div class="panel panel-success">
    <div class="panel-heading">
        <?php if($_POST['control'] && $_POST['control'] == 'Edit'): ?>
            <button type="submit" name="action" value="editWork" class="btn btn-primary">Update</button>
        <?php else: ?>
            <button type="submit" name="action" value="addWork" class="btn btn-primary">Add work</button>
        <?php endif; ?>
        <input type="hidden" name="id" value="<?php echo $table['id']; ?>">
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <label for="id">#:</label>
                    <input type="text" class="form-control" id="id" name="id" disabled value="<?php countNumberOfWork(); ?>">
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
                    <input type="text" class="form-control" id="time" name="time" placeholder="Enter time in minutes" value="<?php htmlOut($timeForWork); ?>">
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