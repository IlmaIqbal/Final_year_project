$(document).ready(function () {
    // Fetch permissions
    $.ajax({
        url: "/getAllPermission",
        method: "GET",
        success: function (response) {
            var permissions = response.permissions;
            var permissionsHTML = "";
            permissions.forEach(function (permission) {
                permissionsHTML += `
                    <div class="form-check">
                        <input type="checkbox" name="permissions[]" value="${permission.name}" class="form-check-input">
                        <label class="form-check-label">${permission.name}</label>
                    </div>
                `;
            });
            $("#permissions").html(permissionsHTML);
        },
        error: function () {
            swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
            });
        },
    });

    // Form submission
    $("#roleForm").submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: "/postRole",
            method: "POST",
            data: formData,
            beforeSend: function () {
                $("#createRoleBtn")
                    .attr("disabled", true)
                    .html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating Role'
                    );
            },
            success: function () {
                swal.fire({
                    icon: "success",
                    title: "Role Created",
                    text: "Your Role has been created",
                });
                window.location = "/role";
            },
            error: function () {
                swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                });
                $("#createRoleBtn")
                    .attr("disabled", false)
                    .html('<i class="fas fa-save"></i> Save Role');
            },
        });
    });

    // Enable/disable submit button based on form validation
    $("#roleName").keyup(function () {
        var roleName = $(this).val();
        if (roleName.trim() !== "") {
            $("#createRoleBtn").attr("disabled", false);
            $("#nameError").text("");
        } else {
            $("#createRoleBtn").attr("disabled", true);
            $("#nameError").text("Role Name is required");
        }
    });

    // Save role button click handler
    $("#saveRoleBtn").click(function () {
        $("#roleForm").submit();
    });
});
