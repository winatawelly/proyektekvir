<!DOCTYPE html>
<html>
<head>
  <script src="jquery-3.4.1.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="additional/style.css">
  <script src="additional/function.js?newversion"></script>

  <title>VMRA</title>
</head>
<body>

  <div id="navbar">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="index.php">VMRA</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Basic<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="advanced.php">Advanced</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="settings.php">Add New VM</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>


  <div id="content">
    <div id="title">
      <h1 class="title">Virtual Machine Remote Access</h2>  
    </div>

    <div class="power">
      <div class="col-sm-2 offset-sm-5">
        <label for="selectedVM">Select VM</label>
        <select class="form-control" id="selectedVM">
          <?php
          include_once "connect.php";
          $sql = "SELECT * FROM vmlocation";
          $result = mysqli_query($con,$sql);
          while($rows = mysqli_fetch_assoc($result)){
            echo "<option value='".$rows['path']."'>".$rows['name']."</option>";
          }
          ?>
    
        </select>
      </div>
      <br>

      <button type="button" class="btn btn-outline-secondary" onclick="power('start')">Start</button>
      <button type="button" class="btn btn-outline-warning" onclick="power('suspend')">Suspend</button>
      <button type="button" class="btn btn-outline-danger" onclick="power('stop')">Stop</button>
    </div>

    <div id="animation">
    </div>
  
  </div>

</body>
</html>
