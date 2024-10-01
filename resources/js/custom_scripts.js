$(document).ready(function () {
    $("#custId").click(function () {
        let textName = $(this).text();
        $("#dashText").html(textName);
        $("#loadViews").load("customers/addNew");
    });
});
