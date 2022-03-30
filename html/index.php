<?php include ("includes/db.php");?>
<?php include ("includes/header.php");?>
  <div class="container-fluid">
  <ul class="nav justify-content-end">
  <li class="nav-item">
    <a class="nav-link" href="includes/adapters/add_tuner.php">Добавить тюнер</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="includes/channels/add_channel.php">Добавить Поток</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Добавить софткам</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
  </li>
</ul>
    <div id="screen">
        <div class="row align-items-center">
            <?php include ("includes/adapters/tuners.php");?>
        </div>
        <div class="row align-items-center">
            <?php include ("includes/channels/streams.php");?>
        </div>
    </div>
  </div>

<script>
setInterval(function(){
    $("#screen").load("index.php #screen");
}, 1000);
</script>
<?php include ("includes/footer.php");?>