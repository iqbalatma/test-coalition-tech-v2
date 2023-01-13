$(document).ready(function () {
    console.log("INIT");

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("form").on("submit", function (e) {
        e.preventDefault();
        const data = {
            name: $("#name").val(),
            quantity: $("#quantity").val(),
            price: $("#price").val(),
        };

        $.ajax({
            url: "/ajax/products",
            method: "POST",
            data: data,
        })
            .done(function (response, status) {
                console.log(response);
                $("#table-product tbody").append(`
                <tr>
                <td>${response.data.name}</td>
                <td>${response.data.quantity}</td>
                <td>${response.data.price}</td>
                <td>${response.data.date_time}</td>
                <td>${
                    parseInt(response.data.price) *
                    parseInt(response.data.quantity)
                }</td>
                </tr>
                `);

                let newValueNumber =
                    parseInt($("#value-number").text()) +
                    parseInt(response.data.price) *
                        parseInt(response.data.quantity);

                $("#value-number").text(newValueNumber);

                if (status == "success") {
                    return Swal.fire(
                        "Good job!",
                        "Add new data successfully!",
                        "success"
                    );
                }
            })
            .fail(function (response) {
                console.log(response);
            })
            .always();
    });
});
