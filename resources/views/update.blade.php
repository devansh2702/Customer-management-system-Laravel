<!DOCTYPE html>
<html lang="en">
<head>    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: 800px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 70%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}

    </style>
    <?php 
    	$error="";
	  if($_SERVER['REQUEST_METHOD'] == 'POST') {

		if(strtotime($_POST['jdate']) > strtotime('now')) {
			$error="Enter the correct date value";			
		}
}
?>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="POST" action="">
        @csrf
        <h3>Fill details</h3>        
        <label for="id">Id</label>
        <input type="number" name="id"value="{{$data->id}}"
         readonly="readonly">

        <label for="name">Name</label>
        <input type="text" name="name" value="{{$data->name}}" required>

        <label for="email">Email ID</label>
        <input type="text" name="email" value="{{$data->email}}" required>

        
        <label for="contact">Contact no.</label>
        <input type="tel"  name="contact" value="{{$data->contact}}" required>


        <label for="joining_date">joining date<br><span style="color: red;"><?php 
        	if($_SERVER["REQUEST_METHOD"] == "POST") {
        		echo $error;
        	}
        ?></span></label>
        <input type="date" name ="joining_date" value="{{$data->joining_date}}" required>

        <label for="last_transaction">Last transaction</label>
        <input type="number" name="last_transaction"value="{{$data->last_transaction}}" required>
        

        <input type="submit" value="Update record">        
    </form>    
    
</body>
</html>
<body>
