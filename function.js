//terminal function
$(function() {
	$('.terminal').on('click', function(){
  	 $('#input').focus();
  });

  $('#input').on('keydown',function search(e) {
		if(e.keyCode == 13) {
    	// append your output to the history,
      // here I just append the input
    	$('#history').append($(this).val()+';');
    	$('#historyDisp').append($(this).val()+'<br>');
    	printOutput(); //print output;
      
      // you can change the path if you want
      // crappy implementation here, but you get the idea
      if($(this).val().substring(0, 3) === 'cd '){
  			$('#path').html('>');
      }
      
      // clear the input
      $('#input').val('');
      
    }
  });
});

//print output from terminal
function printOutput(){
	var script = $("#history").text();
	script = script.replace(/\s\s+/g, ' ');
	script = script.substring(0, script.length-1);
	script += ' > /tmp/outfile';
	var loginVM = $('#loginVM').find(":selected").val();
	var username = $("#username").val();
	var password = $("#password").val();
	var interpreter =  "/bin/bash";
	var type = 'run';
	$.ajax({
		type:"POST",
		url:"runScript.php",
		data:{loginVM:loginVM,username:username,password:password,script:script,interpreter:interpreter,type:type},
		success: function(response){
			$("#terminalOutput").html(response);
		}
	})

	
	
}

var isLoading = false;

// Power on, stop, or suspend the VM
function power(mode){
	//check if there is another running process in background
	if(isLoading == false){
		isLoading = true;
	}
	else{
		alert("Another process is already running. Please wait for it to finish!");
		return;
	}
	//play animation
	$("#animation").html('');
	$("#animation").append('<h3 style="text-align:center;">Loading...</h3>');
	$("#animation").append('<div class="loader">Loading...</div>');
	//get selected vm data
	var selectedVM = $('#selectedVM').find(":selected").val();
	
	//send selected vm and selected mode to power.php
	$.ajax({
		type:"POST",
		url:"power.php",
		data:{mode:mode,selectedVM:selectedVM},
		complete:function(data){
			//stop animation and display message
			if(data.responseText == "VM is on !"){
				data.responseText = $('#selectedVM').find(":selected").text()+" is now online!";
			}
			else if(data.responseText == "VM is suspended !"){
				data.responseText = $('#selectedVM').find(":selected").text()+" is suspended!";
			}
			else if(data.responseText == "VM is stopped !" ){
				data.responseText = $('#selectedVM').find(":selected").text()+" is now offline!";
			}
			$("#animation").html('<h3 style="text-align:center;">'+data.responseText+'</h3');
			isLoading = false;

		}

	})

}

//add vm to database
function addVM(name,loc,type){
	//get name and location if no parameter passed
	if(name === undefined && loc === undefined && type == undefined){
		name = $("#vmname").val();
		loc = $("#vmloc").val();
		type = "Original";
	}
	

	//check if name and loc is empty
	if (!name.replace(/\s/g, '').length){
	  alert("VM Name cannot be empty!");
	  return;
	}

	if (!loc.replace(/\s/g, '').length){
	  alert("VM Location cannot be empty!");
	  return;
	}

	//replace "\" with "/"
	loc = loc.replace(/\\/g, "/");

	//check if path is correct by checking the extension of given path == vmx
	if(loc.charAt(loc.length-1) != 'x' && loc.charAt(loc.length-2) != 'm' && loc.charAt(loc.length-1) != 'v'){
		alert("Please check your path again!");
		return;
	}

	//send data to addVM.php
	$.ajax({
		type:"POST",
		url:"addVM.php",
		data:{name:name,loc:loc,type:type},
		complete:function(data){
			if(data.responseText == "success"){
				$("#message").html('<div class="alert alert-dismissible alert-success"><strong>Well done!</strong> '+name+' successfully added.</div>')

			}
			else{
				$("#message").html('<div class="alert alert-dismissible alert-danger"><strong>Oh snap!</strong> VM name or location already exist.</div>')

			}
		}
	})
}

//set preset name for cloned vm
function prename(){
	var clonedVM = $('#selectedVM').find(":selected").text();
	if(clonedVM == "Select VM to clone"){
		return;
	}
	$("#clonedvmName").val(clonedVM+"(CLONE)");
}

