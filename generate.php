<?php
include "template/header.php";
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
        $shortener->generateShortURL();
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
