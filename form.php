<html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="css/userstyle.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@100;400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}
.navbar
{
    width:100%;
    white-space:nowrap;
    background-color: #17181a;
}
.main_div
{
    width:100%;
    height:100vh;
    background: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)),url("ff.jpg")no-repeat center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
   input
  {
      margin-top:10px;
      width:230px;
      height:40px;
      border-radius:5px;
      outline:none;
  }
 ::placeholder
 {
     padding:10px;
     color:rgb(7, 5, 1);
 }
button
{
    color:#07020c;
    background:white;
    border-color:#7A3DAF;
   padding: 14px 30px;
  cursor: pointer;
  width:370px;
  border-radius:5px;  
}
button:hover
 {
     color:white;
     background:#4CAF50;
     border:none;
     opacity:0.8;
 }


 </style>
</head>
<body>
<div class="main_div">
 
     <div class="navbar navbar-expand-md">
   
      <a href="#" class="navbar-brand font-weight-bold text-white text-center">TSF BANK</a>
      <button class="navbar-toggler text-white " type="button" data-toggle="collapse" data-target="#collapsenavbar">
      <span class="navbar-toggler-icon" style="background:white;"></span>
      </button>
     
       <div class="collapse navbar-collapse text-center" id="collapsenavbar">
          <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                  <a href="customer1.php" class="nav-link text-white">CUSTOMER LIST</a></li>
              <li class="nav-item">
                  <a href="transaction_history.php" class="nav-link text-white">HISTORY</a></li>    
               </ul>
        </div>
     </div>


     <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <div class="card text-center" style="margin-top:76px;background: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6));border-radius:10px;color:white">
                <form method="POST">  
                                              
                                              <?php
                                             include 'connection.php';
                                             $ids=$_GET['id'];
                                             $showquery="select * from `customer` where id=($ids) ";
                                             $showdata=mysqli_query($conn,$showquery);
                                             if (!$showdata) {
                                               printf("Error: %s\n", mysqli_error($conn));
                                               exit();
                                             }
                                             $arrdata=mysqli_fetch_assoc($showdata);
                                             
                                             ?> 
                  <div class="card-body">
                     
                     <h3>RECEIVER'S DETAILS</h3>
                         <label>Name</label>
                         <input type="text"  name="name2" value="" required placeholder="Enter receiver's name"/><br><br>
                         <label>Email</label>
                         <input type="text" name="email2" value="" required placeholder="Enter receiver's email id" /><br><br>
                         <label>Amount</label>
                         <input type="text" name="amount1" style="color:#4CAF50" value="" required placeholder="Enter amount"/><br><br>
                         
                     </div>
                   

               </div>
          </div>
          <div class="col-sm-5">
              <div class="card text-center" style="margin-top:76px;background: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6));border-radius:10px;color:white" >
              <div class="card-body">
                   <h3>SENDER'S DETAILS</h3>
                  
                        <label>Name</label>
                        <input type="text"  name="name1" style="color:#4CAF50" value="<?php echo $arrdata['name']; ?>" /><br><br>
                        <label>Email</label>
                        <input type="text" name="email1" style="color:#4CAF50" value="<?php echo $arrdata['email']; ?>" /><br><br>
                        <button  name="submit">Proceed to Pay</button>
                        
                   </div>
                     
                    

               </div>
          </div>
       </div>
       
    </div>
</div>
</form> 
<?php
include 'connection.php';

if(isset($_POST['submit']))
{
    $Sender_name=$_POST['name1'];
    $Sender_email=$_POST['email1'];
    $Sender=$_POST['amount1'];
    $Receiver_name=$_POST['name2'];
    $Receiver_email=$_POST['email2'];

    $ids=$_GET['id'];
    $senderquery="select * from `customer` where id=$ids ";
    $senderdata=mysqli_query($conn,$senderquery);
    if (!$senderdata) {
     printf("Error: %s\n", mysqli_error($conn));
    exit();
    }
    $arrdata=mysqli_fetch_array($senderdata);

    $receiverquery="select * from `customer` where email='$Receiver_email' ";
    $receiver_data=mysqli_query($conn,$receiverquery);
    if (!$receiver_data) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
    }
    $receiver_arr=mysqli_fetch_array($receiver_data);
    $id_receiver=$receiver_arr['id'];

    if($arrdata['balance'] >= $Sender)
    {
      $decrease_sender=$arrdata['balance'] - $Sender;
      $increase_receiver=$receiver_arr['balance'] + $Sender;
       $query="UPDATE `customer` SET `id`=$ids,`balance`= $decrease_sender  where `id`=$ids ";
       $rec_query="UPDATE `customer` SET `id`=$id_receiver,`balance`= $increase_receiver where  `id`=$id_receiver ";
       $res= mysqli_query($conn,$query);
       $rec_res= mysqli_query($conn,$rec_query);
      
      if($res && $rec_res)
      {
?>

  <script>
    swal("Done!", "Transaction Successful!", "success");
  </script> 
    
<?php
  $ins_query = "INSERT INTO history1(`sname`, `rname`, `amount`) VALUES ('$Sender_name','$Receiver_name','$Sender')";
  $query1=mysqli_query($conn,$ins_query);
      }
      else
      {
?>

  <script>
    swal("Error!", "Error Occured!", "error");
  </script> 

<?php
      }
  }
  else
  {
?>

  <script>
    swal("Insufficient Balance", "Transaction Not  Successful!", "warning");
  </script> 

<?php  
  }
}
?>

</body>
</html>