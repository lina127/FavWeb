/*
 * I, Yehyun Kim, 000848388 certify that this material is my original 
 * work. No other person's work has been used without due acknowledgement.
 * 
 * Date: Dec.9.2021
 * 
 * This loginPage.js handles event that happens in index.html. With both loginForm and registrationForm, 
 * it sends ajax request to php. New password in registration form, must contains at least 1 numeric value.
 */

/** 
 * Proceed when the whole page loads
 */
$(document).ready(function () {

    /**
     * Check the numeric value in the new password and send ajax request with new userid and password params
     */
    $("#registerForm").submit(function (e) {
        e.preventDefault();

        //check if password contains numeric value
        var password = $("#newpassword").val();
        var containsNumeric = /\d/.test(password);
        //console.log(containsNumeric); //debug
        
        // if password does not contain numeric value, display error
        if (!containsNumeric) {
            $("#checkPassword").html("Must contain at least one number value");
            $("#checkPassword").css("color", "red");
        }
        // if the new password and confirm password textfield matches, proceed
        else if (isPasswordSame()) {
            $("#checkPassword").html("");
            var userId = $("#newid").val();

            //send jQuery ajax request
            $.ajax({
                url: "server/register.php",
                dataType: "text",
                data: {
                    "userId": userId,
                    "password": password
                },
                type: "POST",
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                success: function (response) {
                    $("#message").html(response);
                    $("#message").css("color", "blue");
                    $("#message").css("margin-top", "10px");
                    $("#newid").val("");
                    $("#newpassword").val("");
                    $("#confirmpassword").val("");
                }
            });
        }
        // if it contains numeric value but user didn't enter the same password, delete the numeric error message.
        else{
            $("#checkPassword").html("");
        }
    });



    /**
     * Check if password and confirm password input matches
     */
    function isPasswordSame(){
        if ($("#newpassword").val() != $("#confirmpassword").val()) {
            $("#passwordMatch").html("Password does not match");
            $("#passwordMatch").css("color", "red");
            return false;
        } else {
            $("#passwordMatch").html("");
            return true;
        }
    }


    /**
     * Call isPasswordSame() whenever user types in the new password field
     */
    $("#newpassword").keyup(function (e) {
        isPasswordSame();
    });

    /**
     * Call isPasswordSame() whenever user types in the confirm password field
     */
    $("#confirmpassword").keyup(function (e) {
        isPasswordSame();
    });

    /**
     * Send ajax request to login.php and if it succeed, redirect to the main menu.
     */
    $("#loginForm").submit(function (e){
        e.preventDefault();
        var userId = $("#id").val();
        var password = $("#password").val();
       
        $.ajax({
            url: "server/login.php",
            dataType: "text",
            data: {
                "userId": userId,
                "password": password
            },
            type: "POST",
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            success: function (response) {
                location.href = "server/favwebMenu.php";
            }
        });
    })
    
});