$(document).ready(function () {
    if ($("#isdataBillersamewithdataPersonal").prop('checked') == true) {
        const fullNamePersonal = $("#fullname_personal").val();
        const emailAddressPersonal = $("#email_address_personal").val();
        const phoneNumberPersonal = $("#phone_number_personal").val();
        $("#fullname_biller").val(fullNamePersonal);
        $("#fullname_biller").prop('readonly', true);
        $("#email_address_biller_primary").val(emailAddressPersonal);
        $("#email_address_biller_primary").prop('readonly', true);
        $("#phone_number_biller").val(phoneNumberPersonal);
        $("#phone_number_biller").prop('readonly', true);
    }
    $('#isdataBillersamewithdataPersonal').change(function () {
        const fullNamePersonal = $("#fullname_personal").val();
        const emailAddressPersonal = $("#email_address_personal").val();
        const phoneNumberPersonal = $("#phone_number_personal").val();
        if (this.checked) {
            $("#fullname_biller").val(fullNamePersonal);
            $("#fullname_biller").prop('readonly', true);
            $("#email_address_biller_primary").val(emailAddressPersonal);
            $("#email_address_biller_primary").prop('readonly', true);
            $("#phone_number_biller").val(phoneNumberPersonal);
            $("#phone_number_biller").prop('readonly', true);
        } else {
            $("#fullname_biller").val('');
            $("#fullname_biller").prop('readonly', false);
            $("#email_address_biller_primary").val('');
            $("#email_address_biller_primary").prop('readonly', false);
            $("#phone_number_biller").val('');
            $("#phone_number_biller").prop('readonly', false);
        }
    });


    if ($("#isdataTechnicalsamewithdataPersonal").prop('checked') == true) {
        const fullNamePersonal = $("#fullname_personal").val();
        const emailAddressPersonal = $("#email_address_personal").val();
        const phoneNumberPersonal = $("#phone_number_personal").val();
        $("#fullname_technical").val(fullNamePersonal);
        $("#fullname_technical").prop('readonly', true);
        $("#email_address_technical").val(emailAddressPersonal);
        $("#email_address_technical").prop('readonly', true);
        $("#phone_number_technical").val(phoneNumberPersonal);
        $("#phone_number_technical").prop('readonly', true);
    }
    $('#isdataTechnicalsamewithdataPersonal').change(function () {
        const fullNamePersonal = $("#fullname_personal").val();
        const emailAddressPersonal = $("#email_address_personal").val();
        const phoneNumberPersonal = $("#phone_number_personal").val();
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
