<?php
session_start();
include_once('db_connection.php');

if (isset($_POST['verify_otp'])) {
    if (isset($_SESSION['forgot_email'])) {
        $email = $_SESSION['forgot_email'];

        $otp = isset($_POST['otp']) ? implode("", $_POST['otp']) : "";

        // Fetch the OTP from the database for the given email
        $query = "SELECT otp FROM password_reset_requests WHERE email = '$email' ";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $db_otp = $row['otp'];
            if (!$db_otp) {
                $_SESSION['error'] = 'OTP has expired. Regenerate New OTP';
                header("Location: forget_password.php");
                exit();
            }
            // Compare the OTPs
            else {
                if ($otp == $db_otp) {
                    header("Location: reset_password.php");
                    exit();
                } else {
                    $_SESSION['error'] = 'Incorrect OTP';
                    header("Location: verify_otp.php");
                    exit();
                }
            }
        } else {
            $_SESSION['error'] = 'OTP has expired. Regenerate New OTP';
            header("Location: forget_password.php");
            exit();
        }
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


                <!-- Display session messages -->
                <?php
                if (isset($_SESSION['success'])) {
                    echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
                    unset($_SESSION['success']); // Clear session message
                }
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
                    <div class="error" id="otpError"></div>
                    <div id="timer" class="text-danger"></div>
                    <div class="d-flex justify-content-center mb-4" name="otp">
                        <button type="button" id="resend_otp" class="btn btn-success btn-md" style="display:none; background-color: #0B032D;">Resend OTP
                        </button>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="verify_otp" class="btn btn-success btn-md" style="background-color: #0B032D;">Verify OTP</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <!-- <p class="text-muted">Didn't receive the code? <a href="forget_password.php" class="text-decoration-none">Resend OTP</a></p> -->
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

    // For timer
    let timeLeft = 120; // Default timer value
    const timerDisplay = document.getElementById('timer');
    const resendButton = document.getElementById('resend_otp');

    // Function to check if the user is refreshing or coming from another page
    function isPageRefresh() {
        return !!sessionStorage.getItem('otpTimer'); // If otpTimer exists, it's a refresh
    }

    // If the page is refreshed, use sessionStorage value
    if (isPageRefresh()) {
        timeLeft = parseInt(sessionStorage.getItem('otpTimer'), 10);
    } else {
        // If the user comes from another page, reset timer
        sessionStorage.setItem('otpTimer', 120);
        timeLeft = 120;
    }

    function startCountdown() {
        resendButton.style.display = "none"; // Hide the button initially
        timerDisplay.innerHTML = `Resend OTP in ${timeLeft} seconds`;

        const countdown = setInterval(() => {
            if (timeLeft <= 0) {
                clearInterval(countdown);
                timerDisplay.innerHTML = "You can now resend the OTP.";
                resendButton.style.display = "inline";
                sessionStorage.removeItem('otpTimer'); // Clear sessionStorage after timer ends
            } else {
                timerDisplay.innerHTML = `Resend OTP in ${timeLeft} seconds`;
                timeLeft -= 1;
                sessionStorage.setItem('otpTimer', timeLeft); // Update sessionStorage
            }
        }, 1000);
    }

    // Start countdown only if the timer is above 0
    if (timeLeft > 0) {
        startCountdown();
    } else {
        resendButton.style.display = "inline";
        timerDisplay.innerHTML = "You can now resend the OTP.";
    }

    resendButton.onclick = function(event) {
        event.preventDefault(); // Prevent default form submission
        sessionStorage.setItem('otpTimer', 120); // Reset timer
        window.location.href = 'resend_otp_forgot_password.php';
    };
</script>