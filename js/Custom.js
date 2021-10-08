var disptype;
function DisplayType(value) {
    disptype = value;
}
$('.nav li').click(function () {
    $('.nav li').removeClass('active');
    $(this).addClass('active');
})

$(function () {
    $(".preload").fadeOut(1000, function () {
        $(".loadcontent").fadeIn(1000);
    });
});
function formatAmount(number) {

    var decimalSeparator = ".";
    var thousandSeparator = ",";

    // make sure we have a string
    var result = String(number);

    // split the number in the integer and decimals, if any
    var parts = result.split(decimalSeparator);

    // if we don't have decimals, add .00
    if (!parts[1]) {
        parts[1] = "00";
    }

    // reverse the string (1719 becomes 9171)
    result = parts[0].split("").reverse().join("");

    // add thousand separator each 3 characters, except at the end of the string
    result = result.replace(/(\d{3}(?!$))/g, "$1" + thousandSeparator);

    // reverse back the integer and replace the original integer
    parts[0] = result.split("").reverse().join("");

    // recombine integer with decimals
    return parts.join(decimalSeparator);
}