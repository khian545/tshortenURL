<?php
class TPromptMessage{
  public static function MessageSuccess($message){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> '.$message.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
  }

  public static function MessageFailed($message){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Warning!</strong> '.$message.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
  }
}
 ?>