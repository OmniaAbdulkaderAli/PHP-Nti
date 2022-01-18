<?php
include_once 'header.php';

$hospitalnum = $_SESSION['hospitalnum'];
$Servicenum = $_SESSION['Servicenum'];
$nursingnum = $_SESSION['nursingnum'];
$doctornum =  $_SESSION['doctornum'];
$calmnessnum = $_SESSION['calmnessnum'];
$phone = $_SESSION['phone'];
$result;
$msg = [];


function calculateFeedback($hospitalnum, $Servicenum, $nursingnum, $doctornum, $calmnessnum, $phone)
{
    if ($hospitalnum  == 1) {

        $hospitalnum = 0;
    }
    if ($Servicenum  == 1) {

        $Servicenum = 0;
    }
    if ($nursingnum  == 1) {

        $nursingnum = 0;
    }
    if ($doctornum  == 1) {

        $doctornum = 0;
    }
    if ($calmnessnum  == 1) {

        $calmnessnum = 0;
    }

    $result = $hospitalnum + $Servicenum + $nursingnum + $doctornum + $calmnessnum;
    // echo $result;
    if ($result < 25) {

        $msg['feedback'] = "<div style='color:#fff; font-size:20px ;'> we are sorry to hear that our support center will contact you via this number" . " " . $phone;
    } else {

        $msg['feedback'] = "<div style='color:#fff; font-size:20px ;'> thank you  for your time  </div> ";
    }
    // print_r($msg);die;
    return $msg;
}

$msg = calculateFeedback($hospitalnum, $Servicenum, $nursingnum, $doctornum, $calmnessnum, $phone);



?>

<form method="post" style=" color:#fff ;background: linear-gradient(to right bottom, rgb(1 14 19), rgb(132 17 122)); height:100vh ; text-align:center ">

    <h1>Hospital Feedback Form result</h1>
    <p> here's your answer thanks for yout time </p>


    <?php echo isset($error['messege']) ? $error['messege'] : "" ?>
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
            <td><input type="radio" <?php echo ($hospitalnum  == 1 ? "checked" : "disabled") ?> value="1" name="hospital" /> </td>
            <td><input type="radio" <?php echo ($hospitalnum  == 3 ? "checked" : "disabled") ?> value="3" name="hospital" /></td>
            <td><input type="radio" <?php echo ($hospitalnum  == 5 ? "checked" : "disabled") ?> value="5" name="hospital" /></td>
            <td><input type="radio" <?php echo ($hospitalnum  == 10 ? "checked" : "disabled") ?> value="10" name="hospital" /></td>
        </tr>
        <tr>
            <td class="first-col">Are you satisfied with the service prices?y</td>
            <td><input type="radio" <?php echo ($Servicenum  == 1 ? "checked" : "disabled") ?> value="1" name="Service" /></td>
            <td><input type="radio" <?php echo ($Servicenum  == 3 ? "checked" : "disabled") ?> value="3" name="Service" /></td>
            <td><input type="radio" <?php echo ($Servicenum  == 5 ? "checked" : "disabled") ?> value="5" name="Service" /></td>
            <td><input type="radio" <?php echo ($Servicenum  == 10 ? "checked" : "disabled") ?> value="10" name="Service" /></td>
        </tr>
        <tr>
            <td class="first-col">Are you satisfied with the nursing service</td>
            <td><input type="radio" <?php echo ($nursingnum  == 1 ? "checked" : "disabled") ?> value="1" name="nursing" /></td>
            <td><input type="radio" <?php echo ($nursingnum  == 3 ? "checked" : "disabled") ?> value="3" name="nursing" /></td>
            <td><input type="radio" <?php echo ($nursingnum  == 5 ? "checked" : "disabled") ?> value="5" name="nursing" /></td>
            <td><input type="radio" <?php echo ($nursingnum  == 10 ? "checked" : "disabled") ?> value="10" name="nursing" /></td>
        </tr>
        <tr>
            <td class="first-col">Are you satisfied with the level of the doctor?</td>
            <td><input type="radio" <?php echo ($doctornum  == 1 ? "checked" : "disabled") ?> value="1" name="doctor" /></td>
            <td><input type="radio" <?php echo ($doctornum  == 3 ? "checked" : "disabled") ?> value="3" name="doctor" /></td>
            <td><input type="radio" <?php echo ($doctornum  == 5 ? "checked" : "disabled") ?> value="5" name="doctor" /></td>
            <td><input type="radio" <?php echo ($doctornum  == 10 ? "checked" : "disabled") ?> value="10" name="doctor" /></td>
        </tr>
        <tr>
            <td class="first-col">Are you satisfied with the calmness in the hospital? </td>
            <td><input type="radio" <?php echo ($calmnessnum  == 1 ? "checked" : "disabled") ?> value="1" name="calmness" /></td>
            <td><input type="radio" <?php echo ($calmnessnum  == 3 ? "checked" : "disabled") ?> value="3" name="calmness" /></td>
            <td><input type="radio" <?php echo ($calmnessnum  == 5 ? "checked" : "disabled") ?> value="5" name="calmness" /></td>
            <td><input type="radio" <?php echo ($calmnessnum  == 10 ? "checked" : "disabled") ?> value="10" name="calmness" /></td>
        </tr>
    </table>

    <br>
    <?php
    echo isset($msg) ? $msg['feedback'] : "";
    ?>
    <div>

    </div>
</form>