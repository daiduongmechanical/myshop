const handleOverview = (x) => {
  let type = document.querySelector(".custom-select").value;
  let value = "";

  if (type === "date") {
    $(".sort-byDate").show();
    $(".sort-byMonth, .sort-byYear").hide();
    value = document.querySelector("#dateSort").value;
  }
  if (type === "month") {
    $(".sort-byMonth").show();
    $(".sort-byDate, .sort-byYear").hide();
    value = document.querySelector("#monthSort").value;
  }
  if (type === "year") {
    $(".sort-byYear").show();
    $(".sort-byDate, .sort-byMonth").hide();
    value = document.querySelector("#yearSort").value;
  }

  let url = `/overview/sortBy?type=${type}&value=${value}&orderBy=${x}`;

  $.ajax({
    url: url,
    type: "GET",
    success: function (response) {
      console.log(response);
      $("#totalCost").html(response[0][0]);
      $("#totalView").html(response[0][1]);
      $("#totalOrder").html(response[0][2]);

      var rows =
        "<thead class='thead-dark'><tr><th>Image</th><th>DishID</th><th>Name</th><th>Total orders</th><th>Total cost</th></tr></thead><tbody>";
      if (response.length > 0) {
        $.each(response[1], function (index, dish) {
          rows += "<tr>";
          rows += `<td>  <img width="50px" src="${dish.info.dishimages[0].imageurl}" alt="">  </td>`;
          rows += "<td>" + dish.info.dishid + "</td>";
          rows += "<td>" + dish.info.dishname + "</td>";
          rows += "<td>" + dish.totalorder + "</td>";
          rows += "<td>" + parseFloat(dish.totalcost).toFixed(2) + "</td>";
          rows += "</tr>";
        });
      } else {
        rows += '<tr><td colspan="6">No results found.</td></tr>';
      }
      $("#search-results").html(rows);
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    },
  });
};

//search over view
$(function () {
  let orderBy = "totalcost";
  $(".sort-byMonth, .sort-byYear").hide();
  //select top

  $("#revenue_button").on("click", function () {
    orderBy = "totalcost";
    handleOverview(orderBy);
  });

  $("#order_button").on("click", function () {
    orderBy = "totalorder";
    handleOverview(orderBy);
  });

  $(".sort-by").on("change", () => handleOverview(orderBy));
});
