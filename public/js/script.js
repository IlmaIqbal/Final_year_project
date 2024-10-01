const sidebarToggle = document.querySelector("#sidebar-toggle");
sidebarToggle.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

$(document).ready(function () {
    $("#search").on("keyup", function () {
        var query = $(this).val();
        $.ajax({
            url: "search",
            type: "GET",
            data: { search: query },
            success: function (data) {
                $("#search_list").html(data);
            },
        });
        //end of ajax call
    });
});

document.querySelectorAll(".nav-item").forEach((item) => {
    item.addEventListener("click", function () {
        document.querySelector(".nav-item.active").classList.remove("active");
        this.classList.add("active");
    });
});
