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
          <li class="nav-item">
            <a class="nav-link" href="advanced.php">Advanced</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="settings.php">Add New VM<span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>
  </div>

  <div id="content">

    <div class="col-sm-6 offset-sm-3 text-center title">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#addNewVM">Add New VM</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#vmList">VM List</a>
        </li>
      </ul>

      <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active show" id="addNewVM">
          <div id="title">
            <h1 class="title">Add New VM</h1>  
          </div>

          <div class="text-left">
            <label for="vmname">VM Name</label>
            <input type="text" class="form-control" id="vmname" placeholder="Enter VM name">

            <label for="vmloc">VM Location</label>
            <input type="text" class="form-control" id="vmloc" placeholder="Path to .vmx file">
            <br>
            <div id="message">
            </div>
            <div class="text-center">
              <button onclick="addVM()" type="button" class="btn btn-outline-success btn-lg">Submit</button>  
            </div>
          </div>
          
        </div>

        <div class="tab-pane fade" id="vmList">
          <div id="title">
            <h1 class="title">VM List</h1>  
          </div>

          <select class="form-control" id="sortBy" onchange="getVMList()">
            <option>Select VM Type</option>
            <option>All</option>
            <option>Original</option>
            <option>Full Clone</option>
            <option>Linked Clone</option>
          </select>

          <br>
          <div id="vmListTable" >
            
          </div>

      
        </div>
        
      </div>
      
    </div>

    

    

    
  </div>

</body>
</html>
