<?php
    
include ('../database/dbconnect.php');
session_start();

$email = $_SESSION['email'];
$query=mysqli_query($conn,"SELECT * FROM employer  WHERE emailAddress = '$email';");
$result=mysqli_fetch_array($query);

$job_id = $_GET['job-id'];
$query2=mysqli_query($conn,"SELECT * FROM hire_employee join employee on hire_employee.employeeEmail = employee.emailAddress join service_portfolio on hire_employee.servicePortfolioId = service_portfolio.id left join job_payments on job_payments.jobId = $job_id where hire_employee.id = '$job_id'");
$result2=mysqli_fetch_array($query2);



?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="/img/nagad_favicon.png" sizes="16x16">
    <title>Nagad Payment Page: Account</title>
    <link rel="stylesheet" type="text/css" href="https://payment.mynagad.com:30000/css/nagad.css">
</head>

<body>
<div class="payment-screen mobile-number-screen">
    <div class="payment-container">
        <div class="btn-group lang-switcher" role="group" aria-label="Basic example">
            <button id="bn_btn" type="button" class="btn btn-secondary" onclick="changeLanguage('bn')">বাং</button>
            <button id="en_btn" type="button" class="btn btn-secondary" onclick="changeLanguage('en')">Eng</button>
        </div>
        <div class="merchant-info">
            <div class="top-icon">
                <img class="img-fluid" src="https://payment.mynagad.com:30000//img/cart.png" alt="">
            </div>
            <div class="merchant-name">Work For All</div>
        </div>
        <div class="payment-infos">
            <p class="payment-info additional-field mb-0">
                <strong class="translateable" data-trans-key="invoice_no">Invoice No</strong>&nbsp;
                <span>sOwXr1IBzb</span>
            </p>
            <p class="payment-info additional-field mb-0">
                <strong class="translateable" data-trans-key="total">Total Amount</strong>&nbsp;
                <span>BDT <?php echo $result2['service_salary'] ?></span>
            </p>
            <p class="payment-info additional-field mb-0">
                <strong class="translateable" data-trans-key="charge">Charge</strong>&nbsp;
                <span>BDT 0</span>
            </p>
            <p class="payment-info additional-field mb-0">
                <strong class="translateable" data-trans-key="additional_field_name"></strong>&nbsp;
                <span></span>
            </p>
        </div>
        <div class="form-container mobile-number-form">
            <form id="account-form" action="action/nagad-pay-action.php" method="post">
                <input type="hidden" value="<?php echo $job_id ?>"  name="job_id">
                <input type="hidden" value="<?php echo $result2['service_salary'] ?>" name="salary">
                <div class="form-group">
                    <label for="" class="translateable" data-trans-key="account_number_label"></label>
                    <div class="box-inputs">
                        <input class="form-control" inputmode="numeric" pattern="[0-9]*" type="number"
                               maxlength="1" autofocus>
                        <input class="form-control" inputmode="numeric" pattern="[0-9]*" type="number"
                               maxlength="1">
                        <input class="form-control" inputmode="numeric" pattern="[0-9]*" type="number"
                               maxlength="1">
                        <span class="input-divider">-</span>
                        <input class="form-control" inputmode="numeric" pattern="[0-9]*" type="number"
                               maxlength="1">
                        <input class="form-control" inputmode="numeric" pattern="[0-9]*" type="number"
                               maxlength="1">
                        <input class="form-control" inputmode="numeric" pattern="[0-9]*" type="number"
                               maxlength="1">
                        <input class="form-control" inputmode="numeric" pattern="[0-9]*" type="number"
                               maxlength="1">
                        <span class="input-divider">-</span>
                        <input class="form-control" inputmode="numeric" pattern="[0-9]*" type="number"
                               maxlength="1">
                        <input class="form-control" inputmode="numeric" pattern="[0-9]*" type="number"
                               maxlength="1">
                        <input class="form-control" inputmode="numeric" pattern="[0-9]*" type="number"
                               maxlength="1">
                        <input class="form-control" inputmode="numeric" pattern="[0-9]*" type="number"
                               maxlength="1">
                    </div>
                </div>

                <div class="messages">
                    <span class="text-error"></span>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" id="termsChecked" name="tnc">
                    <label class="form-check-label translateable" for="termsChecked"
                           data-trans-key="terms_condition_label">
                           I agree to the terms and conditions
                    </label>
                </div>

              

                <div class="action-buttons">
                    <button type="submit" class="btn translateable" data-trans-key="proceed_btn">Proceed</button>
                    <button type="button" class="btn translateable" id="close-window"
                            data-trans-key="close_btn">Close</button>
                </div>
            </form>
        </div>
        <div class="nagad-logo">
            <img class="img-fluid" src="https://payment.mynagad.com:30000/img/logo.png" alt="">
        </div>
    </div>
