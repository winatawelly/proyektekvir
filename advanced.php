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
          <li class="nav-item">
            <a class="nav-link" href="index.php">Basic</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="advanced.php">Advanced<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="settings.php">Add New VM</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>


  <div id="content">
    <div class="title">
      <h1>Advanced</h1>
      
    </div>
    <div id="login" class="col-sm-4 offset-sm-4">
      <label for="loginVM">Select VM</label>
        <select class="form-control" id="loginVM">
          <?php
          include_once "connect.php";
          $sql = "SELECT * FROM vmlocation";
          $result = mysqli_query($con,$sql);
          while($rows = mysqli_fetch_assoc($result)){
            echo "<option value='".$rows['path']."'>".$rows['name']."</option>";
          }
          ?>
        </select>

          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" placeholder="Enter Username">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Enter password">
          <br>
          <div class="text-center">
            <button type="button" onclick="loginVM()" class="btn btn-outline-secondary btn-lg">Login</button>  
          </div>
                
    </div>
    <div class="col-sm-4 offset-sm-4 text-left" style="display: none;" id="advancedTabs">
       <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#clone">Clone</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#liveTerminal">Live Terminal</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#uploadRunScript">Upload/Run Script</a>
        </li>
      </ul>

      <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active show" id="clone">
          <div>
            <label for="selectedVM">Select VM to clone</label>
            <select class="form-control" id="selectedVM" onchange="prename()">
              <option>Select VM to clone</option>
              <?php
              include_once "connect.php";
              $sql = "SELECT * FROM vmlocation";
              $result = mysqli_query($con,$sql);
              while($rows = mysqli_fetch_assoc($result)){
                echo "<option value='".$rows['path']."'>".$rows['name']."</option>";
              }
              ?>
            </select>

            <label for="clonedvmName">VM Name</label>
            <input type="text" class="form-control" id="clonedvmName" placeholder="Enter VM name">
            <div>
              <label for="cloneType">Clone Type</label>
              <select class="form-control" id="cloneType">
                <option value="fclone">Full Clone</option>
                <option value="lclone">Linked Clone</option>
              </select>
              <small id="cloneHelp" class="form-text text-muted">Full Cloning may take a while.</small>
            </div>
            

            <label for="cloneDir">Clone Directory</label>
            <input type="text" id="cloneDir" class="form-control" placeholder="Enter Clone Directory">
            <br>
            <div class="text-center">
              <button onclick="addClone()" type="button" class="btn btn-outline-success btn-lg">Submit</button>  
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="liveTerminal">
          <div id="scripting" style="display: none;">
            <div class="terminal">
              <div id="historyDisp">
                
              </div>
              <div id="history" style="display: none;">
                
              </div>
              <div class="line" id="terminalHead">
                <input type="text" id="input">
              </div>
            </div>
            <br>
            <div class="terminal">
              <pre id="terminalOutput">
                
              </pre>
              
            </div>
          </div>  
        </div>
        <div class="tab-pane fade" id="uploadRunScript">
          <label for="scriptType">Script Type</label>
          <select class="form-control" id="scriptType">
            <option value="/bin/bash">Bash</option>
            <option value="/usr/bin/python3">Python 3</option>
            <option value="/usr/bin/perl">Perl</option>
            
          </select>
          <label for="scriptFile">Select your script file</label>
          <input type="file" id="scriptFile" class="form-control-file">
          <br>
          <div class="text-center">
              <button onclick="runScript()" type="button" class="btn btn-outline-success btn-lg">Run</button>  
          </div>
          <br>
          <div>
            <label for="scriptOutput">Output</label>
              <div class="terminal">
                <pre id="scriptOutput">
                  
                </pre>
              </div>
          </div>
        </div>
      </div>  
    </div>
    <br>
    <div id="message" class="col-sm-4 offset-sm-4 text-center">
      
    </div>
    <div id="advancedAnimation">
        
    </div>
    
   

  </div>

</body>
</html>
