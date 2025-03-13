<?php
session_start();
include_once('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $otp = isset($_POST['otp']) ? implode("", $_POST['otp']) : "";

    if (empty($otp)) {
        $_SESSION['error'] = "OTP cannot be empty!";
        header("Location: verify_otp.php");
        exit;
    }

    // Check OTP in the database
    $query = "SELECT id FROM password_reset_requests WHERE email = '$email' AND otp = '$otp' AND expires_at > UTC_TIMESTAMP()";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['verified'] = true;
        header("Location: reset_password.php");
        exit;
    } else {
        $_SESSION['error'] = "Invalid or expired OTP!";
        header("Location: verify_otp.php"); // Stay on the page if OTP is wrong
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify OTP</title>
</head>

<body>
    <?php include 'header.php'; ?>

    <section class="d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-6">
            <div class="card shadow p-4">
                <h2 class="text-uppercase text-center mb-4">Enter OTP</h2>
                <p class="text-muted text-center mb-4">Please enter the verification code sent to your email</p>

                <!-- Display error messages -->
                <?php
                if (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
                    unset($_SESSION['error']); // Clear message after showing
                }
                ?>

                <form method="post">
                    <div class="d-flex justify-content-center mb-4 gap-2">
                        <input type="text" name="otp[]" class="form-control text-center" maxlength="1">
                        <input type="text" name="otp[]" class="form-control text-center" maxlength="1">
                        <input type="text" name="otp[]" class="form-control text-center" maxlength="1">
                        <input type="text" name="otp[]" class="form-control text-center" maxlength="1">
                        <input type="text" name="otp[]" class="form-control text-center" maxlength="1">
                        <input type="text" name="otp[]" class="form-control text-center" maxlength="1">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success btn-md" style="background-color: #0B032D;">Verify OTP</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <p class="text-muted">Didn't receive the code? <a href="forget_password.php" class="text-decoration-none">Resend OTP</a></p>
                    <a href="login.php" class="text-decoration-none">Back to Login</a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>

</html>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let inputs = document.querySelectorAll("input[name='otp[]']");

        inputs.forEach((input, index) => {
            input.addEventListener("input", (e) => {
                let value = e.target.value;

                // Move to the next box if a number is entered
                if (value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            input.addEventListener("keydown", (e) => {
                // Move back on Backspace if empty
                if (e.key === "Backspace" && input.value === "" && index > 0) {
                    inputs[index - 1].focus();
                }
            });

            input.addEventListener("paste", (e) => {
                e.preventDefault();
                let pastedData = (e.clipboardData || window.clipboardData).getData("text").trim();

                if (/^\d{6}$/.test(pastedData)) { // Check if exactly 6 digits
                    let otpArray = pastedData.split("");
                    inputs.forEach((inp, i) => inp.value = otpArray[i] || ""); // Fill inputs
                    inputs[5].focus(); // Focus last input
                }
            });
        });
    });
</script>