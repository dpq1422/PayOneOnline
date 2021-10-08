var togglevalue;
var collapsepanell = 0;
var ddljpaytype = 1;
var showhide = 0;
function ToggleSwitchFunction(value) {


    if (value == 1) {
        togglevalue = 1;
    }
    else if (value == 2) {
        togglevalue = 2;
    }
}
function ddltp(value) {
    ddljpaytype = value;
}
function collapsepanel(value) {
    collapsepanell = value;
}
function sss() {
    var INDEX = $(this).parent().children().index($(this));
    $('#grdkycverify tr:nth-child(' + INDEX + ')').addClass("highlight")
                        .siblings()
                        .removeClass("highlight");
}

function myFunction() {
    //some code here
    $("#tbladdblock").show();
    $("#tblgrdreport").hide();
}


function ShowCurrentTime() {
    $.ajax({
        type: "POST",
        url: "pgUserCreation.aspx/GetCurrentTime",
        data: '{name: "1" }',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: OnSuccess,
        failure: function (response) {
            alert(response.d);
        }
    });
}
function OnSuccess(response) {
    $("#tbladdblock1").show();
    $("#tblgrdreport1").hide();

    $('[id*=txtemailid]').val(response.d.EmailId);
    $('[id*=txtusername]').val(response.d.UserName);
    $('[id*=txtmobilenumber]').val(response.d.MobileNumber);
    $('[id*=txtcity]').val(response.d.City);
    $('[id*=txtaddress]').val(response.d.Address);
    $('[id*=txtemployeenumber]').val(response.d.EmployeeNumber);
    $('[id*=UserType]').val(response.d.UserType);



    (function () {
        var $confirm;

        $confirm = null;

        $(function () {
            var $createDestroy, $window, sectionTop;
            $window = $(window);
            sectionTop = $(".top").outerHeight() + 20;
            $createDestroy = $("#switch-create-destroy");
            hljs.initHighlightingOnLoad();
            $("a[href*=\"#\"]").on("click", function (event) {
                var $target;
                event.preventDefault();
                $target = $($(this).attr("href").slice("#"));
                if ($target.length) {
                    return $window.scrollTop($target.offset().top - sectionTop);
                }
            });

            //this case is only set the bootstrap toggle button when "id" set
            $("[id='switch-state']").bootstrapSwitch();
            //this case is set for all checkbox and radio
            //$("input[type=\"checkbox\"],  input[type=\"radio\"]").not("[data-switch-no-init]").bootstrapSwitch();

            $("[data-switch-set]").on("click", function () {
                var type;
                type = $(this).data("switch-set");
                return $("#switch-" + type).bootstrapSwitch(type, $(this).data("switch-value"));
            });
            var type = "state"
            return $("#switch-" + type).bootstrapSwitch(type, false);
            return $confirm = $("#confirm").bootstrapSwitch({
                size: "large",
                onSwitchChange: function (event, state) {
                    event.preventDefault();
                    return console.log(state, event.isDefaultPrevented());
                }
            });
        });

    }).call(this);

}


function GetSelectedRow(lnk) {
    var row = lnk.parentNode.parentNode;
    var rowIndex = row.rowIndex - 1;
    var customerId = row.cells[0].innerHTML;


    // Initialize the object, before adding data to it.
    var NewPerson = new Object();

    NewPerson.EmailId = row.cells[1].innerHTML;
    NewPerson.UserName = row.cells[2].innerHTML;
    NewPerson.MobileNumber = row.cells[3].innerHTML;
    NewPerson.City = row.cells[4].innerHTML;
    NewPerson.Address = row.cells[5].innerHTML;
    NewPerson.EmployeeNumber = row.cells[6].innerHTML;
    NewPerson.UserType = row.cells[7].innerHTML;


    var merchantdetails = {};
    merchantdetails.EmailId = row.cells[1].innerHTML;
    merchantdetails.UserName = row.cells[2].innerHTML;
    merchantdetails.MobileNumber = row.cells[3].innerHTML;
    merchantdetails.City = row.cells[4].innerHTML;
    merchantdetails.Address = row.cells[5].innerHTML;
    merchantdetails.EmployeeNumber = row.cells[6].innerHTML;
    merchantdetails.UserType = row.cells[7].innerHTML;



    var dd = row.cells[1].innerHTML + ',' + row.cells[2].innerHTML + ',' + row.cells[3].innerHTML + ',' + row.cells[4].innerHTML + ',' + row.cells[5].innerHTML + ',' + row.cells[6].innerHTML + ',' + row.cells[7].innerHTML;
    var naa = "1,1";
    var naa = JSON.stringify(NewPerson);
    $.ajax({
        type: "POST",
        url: "pgUserCreation.aspx/GetCurrentTime",

        data: "{merchant:" + JSON.stringify(merchantdetails) + "}",
        //        data: "{'name':" + naa  + "}",
        //        data: '{name:' + NewPerson + '}',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: OnSuccess,
        failure: function (response) {
            alert(response.d);
        }
    });
    //    var city = row.cells[1].getElementsByTagName("input")[0].value;
    //    alert("RowIndex: " + rowIndex + " CustomerId: " + customerId + " City:" + city);
    //    return false;
}
//for date picker
var FromEndDate = new Date();
var SelectedFromDate = ""
var SetEndDate = new Date();


//var d = new Date();
//d.setDate(d.getDate() - 1);
$(document).ready(function () {

    //this method is only display the month and year picker
    //    $('.input-group.date').datepicker({
    //        format: "mm/yyyy", startView: "months", minViewMode: "months", autoclose: true, orientation: "top auto", todayHighlight: true, endDate: SetEndDate
    //    }).on('changeDate', function (ev) {
    //        SelectedFromDate = ev.date;

    //    });


    $('.input-group.date').datepicker({
        format: "dd/M/yyyy", autoclose: true, orientation: "top auto", todayHighlight: true, endDate: SetEndDate
    }).on('changeDate', function (ev) {
        SelectedFromDate = ev.date;

    });

});




var gJsondata = "";

function jsondata(value) {
    gJsondata = value;
}
function updatepanelshow(ss, merchantname) {
    //alert(ss);
    if (ss == "Select State" && merchantname == "") {
        $("#tbladdblock").hide();
        $("#tblgrdreport").show();
    }
    else {
        $("#tbladdblock").show();
        $("#tblgrdreport").hide();
    }

    //$("#widject").show();
};