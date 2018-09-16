<!DOCTYPE html>
<?php
require('config.php');
$text = "";

session_start();
if (isset($_POST['submit'])) {






    extract($_POST);

    $sql = "Select * FROM info";
    $success = $mysqli->query($sql);
    $i = 1;
    if (mysqli_num_rows($success) > 0) {
        while ($row = mysqli_fetch_assoc($success)) {

            $i = $i + 1;
        }
    }

    $sql = "INSERT into info (name,lastname,email,phone,bridge,comments,id) "
            . "VALUES('" . $name . "','" . $lastname . "','" . $email . "','" . $phone . "','" . $bridge . "','" . $message . "','" . $i . "')";
    $success = $mysqli->query($sql);

    if (!$success) {
        die($text = '<div class="wrap-contact100-form-btn container-title-error">
                            <h5>' . $mysqli->error . '</h5>
                        </div>');
    }

    $text = '<div class="wrap-contact100-form-btn container-title">
                            <h5>Successfull Data Insert</h5>
                        </div>';
    header('Location: index.php');
    exit();
}
?>

<html lang="en">
    <head>
        <title>Contact</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--===============================================================================================-->
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <!--===============================================================================================-->
    </head>
    <body>


        <div class="container-contact100">
            <div class="wrap-contact100">
                <form class="contact100-form validate-form" action="" method="POST">
                    <span class="contact100-form-title">
                        Contact Form
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Name is required">
                        <span class="label-input100">Your Name</span>
                        <input class="input100" type="text" name="name" placeholder="Enter your name">
                        <span class="focus-input100"></span>
                    </div>


                    <div class="wrap-input100 validate-input" data-validate="Last name is required">
                        <span class="label-input100">Your Last Name</span>
                        <input class="input100" type="text" name="lastname" placeholder="Enter your last name">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="text" name="email" placeholder="Enter your email addess">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Phone is required">
                        <span class="label-input100">Phone</span>
                        <input class="input100" type="text" name="phone" placeholder="Enter your phone">
                        <span class="focus-input100"></span>
                    </div>


                    <div class="wrap-input100 input100-select">
                        <span class="label-input100">Bridge</span>
                        <div>
                            <select class="selection-2" name="bridge">
                                <option>None</option>
                                <option>eAgent</option>
                                <option>iArts</option>
                                <option>Orbit</option>
                                <option>G&G</option>
                                <option>EstateWeb</option>
                                <option>Globalc</option>
                            </select>
                        </div>
                        <span class="focus-input100"></span>
                    </div>



                    <div class="wrap-input100 validate-input" data-validate = "Message is required">
                        <span class="label-input100">Message</span>
                        <textarea class="input100" name="message" placeholder="Your message here..."></textarea>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-contact100-form-btn">
                        <div class="wrap-contact100-form-btn">
                            <div class="contact100-form-bgbtn"></div>
                            <button class="contact100-form-btn" id="submit" name="submit">
                                <span>
                                    Submit
                                    <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                                </span>
                            </button>
                        </div>
                    </div>

                    <div class="container-contact100-form-btn ">
                        <?php echo $text ?>

                    </div>
                </form>
            </div>
        </div>

        <div class="container-contact100 container-table" >
            <div class="wrap-contact100 table-wrap">

                <h2>Database Data</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Bridge</th>
                            <th>Comment</th>
                            <th></th>
                        </tr>
                    </thead>



                    <?php
                    $sql = "Select * FROM info";
                    $success = $mysqli->query($sql);
                    $i = 1;
                    if (mysqli_num_rows($success) > 0) {
                        while ($row = mysqli_fetch_assoc($success)) {
                            echo "<tr>";
                            echo "<td id='name" . $i . "'>" . $row['name'] . "</td>";
                            echo "<td id='lastname" . $i . "'>" . $row['lastName'] . "</td>";
                            echo "<td id='email" . $i . "'>" . $row['email'] . "</td>";
                            echo "<td id='phone" . $i . "'>" . $row['phone'] . "</td>";
                            echo "<td id='bridge" . $i . "'>" . $row['bridge'] . "</td>";
                            echo "<td id='comments" . $i . "'>" . $row['comments'] . "</td>";
                            echo "<td><a id='edit' href='#' onclick='modal(" . $i . ");'>Edit</a></td>";
                            echo "</tr>";
                            $i = $i + 1;
                        }
                    }
                    ?>

                </table>
                <?php
                if (mysqli_num_rows($success) == 0) {
                    echo "<h5>No Entries!</h5>";
                }
                $mysqli->close();
                ?>
            </div>
        </div>


        <div id = "editModal" class = "modal" role = "dialog" data-keyboard = "false" data-backdrop = "static" >
            <div class = "modal-dialog" style = "width: 450px">

                <!--Modal content-->
                <div class = "modal-content" >
                    <div class = "modal-header">
                        <button type = "button" class = "close" data-dismiss = "modal">&times;
                        </button>
                        <h4 class = "modal-title" style = " color: white; font-size: 18px; padding: 0.5%">
                            Edit Data</h4>
                    </div>
                    <!--Modal content-->
                    <div class = "modal-body">
                        <div class = "wrap-input100 validate-input" data-validate = "Name is required">
                            <span class = "label-input100" >Your Name</span>
                            <p contenteditable="true" id = "modalname" class = "input100 input-modal" type = "text" name = "name" placeholder = "Enter your name" style = "height: 20px"></p>
                            <span class = "focus-input100"></span>
                        </div>
                        <div class = "wrap-input100 validate-input" data-validate = "Last name is required">
                            <span class = "label-input100" >Your Name</span>
                            <p contenteditable="true" id = "modallastname" class = "input100 input-modal" type = "text" name = "lastname" placeholder = "Enter your Last name" style = "height: 20px"></p>
                            <span class = "focus-input100"></span>
                        </div>
                        <div class = "wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                            <span class = "label-input100" >Email</span>
                            <p contenteditable="true" id = "modalemail" class = "input100 input-modal" type = "text" name = "email" placeholder = "Enter your email" style = "height: 20px"></p>
                            <span class = "focus-input100"></span>
                        </div>
                        <div class = "wrap-input100 validate-input" data-validate = "Phone is required">
                            <span class = "label-input100" >Phone</span>
                            <p contenteditable="true" id = "modalphone" class = "input100 input-modal" type = "text" name = "phone" placeholder = "Enter your Phone" style = "height: 20px"></p>
                            <span class = "focus-input100"></span>
                        </div>
                        <div class = "wrap-input100 input100-select">
                            <span class = "label-input100">Bridge</span>
                            <div>
                                <select id = "modalbridge" class = "selection-2" name = "bridge">
                                    <option value = "None">None</option>
                                    <option value = "eAgent">eAgent</option>
                                    <option value = "iArts">iArts</option>
                                    <option value = "Orbit">Orbit</option>
                                    <option value = "G&G">G&G</option>
                                    <option value = "EstateWeb">EstateWeb</option>
                                    <option value = "Globalc">Globalc</option>
                                </select>
                            </div>
                            <span class = "focus-input100"></span>
                        </div>
                        <div class = "wrap-input100 validate-input" data-validate = "Message is required">
                            <span class = "label-input100">Message</span>
                            <p contenteditable="true" id = "modalcomments" class = "input100" name = "message" placeholder = "Your message here..."></p>
                            <span class = "focus-input100"></span>
                        </div>
                        <div class = "container-contact100-form-btn">
                            <div class = "wrap-contact100-form-btn">
                                <div class = "contact100-form-bgbtn"></div>
                                <button class = "contact100-form-btn" id = "change" name = "submit" >
                                    <span>
                                        Change
                                        <i class = "fa fa-long-arrow-right m-l-7" aria-hidden = "true"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id = "dropDownSelect1"></div>

        <!-- === === === === === === === === === === === === === === === === === === === === === === === === === === === === === === === == -->
        <script src = "vendor/jquery/jquery-3.2.1.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/animsition/js/animsition.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/bootstrap/js/popper.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/select2/select2.min.js"></script>
        <script>
            $(".selection-2").select2({
                minimumResultsForSearch: 20,
                dropdownParent: $('#dropDownSelect1')
            });
        </script>
        <!--===============================================================================================-->
        <script src="vendor/daterangepicker/moment.min.js"></script>
        <script src="vendor/daterangepicker/daterangepicker.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/countdowntime/countdowntime.js"></script>
        <!--===============================================================================================-->
        <script src="js/main.js"></script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-23581568-13');
        </script>

    </body>
</html>
