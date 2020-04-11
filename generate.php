<?php
include "template/header.php";
include "PromptMessageTemplate.php";
?>

<div class="container">
  <div class="row">
    <div class="col-sm">
      <?php
      include 'URLShortener.php';
      $shortener = new URLShortener();
      $shortener->data["destination"] = $_GET["destination"];
      echo '...Generating...';
      echo '<br/>';
      $shorURL = $shortener->generateShortURL();
      if($shorURL === ''){
        PromptMessageTemplate::MessageFailed('There was a problem with your URL.');
      }else{
        PromptMessageTemplate::MessageSuccess('<a target="_blank" href="http://'.$shorURL.'">'.$shorURL.'</a> was generated.');
      }
      echo '<br/>'; echo '<br/>';
      ?>

      <form action="index.php" method="get">
        <div class="form-group">
          <button class="btn btn-primary" type="submit">Back</button>
        </div>
      </form>

    </div>
  </div>

</div>

<?php
include "template/footer.php";
?>
