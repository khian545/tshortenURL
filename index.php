
  <?php
  include "template/header.php"
    // include 'URLShortener.php';
    // $shortener = new URLShortener();
    // echo '...Generating...';
    // echo '<br/>';
    // $shortener->generateShortURL();
    // echo '<br/>'; echo '<br/>';
    // echo '...Retrieving ID...';
    // echo '<br/>';
    // echo "Short URL ID is: " . $shortener->getIDbySlashTag('ttgfhh');
    // echo '<br/>'; echo '<br/>';
    // echo '...Deleting Link...';
    // echo '<br/>';
    // $shortener->deleteShortenLink($shortener->getIDbySlashTag('ttgfhh'));
    // echo '<br/>'; echo '<br/>';
    // echo '...Done...';
  ?>

<div class="container">

  <h5>List of Shortened Links</h5>

  <table class="table">
    <tr>
      <th>No.</th>
      <th>ID</th>
      <th>Short URL</th>
      <th>Destination URL</th>
    </tr>
    <?php
      include "URLShortener.php";

      $shortener = new URLShortener();
      $links = $shortener->getLinks();
      $counter = 1;
      foreach ($links as $link) {
        echo '<tr>';
        echo '<td>'. $counter++ . '</td>';
        echo '<td>'. $link["id"] . '</td>';
        echo '<td>'. $link["shortUrl"] . '</td>';
        echo '<td>'. $link["destination"] . '</td>';
        echo '<td>';
          echo '<form action="delete.php" method="get">';
          echo '<div class="form-group">';
          echo '<input type="hidden" value="' . $link["slashtag"] . '" name="slashtag" />';
          echo '<button class="btn btn-danger" type="submit">Delete</button>';
          echo '</div>';
          echo '</form>';
        echo '</td>';
        echo '</tr>';
      }
     ?>
   </table>

  <div class="row">
    <div class="col-sm">

      <form action="generate.php" method="get">
        <div class="form-group">
          <label>Destination URL</label>
          <input class="form-control" name="destination" type="text" />
          <small  class="form-text text-muted">Enter the link here.</small>
        </div>
        <div class="form-group">
          <button class="btn btn-primary" type="submit">Create</button>
        </div>
      </form>

    </div>
  </div>
  <!--
  <div class="row">
    <div class="col-sm">

      <form action="delete.php" method="get">
        <div class="form-group">
          <label>Slashtag</label>
          <input class="form-control" name="slashtag" type="text"/>
          <small  class="form-text text-muted">Enter the slashtag here here.</small>
        </div>
        <div class="form-group">
          <button class="btn btn-danger" type="submit">Delete</button>
        </div>
      </form>

    </div>
  </div>
-->

</div>

<?php
include "template/footer.php";
 ?>
