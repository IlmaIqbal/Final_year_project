document.addEventListener("DOMContentLoaded", function () {
    const sidebarToggle = document.querySelector("#sidebar-toggle");
    if (sidebarToggle) {
        sidebarToggle.addEventListener("click", function () {
            document.querySelector("#sidebar").classList.toggle("collapsed");
        });
    }

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
        });
    });
});
