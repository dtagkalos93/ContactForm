
(function ($) {
    "use strict";


    /*==================================================================
     [ Focus Contact2 ]*/
    $('.input100').each(function () {
        $(this).on('blur', function () {
            if ($(this).val().trim() != "") {
                $(this).addClass('has-val');
            } else {
                $(this).removeClass('has-val');
            }
        })
    })


    /*==================================================================
     [ Validate ]*/
    var name = $('.validate-input input[name="name"]');
    var lastname = $('.validate-input input[name="lastname"]');
    var phone = $('.validate-input input[name="phone"]');
    var email = $('.validate-input input[name="email"]');
    var message = $('.validate-input textarea[name="message"]');


    $('.validate-form').on('submit', function () {
        var check = true;

        if ($(name).val().trim() == '') {
            showValidate(name);
            check = false;
        }

        if ($(lastname).val().trim() == '') {
            showValidate(lastname);
            check = false;
        }

        if ($(phone).val().trim() == '') {
            showValidate(phone);
            check = false;
        }


        if ($(email).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
            showValidate(email);
            check = false;
        }

        if ($(message).val().trim() == '') {
            showValidate(message);
            check = false;
        }

        return check;
    });


    $('.validate-form .input100').each(function () {
        $(this).focus(function () {
            hideValidate(this);
        });
    });

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }



})(jQuery);




function modal(i) {
    document.getElementById("modalname").innerHTML = document.getElementById("name" + i).textContent;
    document.getElementById("modallastname").innerHTML = document.getElementById("lastname" + i).textContent;
    document.getElementById("modalemail").innerHTML = document.getElementById("email" + i).textContent;
    document.getElementById("modalphone").innerHTML = document.getElementById("phone" + i).textContent;
    $("#modalbridge").val(document.getElementById("bridge" + i).textContent).change();

    document.getElementById("modalcomments").innerHTML = document.getElementById("comments" + i).textContent;
    document.getElementById("change").setAttribute('onclick', "saveData('" + i + "')");


    $("#editModal").modal();

}

function saveData(i) {
    console.log("here");
    var modalName = document.getElementById("modalname").textContent;
    var modalLastname = document.getElementById("modallastname").textContent;
    var modalEmail = document.getElementById("modalemail").textContent;
    var modalPhone = document.getElementById("modalphone").textContent;
    var modalbridge = document.getElementById("modalbridge").value;
    var modalcom = document.getElementById("modalcomments").textContent;
    console.log(modalEmail);
    var uri = "submit.php?id=" + i + "&name=" + modalName + "&lastname=" + modalLastname + "&email=" + modalEmail + "&phone=" + modalPhone + "&bridge=" + encodeURIComponent(modalbridge)
            + "&comment=" + modalcom;
    var res = encodeURI(uri);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            if (this.responseText == 'success') {
                
                document.getElementById("name" + i).innerHTML = modalName;
                document.getElementById("lastname" + i).innerHTML = modalLastname;
                document.getElementById("email" + i).innerHTML = modalEmail;
                document.getElementById("phone" + i).innerHTML = modalPhone;
                document.getElementById("bridge" + i).innerHTML = modalbridge;
                $('#editModal').modal('hide');
                document.getElementById("comments" + i).innerHTML = modalcom;

            } else {
                alert("Something wrong happened!!!");
            }
        }
    };
    xmlhttp.open("GET", res, true);
    xmlhttp.send();



}