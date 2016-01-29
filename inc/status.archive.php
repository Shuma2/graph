<?php
if($date['status'] == 0) {
    echo 'Failed';
}
elseif($date['status'] == 1){
    echo 'Finished';
}
elseif($date['status'] == 2){
    echo 'In progress';
}
elseif($date['status'] == 3){
    echo 'Waiting';
}
else{
    echo 'Unknown status';
}