//create clone
function addClone(){
	//check if there is another running process in background
	if(isLoading == false){
		isLoading = true;
	}
	else{
		alert("Another cloning process is already running. Please wait for it to finish!");
		return;
	}

	var selectedVM = $('#selectedVM').find(":selected").val();
	var clonedvmName = $("#clonedvmName").val();
	var cloneType = $("#cloneType").val();
	var cloneDir = $("#cloneDir").val();

	//check if name and loc is empty
	if (!clonedvmName.replace(/\s/g, '').length){
	  alert("VM Name cannot be empty!");
	  return;
	}
	if (!cloneDir.replace(/\s/g, '').length){
	  alert("VM Location cannot be empty!");
	  return;
	}

	//replace "\" with "/"
	cloneDir = cloneDir.replace(/\\/g, "/");

	//add path for clonedvm.vmx
	if(cloneDir.charAt(cloneDir.length-1) == "/"){
		cloneDir += clonedvmName+".vmx";

	}
	else{
		cloneDir += "/"+clonedvmName+".vmx";
	}

	//play animation
	$("#advancedAnimation").html('');
	$("#advancedAnimation").append('<h3 style="text-align:center;">Cloning...</h3>');
	$("#advancedAnimation").append('<div class="loader">Cloning...</div>');

	$.ajax({
		type:"POST",
		url:"addClonedVM.php",
		data:{selectedVM:selectedVM,clonedvmName:clonedvmName,cloneDir:cloneDir,cloneType:cloneType},
		complete:function(data){
			if(data.responseText == 'completed'){
				$("#advancedAnimation").html(''); //stop animation is cloning completed
				if(cloneType == "fclone"){
					cloneType = "Full Clone";
				}
				else if(cloneType == "lclone"){
					cloneType = "Linked Clone";
				}
				addVM(clonedvmName,cloneDir,cloneType); //add cloned vm to database
				isLoading = false;
			}
		}
	})
}

//get vm list 
function getVMList(){
	var sortBy = $("#sortBy").find(":selected").text(); //get sort by
	$.ajax({
		type:"GET",
		url:"getVMList.php",
		data:{sortBy:sortBy},
		complete:function(data){
			$("#vmListTable").html('');
			var table = `<table class='table table-hover'>
			<tr class="table-active">
			<th>VM Name</th>
			<th>VM Location</th>
			<th>VM Type</th>
			<th></th>
			</tr>`;
			var obj = JSON.parse(data.responseText); //parse JSON response
			//make table and display data
			for(i in obj){
				table += `<tr class='table-secondary'><td>${obj[i].name}</td><td>${obj[i].path}</td><td>${obj[i].type}</td>
				<td><button type="button" class="btn btn-outline-danger" onclick="deleteVM(this)">Delete</button></td></tr>`
			}
			table += `</table>`
			$("#vmListTable").html(table);
			
		}
	})
	
}
//delete vm
function deleteVM(x){
	//get vm name
	var vmname = $(x).closest("tr").find("td:eq(0)").text();
	var vmloc = $(x).closest("tr").find("td:eq(1)").text();
	var r = confirm("Delete "+vmname+" VM ?");
	if(!r){
		return;
	}
	$.ajax({
		type:"POST",
		url:"deleteVM.php",
		data:{vmname:vmname,vmloc:vmloc},
		complete:function(data){
			getVMList();
		}
	})
}

//login is required when doing live scripting
function loginVM(){
	//get vm path for login;
	var loginVM = $('#loginVM').find(":selected").val();
	var username = $("#username").val();
	var password = $("#password").val();
	var type = 'login';
	$("#advancedAnimation").html('');
	$("#advancedAnimation").append('<h3 style="text-align:center;">Logging in...</h3>');
	$("#advancedAnimation").append('<div class="loader">Cloning...</div>');
	$.ajax({
		method:"POST",
		url:"login.php",
		data:{loginVM:loginVM,username:username,password:password,type:type},
		complete:function(data){
			$("#advancedAnimation").html('');
			if(data.responseText == 'success'){
				$("#login").css("display","none");
				$("#scripting").css("display","block");
				$("#scripting").prepend("<label>Selected VM</label><input class='form-control' type='text' value='"+$('#loginVM').find(":selected").text()+"' readonly>");
				$("#message").html('');
				$("#terminalHead").prepend("<span id='path'>"+username+":/&nbsp;>&nbsp;</span>");
				$("#advancedTabs").css("display","block");

			}
			else{
				$("#message").html('<div class="alert alert-dismissible alert-danger"><strong>Oh snap!</strong> Username or password is incorrect.</div>')
			}
		}
	})
}

//run script from file
function runScript(){
	var loginVM = $('#loginVM').find(":selected").val();
	var username = $("#username").val();
	var password = $("#password").val();
	var interpreter = $("#scriptType").val();
	var type = 'runFile';
	$(document).ready(function(){
	  var fd = new FormData($('form')[0]);
	  fd.append("fileupload", $("#scriptFile")[0].files[0]);
	  //upload text file
	  $.ajax({
	    url: "upload.php",
	    type: "POST",
	    contentType: false,
	    processData: false,
	    data: fd,
	      success: function(result) {
	      	//result is the path to uploaded text file;
	      	$.ajax({
	      		type:"POST",
	      		url:"runScript.php",
	      		data:{loginVM:loginVM,username:username,password:password,script:result,interpreter:interpreter,type:type},
	      		complete:function(data){
	      			$("#scriptOutput").html(data.responseText);
	      		}
	      	})
	       
	      }
	  });
	});


	
}
	


