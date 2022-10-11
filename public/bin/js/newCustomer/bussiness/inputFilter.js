$(document).ready(function () {
    setInputFilter(document.getElementById("pic_identity_number"), function (value) {
        return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
    }, "Nomor Identitas harus berupa angka");
    setInputFilter(document.getElementById("pic_phone_number"), function (value) {
        return /^\d*\+?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
    }, "Nomor Handphone harus berupa angka");
    setInputFilter(document.getElementById("company_phone_number"), function (value) {
        return /^\d*\+?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
    }, "Nomor Telepon Perusahaan harus berupa angka");
    setInputFilter(document.getElementById("billing_phone"), function (value) {
        return /^\d*\+?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
    }, "Nomor Handphone harus berupa angka");
    setInputFilter(document.getElementById("phone_number_technical"), function (value) {
        return /^\d*\+?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
    }, "Nomor Handphone harus berupa angka");
});

function setInputFilter(textbox, inputFilter, errMsg) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop", "focusout"]
        .forEach(function (event) {
            textbox.addEventListener(event, function (e) {
                if (inputFilter(this.value)) {
                    // Accepted value
                    if (["keydown", "mousedown", "focusout"].indexOf(e.type) >= 0) {
                        this.classList.remove("input-error");
                        this.setCustomValidity("");
                    }
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    // Rejected value - restore the previous one
                    this.classList.add("input-error");
                    this.setCustomValidity(errMsg);
                    this.reportValidity();
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    // Rejected value - nothing to restore
                    this.value = "";
                }
            });
        });
};
