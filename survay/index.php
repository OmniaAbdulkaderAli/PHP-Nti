
<?php 
include_once 'header.php';
if(isset($_POST['start'])){
   
  $error=[];
 if(empty($_POST['phone'])){
 
 $error['number']= "<div style='color:#fff; font-size:16px ; padding-left:30px'> please enter number </div> " ;
 
 }
  
 if(empty($error)){
  $_SESSION['phone']= $_POST['phone'];
   header('location:survay.php');
 }
 }

?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->



  <form method="post" >

    <div class="container">
     

      <div class="circleTop"></div>
      <div class="content">
        <h1>your number</h1>
        <div class="form-group">

          <br>
          <input type="tel" min="10" class="form" name="phone" id="" aria-describedby="helpId" placeholder="enter your number">
        </div>
        <?php 
        
        echo isset($error['number']) ?  $error['number'] : "" ?>
        <button style="background-color: #fff;" type="submit" name="start"><a style="font-size: 16px;">start </a></button>

      </div>
      <div class="circleBottom"></div>

    </div>

  </form>
</body>

</html>