</div>

<script src="/js/jquery-3.5.1.min.js"></script>
<script src="/js/jsencrypt.min.js"></script>
<script>
    /*<![CDATA[*/
    var pubKey = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiCWvxDZZesS1g1lQfilVt8l3X5aMbXg5WOCYdG7q5C+Qevw0upm3tyYiKIwzXbqexnPNTHwRU7Ul7t8jP6nNVS\/jLm35WFy6G9qRyXqMc1dHlwjpYwRNovLc12iTn1C5lCqIfiT+B\/O\/py1eIwNXgqQf39GDMJ3SesonowWioMJNXm3o80wscLMwjeezYGsyHcrnyYI2LnwfIMTSVN4T92Yy77SmE8xPydcdkgUaFxhK16qCGXMV3mF\/VFx67LpZm8Sw3v135hxYX8wG1tCBKlL4psJF4+9vSy4W+8R5ieeqhrvRH+2MKLiKbDnewzKonFLbn2aKNrJefXYY7klaawIDAQAB";
    var referenceNo = "MDUyMDIxMTQ1ODM4Ny42ODc2MjYyODA4MTUwNDUuc093WHIxSUJ6Yi5iNTEyYTk4NTM3ZDIwNTA5NzkyNg==";
    var lang = "EN";
    var additionFieldText = null;
    /*]]>*/

    window.referenceNo = referenceNo
    window.lang = lang.toLowerCase()
    window.backendTranslations = {
        'en_additional_field_name':additionFieldText['EN']?(additionFieldText['EN']+':'):"Additional Field:",
        'bn_additional_field_name':additionFieldText['BN']?(additionFieldText['BN']+':'):"অতিরিক্ত ক্ষেত্র:"
    }

</script>
<script src="https://payment.mynagad.com:30000/js/language.js"></script>
<script src="https://payment.mynagad.com:30000/js/script.js"></script>
<script>
    $('#account-form').on('submit', function (e) {
        e.preventDefault();
        submitForm();
    });

    function submitForm() {
        clearMessages()
        var form = $('#account-form')

        var mobileNumber = getMergeAllFieldValuesUnderBoxInput(form)

        // Validation
        if (!validateMobileNumber(mobileNumber)) {
            showError(trans(getSelectedLang()+'_mobile_no_invalid'), 'mobile_no_invalid')
            return 0
        }
        if ($('#termsChecked').prop("checked") === false) {
            showError(trans(getSelectedLang()+'_terms_condition_unchacked'),'terms_condition_unchacked')
            return 0
        }

        //selected locale
        $('#selectedLocale').val(window.lang.toUpperCase())
        //encrypt mobile no
        $('#encryptedPhoneNum').val(encryptData(mobileNumber));
        //tnc boolean
        // form[0].tnc.value = true;
        //submit form
        form[0].submit();
        return true;
    }

    // Validate mobile number
    function validateMobileNumber(mobNum) {
        var regx = /^01[3-9][0-9]{8}/;
        return regx.test(mobNum);
    }

    // Encrypt Data
    function encryptData(data){
        var encryptedData = new JSEncrypt();
        encryptedData.setPublicKey(pubKey);
        return encryptedData.encrypt(data);
    }

    history.pushState({}, document.title, location.href);
    window.addEventListener('popstate', function (event) {
        var leavePage = confirm(trans(getSelectedLang()+"_back_btn_clicked"));
        if (leavePage) {
            abort()
        } else {
            history.pushState(null, document.title, location.href);
        }
    });
</script>
</body>

</html>