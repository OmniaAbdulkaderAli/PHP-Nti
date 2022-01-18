<?php

if ($_POST) {
  $errors = [];
  if (!$_POST['client']) {
    $errors['client'] = "<div class='alert alert-danger'>Your name is required</div>";
  }
  if (!$_POST['city']) {
    $errors['city'] = "<div class='alert alert-danger'>City is required</div>";
  }
  if (empty($_POST['num'])) {
    $errors['num'] = "<div class='alert alert-danger'>Number Product is required</div>";
  }
  $number = $_POST['num'];

  function products($number)
  {
    $table = "<table class='table'>
    <thead>
                <tr class='table'>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quntity</th>
              </tr>
              </thead><tbody>";
              for ($i = 0; $i < $number; $i++) {
                $table .= "<tr>
                            
                           <td><input type='text' class='form-control' name='product[$i]'></td>
                            <td><input type='text' class='form-control' name='price[$i]'></td>
                            <td><input type='text' class='form-control' name='quan[$i]'></td>
                          </tr>";
              }
              $table .= "</tbody></table>
              <button class='btn' type='submit' name='calc'>calculate invoice </button>";
              return $table;
            }


  
                 function total($number)
  {
    $table = "<table class='table'>
              <thead>
                <tr class='table-light'>
                  <th scope='col'>Product Name</th>
                  <th scope='col'>Price</th>
                  <th scope='col'>Quntity</th>
                  <th scope='col'>Sub Total</th>
                </tr>
              </thead><tbody>";
    $total = 0;
    for ($i = 0; $i < $number; $i++) {
      $priceproduct = $_POST['price'][$i] * $_POST['quan'][$i];
      $table .= "<tr>
                  <td>" . $_POST['product'][$i] . "</td>
                  <td>" . $_POST['price'][$i] . "</td>
                  <td>" . $_POST['quan'][$i] . "</td>
                  <td>" . $priceproduct . "</td></tr>";
      $total =  $total + $priceproduct;
    }

    return $arrey = [$table, $total];
  }

  
}
?>



<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
    <!-- Required meta tags -->

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="./css/style.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link  rel="stylesheet" href="./css/style.css">
</head>

<body>
  <div class="container right">
    <div class="row">
      <div class="col-6 text-center">
       <h1>Order Now</h1>

        <form method="post">
        <div class="col-12 text-left">

          <div class="form-group">
            <label>Your Full Name</label>
            <input type="text" class="form-control" id="" name='client' value="<?php echo (isset($_POST['client']) ? $_POST['client'] : '') ?>">
            <?php if (isset($errors['client'])) {
              echo $errors['client'];
            } ?>

          </div>
          <div class="form-group">
            <select class="form-control form-control-sm" name='city'>
              <option <?php if (isset($_POST['city']) == 'Cairo') {
                        $delivary = 0;
                        echo "selected";
                      } ?>>Cairo</option>
              <option <?php if (isset($_POST['city']) == 'Benha') {
                        $delivary = 30;
                        echo "selected";
                      } ?>>Benha</option>
             <option <?php if (isset($_POST['city']) == 'Alex'){
                 $delivary = 50;
                 echo "selected";
             } ?>>Alex</option>
              <option <?php if (isset($_POST['city']) == 'Other') {
                        $delivary = 100;
                        echo "selected";
                      } ?>>Other</option>
            </select>
          </div>
          <div class="form-group">
            <label>how many items you need</label>
            <input type="text" class="form-control" id="" name='num' value="<?php echo (isset($_POST['num']) ? $_POST['num'] : '') ?>">
            <?php if (isset($errors['num'])) {
              echo $errors['num'];
            } ?>

          </div>
          <div class="form-group">
            <button class='col-12 btn ' type="submit" name="numpro">Enter Products</button>
          </div>

          <?php
          if (empty($errors) && isset($_POST['numpro'])) {

            echo (products($number));
          } ?>
          <?php
          if (isset($_POST['calc'])) {
            (total($number));
            $table2 = ((total($number))[0]);
            $total = ((total($number))[1]);
            if ($total >= 4500) {
              $discount = 0.2;
            } elseif ($total < 4500 && $total >= 3000) {
              $discount = 0.15;
            } elseif ($total < 3000 && $total >= 1000) {
              $discount = 0.1;
            } else {
              $discount = 0;
            }
            $discountValue = $total * $discount;
            $totalAfterDiscount = $total - $discountValue;
            $numberettotal = $totalAfterDiscount + $delivary;
            $table2 .= "<tr ><th >Client Name</th>
            <td colspan='2'>"  . $_POST['client'] . "</td><td> </td>
            </tr>
            <tr><th>City</th><td colspan='2'>" . $_POST['city'] . "</td><td> </td></tr>
            <tr><th>Total</th><td colspan='2'>" . $total . "</td><td> </td></tr>
            <tr><th>Discount value</th><td colspan='2'>" . $discountValue . "</td></tr>
            <tr><th>Total After Discount</th><td colspan='2'>" . $totalAfterDiscount . "</td></tr>
            <tr><th>Delivary</th><td colspan='2'>" . $delivary . "</td></tr>
            <tr class='bg-light'><th>Net Total</th><td colspan='2'>" . $numberettotal . "</td></tr>";
            $table2 .= "</tbody></table>";
            echo $table2;
          }
          ?>
        </form>
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