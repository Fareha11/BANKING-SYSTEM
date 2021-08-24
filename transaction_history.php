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
.display_table
{
    width:100vw;
    height:100vh;
    display:flex;
    flex-direction:column;
    justify-content: center;
    text-align:center;
}
.center_div
{
    width:90vw;
    height:80vh;
    background-image:url('images/2.jpg');
    background-repeat:no-repeat;
    background-size:100%;
    padding:20px 0 0 0;
    box-shadow:0 10px 20px 0 rgba(0,0,0,0.03);
    border-radius:10px;
    margin-left:30px;
}



table
{
    border-collapse:collapse;
    background-color:black;
    box-shadow:0 10px 20px 0 rgba(0,0,0,0.03);
    border-radius: 10px;
    border-collapse:collapse;
    table-layout:fixed;
    opacity:0.7;
    color:#F7CC1A;
    font-weight:bold;
    margin:auto;
}
th,td
{
  border:1px solid #f2f2f2;
   padding:10px 40px;
  text-align:center;
  opacity:0.9;
  color:#f0f3f1 ; 
}
th{
    text-transform:uppercase;
    font-weight:500;
}
td
{
    font-size:13px;
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
                  <a href="home.html" class="nav-link text-white">HOME</a></li>
              <li class="nav-item">
                  <a href="customer1.php" class="nav-link text-white">CUSTOMER LIST</a></li>
              <li class="nav-item">
                  <a href="transaction_history.php" class="nav-link text-white">HISTORY</a></li>    
               </ul>
        </div>
     </div>

      
           
          <div class="display_table">
                 <h1 style="color:white">TRANSACTION HISTORY</h1>
                 <div class="center_div">
               <div class="table-responsive">
                    <table>
                    <thead>
                     <tr>
                      <th>SENDER'S Name</th>
                      <th>RECEIVER'S NAME</th>
                      <th>AMOUNT</th>
                    </tr>
                    </thead>
                   <tbody>
                </div>
                <?php
       include 'connection.php';
       $selectquery = " select * from history1";
       $query = mysqli_query($conn,$selectquery);
       $numofrows = mysqli_num_rows($query);
       while($res = mysqli_fetch_array($query))
        {
      ?>

      <tr>
        <td style="color:white"><?php echo $res['sname'];?></td>
        <td style="color:white"><?php echo $res['rname'];?></td>
        <td style="color:white"><?php echo $res['amount'];?></td>
      </tr>

      <?php
        }
      ?>


</tbody>
</table>
</div>

</div>
 </div>
</div>
 

</body>
</html>
