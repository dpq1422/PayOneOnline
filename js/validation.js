// JScript File
var $ = jQuery.noConflict();
var businessType = "";
var otherType = "";
$(document).ready(function () {
    // /*Top Menu Active State*/
    //    var hrefArr = (window.location.href).split('/');
    //    var HrefVal = hrefArr[hrefArr.length - 1];
    //    $('#menu li a').each(function () {
    //        //var text = $(this).text();
    //        if (HrefVal.toLowerCase() == $(this).attr("href").toLowerCase()) {
    //            $(this).attr('style', 'color:#E88618;font-weight:bold;');
    //        }
    //    });

    //End of Top menu active States
});

function doClear() {
    $("input[type='text'], textarea, input[type='password'], input[type='file']").val("");
    $("input[type='checkbox']").removeAttr('Checked');
    //$("select").val("");
    return false;
}
function checkNum(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
function getContent(filename, holderid) {
    $.ajax({
        url: filename,
        type: 'POST',
        dataType: 'html',
        async: true,
        beforeSend: function () {
            //alert("beforesend")
            //$.mobile.showPageLoadingMsg();
        },
        success: function (data, textStatus, xhr) {
            //alert(data);
            $('#' + holderid).html(data)
        },
        error: function (xhr, textStatus, errorThrown) {
            //alert(textStatus);
        }
    });
    return true;
}
function getContentlist(filename, holderid) {
    $.ajax({
        url: filename,
        type: 'POST',
        dataType: 'html',
        async: true,
        beforeSend: function () {
            //alert("beforesend")
            //$.mobile.showPageLoadingMsg();
        },
        success: function (data, textStatus, xhr) {
            //alert(data);
            $('#' + holderid).html(data);
            ddlType = new DropDown($('#ddltype'));
        },
        error: function (xhr, textStatus, errorThrown) {
            //alert(textStatus);
        }
    });
}



function dovalidate(id, msg) {

    var validation = true;
    var mobileValidation = true;
    var EmailValidation = true;
    var focusID = ""
    var Elecnt = 0
    jQuery('#' + id + ' .required').each(function () {
        //$(this).removeClass('error');
        //$(this).attr('style', '');
        if ($(this).val() == "") {
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            //$(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("Title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }

        // chk validation
        if ($(this).val() == "CAR/JEEP") {
            Elecnt = Elecnt + 1
            alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }

        if ($(this).val() == "Report To") {
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }

        if ($(this).val() == "Business Type") {
            businessType = 1
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }
        if ($(this).val() == "Select Corporate") {
            businessType = 1
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }
        if ($(this).val() == "Select Outlet Catagories") {
            businessType = 1
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }


        if ($(this).val() == "Select Address Proof") {
            businessType = 1
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }


        if ($(this).val() == "Select ID Proof") {
            businessType = 1
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }




        if ($(this).val() == "Reporting To") {
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }




        if ($(this).val() == "Select") {
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }

        if ($('option:selected', $(this)).text() == "Select Pay Type") {
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }


        if ($(this).val() == "Select Bank Name") {
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }


        if ($(this).val() == "Select Package Details") {
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }
        if ($(this).val() == "Select Pay Type") {
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }






        if ($(this).val() == "Select City") {
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }

        if ($(this).val() == "Cities Not Available") {
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }
    });
    jQuery('#' + id + ' .required1').each(function () {
        //$(this).removeClass('error');
        if ($(this).val() == "") {
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }
        else {
            var value = $(this).val();
            var atposition = value.indexOf("@")
            var dotposition = value.lastIndexOf(".")
            if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= value.length) {
                Elecnt = Elecnt + 1
                //alert($(this).attr('style'))
                $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
                //$(this).css('background', '#fde6e1')
                //$(this).addClass('errorTxt');
                $(this).val("");
                $(this).attr('placeholder', 'Invalid Format');
                // $(this).attr('style','Display:Block;');
                //$(this).addClass('error');
                if (Elecnt == 1)
                    focusID = $(this).attr("id");
                validation = false;

            }
        }
    });




    jQuery('#' + id + ' .numbervalidate').each(function () {
        if ($(this).val() == "") {
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }
        else {
            var value = $(this).val();
            if (value == 0) {
                Elecnt = Elecnt + 1
                //alert($(this).attr('style'))
                $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
                //$(this).css('background', '#fde6e1')
                //$(this).addClass('errorTxt');
                $(this).val("");
                $(this).attr('placeholder', 'Invalid Format');
                // $(this).attr('style','Display:Block;');
                //$(this).addClass('error');
                if (Elecnt == 1)
                    focusID = $(this).attr("id");
                validation = false;
            }

        }
    });



    jQuery('#' + id + ' .latValidation').each(function () {
        if ($(this).val() == "") {
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }
        else {
            var value = $(this).val();
            var plusposition = value.indexOf("+")
            var dotposition = value.lastIndexOf(".")
            if (plusposition > 0) {
                Elecnt = Elecnt + 1
                //alert($(this).attr('style'))
                $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
                //$(this).css('background', '#fde6e1')
                //$(this).addClass('errorTxt');
                $(this).val("");
                $(this).attr('placeholder', 'Invalid Format');
                // $(this).attr('style','Display:Block;');
                //$(this).addClass('error');
                if (Elecnt == 1)
                    focusID = $(this).attr("id");
                validation = false;
            }
            else if (value < -90 || value > 90) {
                Elecnt = Elecnt + 1
                //alert($(this).attr('style'))
                $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
                //$(this).css('background', '#fde6e1')
                //$(this).addClass('errorTxt');
                $(this).val("");
                $(this).attr('placeholder', 'Invalid Format');
                // $(this).attr('style','Display:Block;');
                //$(this).addClass('error');
                if (Elecnt == 1)
                    focusID = $(this).attr("id");
                validation = false;
            }



        }
    });

    jQuery('#' + id + ' .lngValidation').each(function () {
        if ($(this).val() == "") {
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }
        else {
            var value = $(this).val();
            var plusposition = value.indexOf("+")
            var dotposition = value.lastIndexOf(".")
            if (plusposition > 0) {
                Elecnt = Elecnt + 1
                //alert($(this).attr('style'))
                $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
                //$(this).css('background', '#fde6e1')
                //$(this).addClass('errorTxt');
                $(this).val("");
                $(this).attr('placeholder', 'Invalid Format');
                // $(this).attr('style','Display:Block;');
                //$(this).addClass('error');
                if (Elecnt == 1)
                    focusID = $(this).attr("id");
                validation = false;
            }

            else if (value < -180 || value > 180) {
                Elecnt = Elecnt + 1
                //alert($(this).attr('style'))
                $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
                //$(this).css('background', '#fde6e1')
                //$(this).addClass('errorTxt');
                $(this).val("");
                $(this).attr('placeholder', 'Invalid Format');
                // $(this).attr('style','Display:Block;');
                //$(this).addClass('error');
                if (Elecnt == 1)
                    focusID = $(this).attr("id");
                validation = false;
            }


        }
    });

    if (!validation) {
        $("#" + focusID).focus();
        //alert(focusID);
        return false;
    }
    $('#' + id + ' .mobile').each(function () {
        $(this).removeClass('error');
        $(this).attr('style', '');
        if ($(this).val() != "") {
            if ($(this).val().length != 10) {
                $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
                $(this).val("");
                $(this).attr('placeholder', 'Invalid Mobile No! ');
                //$(this).addClass('error');
                mobileValidation = false;
                //alert("Invalid MobileNo!");
                //return false;
            }
        }
    });

    $('#' + id + ' .email').each(function () {
        $(this).removeClass('error');
        $(this).attr('style', '');
        if ($(this).val() != "") {
            if (!echeck($(this).val())) {
                $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
                $(this).val("");
                $(this).attr('placeholder', 'Invalid E-mail ID!');
                //$(this).addClass('error');
                EmailValidation = false;
                //alert("Invalid MailID!");
                //return false;
            }
        }
    });
    if (!EmailValidation) {
        //alert("Invalid MailID!");
        return false;
    }
    if (!mobileValidation) {
        //alert("Invalid MobileNo!");
        return false;
    }
    // return true;

    if (msg == "msgno") {
        showProgress()
    }
    else {
        var a = confirm("Are you sure want to " + msg + "?")
        if (a) {
            showProgress()
            return true;
        }
        else {

            return false;
        }
    }

}





function dovalidate1(id, msg) {

    var validation = true;
    var mobileValidation = true;
    var EmailValidation = true;
    var focusID = ""
    var Elecnt = 0
    jQuery('#' + id + ' .required').each(function () {
        //$(this).removeClass('error');
        //$(this).attr('style', '');
        if ($(this).val() == "") {
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("Title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }
        if ($('option:selected', $(this)).text() == "Select Pay Type") {
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }


        if ($(this).val() == "Select Card Type") {
            businessType = 1
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }
        //here
    });

    $('#' + id + ' .mobile').each(function () {
        $(this).removeClass('error');
        $(this).attr('style', '');
        if ($(this).val() != "") {
            if ($(this).val().length != 10) {
                $(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
                $(this).val("");
                $(this).attr('placeholder', 'Invalid Mobile No! ');
                //$(this).addClass('error');
                if (Elecnt == 1)
                    focusID = $(this).attr("id");
                mobileValidation = false;
                //alert("Invalid MobileNo!");
                //return false;
            }
        }
    });




    if (!validation) {
        $("#" + focusID).focus();
        //alert(focusID);
        return false;
    }
}

//Email Validation
function echeck(str) {
    var at = "@"
    var dot = "."
    var lat = str.indexOf(at)
    var lstr = str.length
    var ldot = str.indexOf(dot)
    if (str.indexOf(at) == -1) {
        //alert("Invalid E-mail ID")
        return false
    }

    if (str.indexOf(at) == -1 || str.indexOf(at) == 0 || str.indexOf(at) == lstr) {
        //alert("Invalid E-mail ID")
        return false
    }

    if (str.indexOf(dot) == -1 || str.indexOf(dot) == 0 || str.indexOf(dot) == lstr) {
        //alert("Invalid E-mail ID")
        return false
    }

    if (str.indexOf(at, (lat + 1)) != -1) {
        //alert("Invalid E-mail ID")
        return false
    }

    if (str.substring(lat - 1, lat) == dot || str.substring(lat + 1, lat + 2) == dot) {
        //alert("Invalid E-mail ID")
        return false
    }

    if (str.indexOf(dot, (lat + 2)) == -1) {
        //alert("Invalid E-mail ID")
        return false
    }

    if (str.indexOf(" ") != -1) {
        //alert("Invalid E-mail ID")
        return false
    }

    return true
}

/*Numeric Validation*/
function AllowAlphabet(evt) { return filterInputCommonForAllValidation(0, evt, ''); }

function AllowNumericAndAlphabet(evt) { return filterInputCommonForAllValidation(2, evt, ''); }

function AllowNumeric(evt) { return filterInputCommonForAllValidation(1, evt, ''); }

function AllowNumericWithoutDecimal(evt) { return filterInputCommonForAllValidation(4, evt, ''); }

function AllowNumericWithDecimal(evt) { return filterInputCommonForAllValidation(3, evt, ''); }

function AllowAlphaNumericSplchar(evt) { return filterInputCommonForAllValidation(5, evt, ''); }

function AllowCustomFormat(evt, custom) { return filterInputCommonForAllValidation(6, evt, custom); }

/*Common For All*/
function filterInputCommonForAllValidation(filterType, evt, customfrm) {
    var keyCode, Char, inputField, filter = '';
    var alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ. ';
    var num = '0123456789.';
    var number = '0123456789';
    var splchr = '/';
    var splchr = '@_~$&*#/-';
	
    if (window.event) {
        keyCode = window.event.keyCode;
        evt = window.event;
    }
    else if (evt) keyCode = evt.which;
    else return true;

    if (filterType == 0) filter = alpha;
    else if (filterType == 1) filter = num;
    else if (filterType == 2) filter = alpha + num;
    else if (filterType == 3) filter = num;
    else if (filterType == 4) filter = number;
    else if (filterType == 5) filter = alpha + num + splchr;
    else if (filterType == 6) filter = customfrm;

    if (filter == '') return true;

    inputField = evt.srcElement ? evt.srcElement : evt.target || evt.currentTarget;
    if ((keyCode == null) || (keyCode == 0) || (keyCode == 8) || (keyCode == 9) || (keyCode == 13) || (keyCode == 27)) return true;
    Char = String.fromCharCode(keyCode);
    if ((filter.indexOf(Char) > -1)) return true;
    else return false;
}

// Custom Dropdown


function SessionRefill() {
    var dataobj = "{'AgInfo':'" + ($('#AgInf').val() != undefined ? $('#AgInf').val() : '') + "'}"
    $.ajax({
        url: "Default.aspx/SessionRefill",
        type: "POST",
        datatype: "json",
        data: dataobj,
        contentType: "application/json; charset=utf-8",
        success: function (msg) {
        }
    });
}

function CreateDatatableOptions(tableId, havingcount) {
    //alert('hai');
    var header = "<thead>" + $('#' + tableId + ' tbody').find("tr").eq(0).html() + "</thead>";
    var counthtml = "";
    if (havingcount == "1") {
        var trlength = $('#' + tableId + ' tbody').find("tr").length;
        counthtml = "<tfoot>" + $('#' + tableId + ' tbody').find("tr").eq(trlength - 1).html() + "</tfoot>";
        $('#' + tableId + ' tbody').find("tr").eq(trlength - 1).remove();
    }
    var htmlstr = header + $('#' + tableId).html();
    htmlstr += counthtml;
    //alert(htmlstr);
    $('#' + tableId).html(htmlstr);
    $('#' + tableId + ' tbody').find("tr").eq(0).remove();
    $('#' + tableId).dataTable({
        "aLengthMenu": [
             [-1],
             ["All"]
        ], "iDisplayLength": "-1"
    });
}

function clearErr(id, uploaddivid) {

    var x = id;
    var reqbool = $('#' + id).hasClass("required");
    var reqmailbool = $('#' + id).hasClass("email");
    var reqmobBool = $('#' + id).hasClass("mobile");
    var requploadBool = $('#' + id).hasClass("upload");

    var booltxt = $('#' + id).is('input', 'input')
    var booltxtarea = $('#' + id).is('textarea', 'textarea')
    var boolddl = $('#' + id).is('select', 'select')
    var title = $('#' + id).attr("title");


    if (booltxt == true || booltxtarea == true) {
        if (reqbool == true) {
            if (($('#' + id).val() != "")) {
                //if ($('#' + id).css('text-transform') != "uppercase") {
                    $('#' + id).removeAttr('style');
                //}
            }
            else {
                $('#' + id).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
                $('#' + id).val("");
                $(this).attr('placeholder', 'Enter ' + $('#' + id).attr("title"));
            }
            if (title == "DOB") {
                if (($('#' + id).val() != "")) {
                    //if ($('#' + id).css('text-transform') != "uppercase") {
                        $('#' + id).removeAttr('style');
                    //}
                }
                else {
                    $('#' + id).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
                    $('#' + id).val("");
                    $(this).attr('placeholder', 'Enter ' + $('#' + id).attr("title"));
                }
            }


        }
        if (reqmailbool == true) {
            if ($('#' + id).val() != "") {
                if (!echeck($('#' + id).val())) {
                    $('#' + id).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
                    $('#' + id).val("");
                    $('#' + id).attr('placeholder', $('#' + id).attr("title"));
                }
                else {
                    //if ($('#' + id).css('text-transform') != "uppercase") {
                        $('#' + id).removeAttr('style');
                    //}
                }
            }
        }
        if (reqmobBool == true) {
            if ($('#' + id).val() != "") {
                if ($('#' + id).val().length != 10) {
                    $('#' + id).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
                    $('#' + id).val("");
                    $('#' + id).attr('placeholder', $('#' + id).attr("title"));
                }
                else {
                    //if ($('#' + id).css('text-transform') != "uppercase") {
                        $('#' + id).removeAttr('style');
                    //}
                }
            }
        }
    }

    if (boolddl == true) {
        if (reqbool == true) {
            if ($('#' + id).val() != "") {
                //if ($('#' + id).css('text-transform') != "uppercase") {
                    $('#' + id).removeAttr('style');
                //}
            }
            else {
                $('#' + id).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
                $('#' + id).val("");
                $(this).attr('placeholder', 'Enter ' + $('#' + id).attr("title"));
            }
        }
    }
    if (requploadBool == true) {
        var x = document.getElementById(id);
        for (var i = 0; i < x.files.length; i++) {
            var file = x.files[i];
            if ('name' in file) {
            }
            if ('size' in file) {
            }
            if (file.size < 263751) {
                $('#' + id).removeAttr('style');
                var div = document.getElementById(uploaddivid);
                div.innerHTML = 'File size must be less than 250 kb';
                div.style.color = "Blue";
                return true;
            }
            else {
                $('#' + id).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
                $('#' + id).val("");
                $('#' + id).attr('placeholder', 'Enter ' + $('#' + id).attr("title"));
                var div = document.getElementById(uploaddivid);
                div.innerHTML = 'Choose File size must be less than 250 kb';
                div.style.color = "Red";
                return false;
            }
        }
    }
}

// Sql injection
function sqlinjection(inputTxtID) {
    var ID = inputTxtID.id;
    var strVal = new String(inputTxtID.value.toLowerCase());
    if (inputTxtID.Value != "") {
        var SQLWords = ["<div ", "update ", "insert ", "truncate ", " truncate", "delete ", " delete",  "select*",  "select ", "drop ", "declare ", "www.", " href=", "http:", "https:", "cheat ", "table ", " <div ", " update ", " insert ", " select ", " drop ", " declare ", " www.", " http:", " https:", " cheat ", " table ", "update", "insert", "select", "delete", "https:", "truncate", "drop",  "create", "www", "database", "pubs", "master", "table"];
        for (var i = 0; i < SQLWords.length; i++) {
            var index = strVal.indexOf(SQLWords[i]);
            if (index != "-1") {
                alert("Invalid input string");
                inputTxtID.value = "";
                setTimeout('document.getElementById(\'' + ID + '\').focus();document.getElementById(\'' + ID + '\').select();', 0);
                break;
            }
        }
    }
}

//Encryption 10-17-2016

function EncryptStringkey(Paswrd, key) {

    var newPaswrd = "";
    var MAxNp = Math.max(key.length, Paswrd.length); /*Here key will be taken from session*/
    for (var i = 0; i < MAxNp; i++) {
        if (key[i] != undefined && Paswrd[i] != undefined) {
            newPaswrd = newPaswrd + key[i] + Paswrd[i];
        }
        if (key[i] == undefined)
            newPaswrd = newPaswrd + Paswrd[i];
        else if (Paswrd[i] == undefined)
            newPaswrd = newPaswrd + key[i];
    }
    newPaswrd = Paswrd.length.toString() + "|" + newPaswrd;
    return newPaswrd;


}
function getRandomInt() {
    var key = Math.floor(Math.random() * (1000 - 9999 + 1) + 9999);
    return key = "" + key + key;
}

function onlyNumber(str) {
    str = str.toString();
    return str.replace(/\D/g, '');
}
function doValidateWithStyle(id, msg) {
    var validation = true;
    var mobileValidation = true;
    var EmailValidation = true;
    var focusID = ""
    var Elecnt = 0
    var thisWidth = "";
    jQuery('#' + id + ' .required').each(function () {
        //$(this).removeClass('error');
        //$(this).attr('style', '');
        thisWidth = $(this).outerWidth();
        if ($(this).val() == "") {
            Elecnt = Elecnt + 1
            //alert($(this).attr('style'))
            //$(this).attr('style', 'background:#fde6e1;border:solid 1px #ff6666;');
            $(this).attr('style', 'width:' + thisWidth + "px" + ';background:#fde6e1;border:solid 1px #ff6666;');
            //$(this).css('background', '#fde6e1')
            //$(this).addClass('errorTxt');
            $(this).attr('placeholder', 'Enter ' + $(this).attr("Title"));
            // $(this).attr('style','Display:Block;');
            //$(this).addClass('error');
            if (Elecnt == 1)
                focusID = $(this).attr("id");
            validation = false;
            //alert('Please fill Require Fields!');
        }
    });
    if (!validation) {
        $("#" + focusID).focus();
        //alert(focusID);
        return false;
    }
    if (msg == "msgno") {
        showProgress()
    }
    else {
        var a = confirm("Are you sure want to " + msg + "?")
        if (a) {
            showProgress()
            return true;
        }
        else {

            return false;
        }
    }
}
