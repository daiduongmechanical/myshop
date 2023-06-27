//js check box

const selectAllNone = document.querySelector("#select-all-none");
const checkboxes = document.querySelectorAll("input[type=checkbox]");

// sent databutton open modal delete
$(".btn_delete_discount").on("click", function (event) {
  console.log(1);
  let data = $(this).attr("data");
  $(".action-delete-discount").attr("href", `/discount/delete/${data}`);
  $(".notify__modal--oldDish").html(
    "Are your sure" + "<b> deleted </b>" + "alsway this dish ?"
  );
});

selectAllNone.addEventListener("change", function () {
  if (this.value === "all") {
    checkboxes.forEach(function (checkbox) {
      checkbox.checked = true;
    });
  } else if (this.value === "") {
    checkboxes.forEach(function (checkbox) {
      checkbox.checked = false;
    });
  } else {
    checkboxes.forEach(function (checkbox) {
      if (checkbox.getAttribute("sort") === selectAllNone.value) {
        checkbox.checked = true;
      } else {
        checkbox.checked = false;
      }
    });
  }
});

checkboxes.forEach((e) => {
  e.addEventListener("change", () => {
    let check = 0;
    checkboxes.forEach((item) => {
      if (item.checked === true) {
        check++;
      }
    });

    if (check === 0) {
      $("#select-all-none").val("");
    } else {
      $("#select-all-none").val("specific");
    }
    console.log($("#select-all-none").val());
  });
});

//set min for discount
let today = new Date().toISOString().split("T")[0];
$("#start__sale--create").attr("min", today);

$("#start__sale--create").on("change", () => {
  startday = $("#start__sale--create").val();
  $("#end__sale--create").attr("min", startday);
});

// start_sale_date

$("#start__sale--update").attr("min", today);

$("#start__sale--update").on("change", () => {
  startday = $("#start__sale--update").val();
  $("#end__sale--update").attr("min", startday);
});

$(".new__dish--type").on("change", () => {
  $(".new__dish--option").attr("value", $(".new__dish--type"));
});
