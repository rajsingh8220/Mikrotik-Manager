<style type="text/css">
<!--
	#formContainer{
	   width: 500px;
       height: auto;
       margin-top: 10px;
       border: 1px solid #DDDDDD;
       background: #F3F3F5;
	}
    #head{
        width: 900px;
        height: 40px;
        background:#DD4814;
        margin-top: -10px;
    }
    label{
        color: #444444;
        font-size: 15px;
        font-family: arial;
        font-weight: bold;
    }
    input[type=text]{
        width: 190px;
        padding: 5px;
        font-weight: bold;
    }
    input[type=password]{
        width: 190px;
        padding: 5px;
    }
    input[type=submit]{
        
        padding: 2px;
        background:#DD4814;
        color: white;
        font-weight: bold;
        border: 1px solid #884400;
        cursor: pointer;
        width: 120px;
    }
    input[type=submit]:hover{
        
        
        color: silver;
        
    }
    a{
        text-decoration: none;
        font-family: arial;
        font-size: 12px;
        color: #DD4814;
    }
-->
</style>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Bandwidth Manger:: Websurfer Pvt Ltd</title>
        
        <!-- Our CSS stylesheet file -->
        <link rel="stylesheet" href="<?php echo base_url();?>_css/styles.css" />
        
       
    </head>
<body>
   
        <center>
        <div id="head"></div>
        <div style="height: 90px; text-align: left; width: 500px; background:;">
           
            <h1 style="float: left; margin-left: 25px; margin-top: 40px;">Bandwidth Manager</h1>
        </div>
		<div id="formContainer">
			<form id="login" method="post" action="<?php echo base_url();?>login/login_user">
				<table style="margin-top: 20px;">
                    <tr>
                        <td><label>Username: </label></td>
                        <td><input type="text" name="username" id="loginEmail" /></td>
                    </tr>
                    <tr>
                        <td><label>Password: </label></td>
                        <td><input type="password" name="password" id="loginPass"  /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><br /><input type="submit" name="submit" value="Login" /></td>
                    </tr>
                </table>
				
			</form>
			
           
		</div>
        </center>
        <div style="border-top: 2px #DD4814 solid; margin-top: 100px; font-family: arial; font-size: 12px;">
            defg
        </div>
      
		
</body>
   
</html>

