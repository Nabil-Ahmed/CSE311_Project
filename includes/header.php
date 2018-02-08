<?php
  require ('config/db.php');
  include_once ('includes/query.php');

?>

<script type="text/javascript">
    function showSuggestions(str)
    {
      if(str.length == '')
      {
        document.getElementById('output').innerHTML = '';
      }
      else
      {
        // AJAX
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200)
          {
              document.getElementById('output').innerHTML = this.responseText;
          }
        }
        xmlhttp.open("GET", "ajaxSearch.php?q="+str, true);
        xmlhttp.send();
      }
    }

</script>


<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="<?php echo 'index.php'; ?>">CSE311 Marketplace</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" style="">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo 'index.php'; ?>">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo 'shops.php'; ?>">Shops</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo 'products.php'; ?>">Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo 'shopkeepers.php'; ?>">Shopkeepers</a>
      </li>
      <li class="nav-item">
        <?php if($_SESSION['isLoggedIn'] != 0): ?>
          <?php echo "<a class='nav-link' href='crud.php''>Add/Remove</a>"; ?>
        <?php endif; ?>
      </li>
      <li class="nav-item">
        <?php 
          if ($_SESSION['isLoggedIn'] != 0)
          {
            echo "<a class='nav-link' href='login.php?isLoggedIn=0'>Logout</a>";
          }
          else
          {
            echo "<a class='nav-link' href='login.php'>Login</a>";
          }
        ?>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="search.php" method="GET">
      <span class="badge badge-info"><h4><?php echo $_SESSION['name']; ?></h4></span>
      <input class="form-control mr-sm-2" type="text" name="searchProduct" placeholder="Search Products" onkeyup="showSuggestions(this.value)">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<div style="padding-left: 1100px"><p class="text-info">Suggestions: <span id="output" style="font-weight: bold"></span></p></div>