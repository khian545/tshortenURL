<?php
include "header.php";
?>

<div class="container">
  <div class="row">
    <div class="col-sm">
      <?php
      include 'URLShortener.php';
      $shortener = new URLShortener();
      $shortener->data["slashtag"] = $_GET["slashtag"];
      echo '...Deleting Link...';
      echo '<br/>';
      $shortener->deleteShortenLink();
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
include "footer.php";
 ?>
