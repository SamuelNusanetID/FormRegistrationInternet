$(document).ready(function () {
    if ($("#isdataBillersamewithdataPic").prop('checked') == true) {
        const fullNamePersonal = $("#pic_name").val();
        const emailAddressPersonal = $("#pic_email_address").val();
        const phoneNumberPersonal = $("#pic_phone_number").val();
        $("#billing_name").val(fullNamePersonal);
        $("#billing_name").prop('readonly', true);
        $("#billing_email").val(emailAddressPersonal);
        $("#billing_email").prop('readonly', true);
        $("#billing_phone").val(phoneNumberPersonal);
        $("#billing_phone").prop('readonly', true);
    }
    $('#isdataBillersamewithdataPic').change(function () {
        const fullNamePersonal = $("#pic_name").val();
        const emailAddressPersonal = $("#pic_email_address").val();
        const phoneNumberPersonal = $("#pic_phone_number").val();
        if (this.checked) {
            $("#billing_name").val(fullNamePersonal);
            $("#billing_name").prop('readonly', true);
            $("#billing_email").val(emailAddressPersonal);
            $("#billing_email").prop('readonly', true);
            $("#billing_phone").val(phoneNumberPersonal);
            $("#billing_phone").prop('readonly', true);
        } else {
            $("#billing_name").val('');
            $("#billing_name").prop('readonly', false);
            $("#billing_email").val('');
            $("#billing_email").prop('readonly', false);
            $("#billing_phone").val('');
            $("#billing_phone").prop('readonly', false);
        }
    });


    if ($("#isdataTechnicalsamewithdataPic").prop('checked') == true) {
        const fullNamePersonal = $("#pic_name").val();
        const emailAddressPersonal = $("#pic_email_address").val();
        const phoneNumberPersonal = $("#pic_phone_number").val();
        $("#fullname_technical").val(fullNamePersonal);
        $("#fullname_technical").prop('readonly', true);
        $("#email_address_technical").val(emailAddressPersonal);
        $("#email_address_technical").prop('readonly', true);
        $("#phone_number_technical").val(phoneNumberPersonal);
        $("#phone_number_technical").prop('readonly', true);
    }
    $('#isdataTechnicalsamewithdataPic').change(function () {
        const fullNamePersonal = $("#pic_name").val();
        const emailAddressPersonal = $("#pic_email_address").val();
        const phoneNumberPersonal = $("#pic_phone_number").val();
        if (this.checked) {
            $("#fullname_technical").val(fullNamePersonal);
            $("#fullname_technical").prop('readonly', true);
            $("#email_address_technical").val(emailAddressPersonal);
            $("#email_address_technical").prop('readonly', true);
            $("#phone_number_technical").val(phoneNumberPersonal);
            $("#phone_number_technical").prop('readonly', true);
        } else {
            $("#fullname_technical").val('');
            $("#fullname_technical").prop('readonly', false);
            $("#email_address_technical").val('');
            $("#email_address_technical").prop('readonly', false);
            $("#phone_number_technical").val('');
            $("#phone_number_technical").prop('readonly', false);
        }
    });
});
