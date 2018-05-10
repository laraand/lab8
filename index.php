
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AJAX: Sign Up Page</title>

        <script src="http://code.jquery.com/jquery-3.1.0.js"></script>
        <script>
        
            function validateForm() {
                
                return false;
           
            }
    
        </script>
        <script>
            $(document).ready( function(){
                
                $("#subBtn").click(function(){
                    if($("#zipError").html() == "Zipcode not valid.") {
                        alert("Zipcode not valid.");
                    } else if($("#pswrd1").val() != $("#pswrd2").val()){
                        alert("Passwords do not match.");
                    } else if($("#error").html() == "Username is taken.") {
                        alert("Username is not valid.");
                    } else {
                        alert("Requirements are met!");
                        location.reload();
                    }
                });
                
                $("#pswrd1").change( function() {
                    if($("#pswrd1").val() != $("#pswrd2").val()){
                        $("#passwordCheck").html("Passwords do not match.");
                    } else {
                        $("#passwordCheck").html("");
                    }
                });
                
                $("#pswrd2").change( function() {
                    if($("#pswrd1").val() != $("#pswrd2").val()){
                        $("#passwordCheck").html("Passwords do not match.");
                    } else {
                        $("#passwordCheck").html("");
                    }
                });
                
                $("#username").change(function() {
                    //alert("Enter name please");
                    $.ajax({
                        type: "GET",
                        url: "checkUsername.php",
                        dataType: "json",
                        data: { "username": $("#username").val() },
                        success: function(data,status) {
                            //alert(data.password);
                            if(!data){
                                // alert("Username is AVAILABLE!");
                                $("#error").html("Username is AVAILABLE");
                                $("#error").css("color","green");
                            }else{
                                // alert("Username ALREADY TAKEN!");
                                $("#error").html("Username is TAKEN.");
                                $("#error").css("color","red");
                            }
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                    });//ajax
                });
                
                $("#state").change(function() {
                    // alert("state").val();
                    $.ajax({

                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/countyList.php?state=ca",
                        dataType: "json",
                        data: { "state": $("#state").val() },
                        success: function(data,status) {
                            //alert(data[0].county);
                            $("#county").html("<option> - Select One - </option>");
                            for(var i=0; i < data.length; i++){
                                $("#county").append("<option>" + data[i].county + "</option>");
                            }
                            
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                    });//ajax
                    
                });
                
                $("#zipcode").change(function(){
                    //alert($("#zipcode").val() ); 
                    
                    $.ajax({

                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/cityInfoByZip.php?zip=93955",
                        dataType: "json",
                        data: { "zip": $("#zipcode").val() },
                        success: function(data,status) {
                            if(!data){
                                $("#zipError").html("Zipcode not valid.");
                            }else{
                                $("#zipError").html("");
                                $("#city").html(data.city);
                                $("#latitude").html(data.latitude);
                                $("#longitude").html(data.longitude);
                            }
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                        });//ajax
                    
                    } );
                
            } );
            
        </script>
    </head>

    <body>
    
       <h1> Sign Up Form </h1>
    
        <form onsubmit="return validateForm()">
            <fieldset>
               <legend>Sign Up</legend>
                First Name:  <input type="text"><br> 
                Last Name:   <input type="text"><br> 
                Email:       <input type="text"><br> 
                Phone Number:<input type="text"><br><br>
                Zip Code:    <input type="text" id="zipcode"><span id="zipError"></span><br>
                City: <span id="city"></span>
                <br>
                Latitude: <span id ="latitude"></span>
                <br>
                Longitude:<span id="longitude"></span>
                <br><br>
                State: 
                <select id="state">
                    <option value="">Select One</option>
                    <option value="ca"> California</option>
                    <option value="ny"> New York</option>
                    <option value="tx"> Texas</option>
                    <option value="va"> Virginia</option>
                </select><br />
                
                Select a County: <select id="county"></select><br>
                
                Desired Username: <input type="text" id="username"><span id="error">*Must be unique</span><br>
                
                Password: <input type="password" id= "pswrd1"><br>
                
                Type Password Again: <input type="password" id="pswrd2"><br>
                
                <div id="passwordCheck"></div>
                
                <input type="submit" id="subBtn" value="Sign up!">
                
                <div id="recordAdded"></div>
            </fieldset>
        </form>
    
    </body>
</html>