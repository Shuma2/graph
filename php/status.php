<?php
if($table['status'] == 0) {
    echo 'Failed';
}
elseif($table['status'] == 1){
    echo 'Finished';
}
elseif($table['status'] == 2){
    echo 'In progress';
}
elseif($table['status'] == 4){
    echo 'Waiting';
}
else{
    echo 'Unknown status';
}