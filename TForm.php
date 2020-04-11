<?php
class TForm{
  private static $openTag;
  private static $closeTag;
  public static $data = ['action' => '',
  'method' => '',
  'class' => ''];
  public static $formControls = [];
  public static $groupedControls = [];

  public function __construct(){

  }

  public static function start($action = '', $method = '', $class = ''){
    self::$data['class'] = $class;
    self::$data['action'] = $action;
    self::$data['method'] = $method;
    self::$formControls = [];
    self::$groupedControls = [];
  }
  
  public static function generateForm(){
    self::$openTag = '<form class="'.self::$data['class'].'" action="'.self::$data['action'].'"
                        method="'.self::$data['method'].'" >';
    self::$closeTag = '</form>';

    echo self::$openTag;
    foreach (self::$groupedControls as $key => $value) {
      echo $value;
    }
    echo self::$closeTag;
  }

  public static function addControl($control){
    array_push(self::$formControls, $control);
  }

  public static function toFormGroup(){
    array_push(self::$groupedControls, '<div class="form-group">');
    foreach (self::$formControls as $key => $value) {
      array_push(self::$groupedControls, $value);
    }
    array_push(self::$groupedControls, '</div>');
    self::$formControls = []; //clear the array of controls
  }
}
?>
