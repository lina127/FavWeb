/*
 * I, Yehyun Kim, 000848388 certify that this material is my original 
 * work. No other person's work has been used without due acknowledgement.
 * 
 * Date: Dec.9.2021
 * 
 * This loginPage.js handles event that happens in favwebMenu.php. It can toggle new website form, delete, update and add websites.
 */

/** 
 * Proceed when the whole page loads
 */
$(document).ready(function () {
    updatePage(); //loads the whole website lists that user stored

    /**
     * Toggles new website add form 
     */
    $("#newFormDisplay").click(function (e) {
        toggleNewForm();
    });

    /**
     * hide/display the add new website form
     */
    function toggleNewForm() {
        $("#newForm").toggle();
    }

    /**
     * Send ajax request to addWebsite.php with new website name and new url as params.
     * If succeed, it update the webstie list and toggles the form.
     */
    $("#newForm").submit(function (e) {
        e.preventDefault();
        var newWebsiteName = $("#newWebsiteName").val();
        var newUrl = $("#newUrl").val();
        $.ajax({
            url: "addWebsite.php",
            dataType: "text",
            data: {
                "newWebsiteName": newWebsiteName,
                "newUrl": newUrl
            },
            type: "POST",
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            success: function (response) {
                // if success, update the table and toggle the form
                if (response == "success") {
                    $("#newWebsiteName").val("");
                    $("#newUrl").val("");
                    $("#sameUrl").html("");
                    updatePage();
                    toggleNewForm();
                } 
                // if not, display response message
                else{
                    $("#sameUrl").html(response);
                    $("#sameUrl").css("color", "red");
                }

            }
        });

    });

    /**
     * Get the current list of the websites that user saved
     */
    function updatePage() {
        $.ajax({
            url: "updateUserWebsites.php",
            dataType: "json",
            type: "POST",
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            success: function (websiteList) {
                $("#websiteTable").html("");
                for (let i = 0; i < websiteList.length; i++) {
                    let row = i + 1; // since i starts from 0, add 1
                    let websiteName = websiteList[i].websiteName;
                    let url = websiteList[i].url;
                    let visitCount = websiteList[i].visitCount;
                    let websiteId = websiteList[i].websiteId;
                    $("#websiteTable").append("<tr><th scope='row'>" + row + "</th><td>" + websiteName + "</td><td>" + url + "</td><td><a href='" + url + "' class='urlClick' id='browse" + websiteId + "' target='_blank'>" + websiteName + "</a><td>" + visitCount + "</td><td><button type='button' class='btn btn-close btn-sm deleteButton' id='" + websiteId + "'></button></td></tr>");
                }
            }
        });
    }

    /**
     * If user clicks delete button, stores the button id and send it to deleteWebsite.php.
     */
    $(document).on("click", ".deleteButton", function (e) {
        var selectedId = $(this).attr("id");
        $.ajax({
            url: "deleteWebsite.php",
            dataType: "text",
            data: {
                "selectedId": selectedId
            },
            type: "POST",
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            success: function (websiteList) {
                updatePage();
            }
        });
    });


    /**
     * If user browse the website the visit count increases by 1.
     */
    $(document).on("click", ".urlClick", function (e) {
        var selectedUrlId = $(this).attr("id").substring(6); // since id is 'browse##' substring only the number value

        $.ajax({
            url: "updateVisitCount.php",
            dataType: "text",
            data: {
                "selectedUrlId": selectedUrlId
            },
            type: "POST",
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            success: function () {
                updatePage();
            }
        });
    });

    /**
     * Redirect to logout.php page
     */
    $("#logoutButton").click(function (e) {
        $(location).prop('href', 'logout.php');
    });
});