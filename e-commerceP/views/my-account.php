<?php
include_once "layouts/header.php";
include_once "layouts/nav.php";
include_once "../app/models/User.php";

$userObject  = new User;
$errors = [];
$success = [];
//update profile
if (isset($_POST['update-profile'])) {
    // validate on inputes
    $userObject->setId($_SESSION['user']->id);
    $userObject->setName($_POST['name']);
    $userObject->setPhone($_POST['phone']);
    $userObject->setGender($_POST['gender']);
    if ($_FILES['image']['error'] == 0) {
        if ($_FILES['image']['size'] > (10 ** 6)) {
            $errors['update-profile']['image']['image-size'] = "<div class='alert alert-danger'> Image Must Be Less Than 1 MegaByte </div>";
        }

        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $allowedExtensions = ['png', 'jpg', 'jpeg'];
        if (!in_array($extension, $allowedExtensions)) {
            $errors['update-profile']['image']['image-extension'] = "<div class='alert alert-danger'> Image Must be jpg,png or jpeg </div>";
        }

        if (!isset($errors['update-profile']['image'])) {
            $dir = '../assets/img/users/';
            $photoName = time() . '-user-id-' . $_SESSION['user']->id . '.' . $extension;
            $fullPath = $dir . $photoName;
            move_uploaded_file($_FILES['image']['tmp_name'], $fullPath);
            $userObject->setImage($photoName);
        }
    }
    $updateDataResult = $userObject->updateData();
    if ($updateDataResult) {
        $success['update-profile']['update-success'] = "<div class='alert alert-success'> Data Updated Successfully </div>";
    } else {
        $errors['update-profile']['update-error'] = "<div class='alert alert-danger'> Something Went Wrong </div>";
    }
}



$userObject->setId($_SESSION['user']->id);
$getUserResult = $userObject->getUserById();
$user = $getUserResult->fetch_object();
$_SESSION['user'] = $user;


?>
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>MY ACCOUNT</h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">My Account</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<!-- my account start -->
<div class="checkout-area pb-80 pt-100">
    <div class="container">
        <div class="row">
            <div class="ml-auto mr-auto col-lg-9">
                <div class="checkout-wrapper">
                    <div id="faq" class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>1</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Edit your account information </a></h5>
                            </div>
                            <div id="my-account-1" class="panel-collapse collapse <?= isset($_POST['update-profile']) ? 'show' : '' ?>">
                                <!-- show -->
                                <div class="panel-body">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="billing-information-wrapper">
                                            <div class="account-info-wrapper">
                                                <h4>My Account Information</h4>
                                                <h5>Your Personal Details</h5>
                                                <?php
                                                if (isset($errors['update-profile'])) {
                                                    foreach ($errors['update-profile'] as $error) {
                                                        echo $error;
                                                    }
                                                }

                                                if (isset($success['update-profile'])) {
                                                    foreach ($success['update-profile'] as $success) {
                                                        echo $success;
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row mb-4">
                                                        <div class="col-4 offset-4">
                                                            <img src="../assets/img/users/<?= $user->image ?>" class="rounded-circle w-100" alt="">
                                                            <input type="file" name="image" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 ">
                                                    <div class="billing-info">
                                                        <label>Full Name</label>
                                                        <input type="text" name="name" value="<?= $user->name ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Phone</label>
                                                        <input type="text" name="phone" value="<?= $user->phone ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Gender</label>
                                                        <select name="gender" class="form-control" id="">
                                                            <option <?= $user->gender == 'm' ? 'selected' : '' ?> value="m">Male</option>
                                                            <option <?= $user->gender == 'f' ? 'selected' : '' ?> value="f">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-btn">
                                                    <button type="submit" name="update-profile">update profile</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>2</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Change your password </a></h5>
                            </div>
                            <div id="my-account-2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Change Password</h4>
                                            <h5>Your Password</h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <label>Password</label>
                                                    <input type="password">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <label>Password Confirm</label>
                                                    <input type="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="billing-back-btn">
                                            <div class="billing-back">
                                                <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                            </div>
                                            <div class="billing-btn">
                                                <button type="submit">Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>3</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-3">Modify your address book entries </a></h5>
                            </div>
                            <div id="my-account-3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Address Book Entries</h4>
                                        </div>
                                        <div class="entries-wrapper">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                    <div class="entries-info text-center">
                                                        <p>Farhana hayder (shuvo) </p>
                                                        <p>hastech </p>
                                                        <p> Road#1 , Block#c </p>
                                                        <p> Rampura. </p>
                                                        <p>Dhaka </p>
                                                        <p>Bangladesh </p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                    <div class="entries-edit-delete text-center">
                                                        <a class="edit" href="#">Edit</a>
                                                        <a href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="billing-back-btn">
                                            <div class="billing-back">
                                                <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                            </div>
                                            <div class="billing-btn">
                                                <button type="submit">Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>4</span> <a href="wishlist.html">Modify your wish list </a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- my account end -->
<?php include_once "layouts/footer.php" ?>