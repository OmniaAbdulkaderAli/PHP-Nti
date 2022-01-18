<!-- //username
    //amount
    // how many years 
    if the duearion less than 3 years -> 10% yearlly 
    if more than 3 years 15 %
    ( result)
    intrest amount , total amount after intrest , monthly amount 
// -->

<?php


// check username input
$error=[];
$result=[];
if(isset($_POST['calculate'])){
  $loan = $_POST['loanamount'];
  $duration = $_POST['years'];
if(empty($_POST['username'])){
  $error['name']="<div style=' color:red; font-size:20px ;'> please enter your full name </div> ";
}
// check amount input

if(empty($_POST['loanamount'])){
  $error['amount']="<div style=' color:red; font-size:20px ;'> please enter how much you want to loan </div> ";
}

//check years input

if(empty($_POST['years'])){
  $error['years']="<div style='color:red; font-size:20px ;'> please enter how many years </div> ";
}

if(empty($error)){

  function calculatloan ($loan, $duration){

    if($duration <= 3 )
  {
   $result['intrest'] = $loan * 0.10 * $duration;
   $result['total'] = $loan + $result['intrest'];
   $result['monthly']= $result['total']/ (12*$duration);
  
  }else{
    $result['intrest'] = $loan * 0.15 ;
    $result['total'] = $loan + $result['intrest'];
   
    $result['monthly']= $result['total']/ (12* $duration );
  }
  
  return $result;
  }
  $result =calculatloan($loan, $duration);
}

}





?>
<!-- <!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./my.css">
   
    
</head>
  <body>

<div id="slideBox">
  <div class="topLayer">

    <div class="right">
      <div class="content">
        <h3>please fill the input to calculate your loan</h3>
        <form id="form-login" method="post">
          <div class="form-element form-stack">
            <label for="username-login" class="form-label">Username</label>
            <input id="username-login" type="text" name="username" value="<?= isset($_POST['username'])? $_POST['username']: ""  ?>" > 
             <?= isset($error['name'])? $error['name']:"" ?>
          </div>
          <div class="form-element form-stack">
            <label for="loan" class="form-label">Loan amount </label>
            <input id="loan" type="number" name="loanamount" value=" <?= isset($_POST['loanamount'])? $_POST['loanamount']: ""  ?>">
            <?= isset($error['amount'])?  $error['amount']:"" ?>
          </div>
          <div class="form-element form-stack">
            <label for="years" class="form-label"> Do you want to pay the installments in how many years </label>
            <input id="years" type="number" name="years" value="<?= isset($_POST['years'])? $_POST['years']: ""?>" >
            <?= isset($error['years'])?  $error['years']:"" ?>
          </div>

         <div class="result">
         <div> 
           <label> the intrest </label>
           <p><?= isset($result['intrest']) ?  $result['intrest'] : ""  ?></p>    
          </div>

          <div>
            <label> totla amount</label>
            <p> <?= isset($result['total']) ?  $result['total'] : "" ?> </p>
          </div>
         
          <div>
            <label>monthly installation </label>
            <p><?= isset($result['monthly']) ?  $result['monthly'] : "" ?> </p> 
          </div>
         </div>
          <div class="form-element form-submit">
            <button id="calculate" class="login" type="submit" name="calculate"> calculate </button>
              
          </div>
        </form>
      </div>
    </div>
  </div>
</div>  


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
</body>
</html>