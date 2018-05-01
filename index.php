
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
                                alert("Username is AVAILABLE!");
                            }else{
                                alert("Username ALREADY TAKEN!");
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
                        
                            $("#city").html(data.city);
                            $("#latitude").html(data.latitude);
                            $("#longitude").html(data.longitude);
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
                Zip Code:    <input type="text" id="zipcode"><br>
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
                
                Desired Username: <input type="text" id="username"><br>
                
                Password: <input type="password"><br>
                
                Type Password Again: <input type="password"><br>
                
                <input type="submit" value="Sign up!">
            </fieldset>
        </form>
    
    </body>
</html>