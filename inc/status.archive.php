<?php
if($data['status'] == 0) {
    echo 'Failed';
}
elseif($data['status'] == 1){
    echo 'Finished';
}
elseif($data['status'] == 2){
    echo 'In progress';
}
elseif($data['status'] == 3){
    echo 'Waiting';
}
else{
    echo 'Unknown';
}