  <?php
  include_once 'header.php';

  if (isset($_POST['submit'])) {
    $error = [];

    if (empty($_POST['hospital'])) {

      $error['messege'] = "<div style='color:#green; font-size:20px ;'> please answer all question </div> ";
    }

    if (empty($_POST['Service'])) {
      $error['messege'] = "<div style='color:#green; font-size:20px ;'> please answer all question </div> ";
    }

    if (empty($_POST['nursing'])) {
      $error['messege'] = "<div style='color:#green; font-size:20px ;'> please answer all question </div> ";
    }

    if (empty($_POST['doctor'])) {
      $error['messege'] = "<div style='color:#green; font-size:20px ;'> please answer all question </div> ";
    }

    if (empty($_POST['calmness'])) {

      $error['messege'] = "<div style='color:#green; font-size:20px ;'> please answer all question </div> ";
    }

    if (!$error) {

      $_SESSION['hospitalnum'] = $_POST['hospital'];
      $_SESSION['Servicenum'] = $_POST['Service'];
      $_SESSION['nursingnum'] = $_POST['nursing'];
      $_SESSION['doctornum'] = $_POST['doctor'];
      $_SESSION['calmnessnum'] = $_POST['calmness'];

      header('location:feedback.php');
    }


    // get the value from user



  }



  // calculate the total feedback

  // give the user result



  ?>



  <div class="testbox">


    <form method="post" style="color:#fff ;background: linear-gradient(to right bottom, rgb(1 14 19), rgb(132 17 122)); height:100vh ; text-align:center">

      <h1>hospital Feedback Form</h1>
      <p>Please help us improve our services by filling in our feedback form. Thank you!</p>
      <br>

      <?php echo isset($error['messege']) ? $error['messege'] : "" ?>

      <br>
      </select>

      <table style="color:#fff">
        <tr>
          <th class="first-col"></th>
          <th>bad</th>
          <th>Good</th>
          <th>Very Good</th>
          <th>exclent</th>
        </tr>
        <tr>
          <td class="first-col"> Are you satisfied with the level of cleanliness?</td>
          <td><input type="radio" value="1" name="hospital" /> </td>
          <td><input type="radio" value="3" name="hospital" /></td>
          <td><input type="radio" value="5" name="hospital" /></td>
          <td><input type="radio" value="10" name="hospital" /></td>
        </tr>
        <tr>
          <td class="first-col">Are you satisfied with the service prices?y</td>
          <td><input type="radio" value="1" name="Service" /></td>
          <td><input type="radio" value="3" name="Service" /></td>
          <td><input type="radio" value="5" name="Service" /></td>
          <td><input type="radio" value="10" name="Service" /></td>
        </tr>
        <tr>
          <td class="first-col">Are you satisfied with the nursing service</td>
          <td><input type="radio" value="1" name="nursing" /></td>
          <td><input type="radio" value="3" name="nursing" /></td>
          <td><input type="radio" value="5" name="nursing" /></td>
          <td><input type="radio" value="10" name="nursing" /></td>
        </tr>
        <tr>
          <td class="first-col">Are you satisfied with the level of the doctor?</td>
          <td><input type="radio" value="1" name="doctor" /></td>
          <td><input type="radio" value="3" name="doctor" /></td>
          <td><input type="radio" value="5" name="doctor" /></td>
          <td><input type="radio" value="10" name="doctor" /></td>
        </tr>
        <tr>
          <td class="first-col">Are you satisfied with the calmness in the hospital? </td>
          <td><input type="radio" value="1" name="calmness" /></td>
          <td><input type="radio" value="3" name="calmness" /></td>
          <td><input type="radio" value="5" name="calmness" /></td>
          <td><input type="radio" value="10" name="calmness" /></td>
        </tr>
      </table>

      <div class="btn-block">
        <button type="submit" name="submit"> Send Feedback</button>
      </div>
    </form>
  </div>
  </body>

  </html>