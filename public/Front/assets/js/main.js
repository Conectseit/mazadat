/* var d = new Date();
var localTime = d.getTime();
var localOffset = d.getTimezoneOffset() * 60000;
var utc = localTime + localOffset;
var offset = 4; //UTC of Dubai is +04.00
var dubai = utc + 3600000 * offset;
var nd = new Date(dubai);
alert("Dubai time is " + nd.toLocaleString() + "<br>"); */

$(function () {
  setTimeout(() => {
    $(".splash").css({ opacity: "0", "z-index": "-10" });
  }, 5500);
});

$(document).ready(function () {
  let signFrm = document.querySelector("#signInForm"),
    frmHeight = signFrm.clientHeight,
    navbar = document.querySelector("#navbar"),
    signbtn = document.querySelector("#signInBtn");

  signbtn.onclick = function (e) {
    e.preventDefault();
    signFrm.classList.toggle("active");
    if (signFrm.classList.contains("active")) {
      signFrm.style.cssText = `top: 0;`;
      navbar.style.marginTop = frmHeight + "px";
    } else {
      signFrm.style.cssText = "top: -100%;";
      navbar.style.cssText = `margin-top: 0;`;
    }
  };
});

$(function () {
  $("#bid").click(function (e) {
    e.preventDefault();
    $("#mainInfo").css({ display: "none" });
    $("#bid").css("cssText", "display: none !important");
    $("#bidMainInfo").css("cssText", "display: flex !important");
    $("#bidDetails").css("cssText", "display: unset");
    $("#details").css("cssText", "display: none");
    $("#description").css("cssText", "display: none");
  });
});

$(document).ready(function () {
  $(".categories-bar-carousel").owlCarousel({
    margin: 10,
    rtl: true,
    dots: false,
    nav: false,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 3,
      },
      1000: {
        items: 5,
      },
    },
  });
});

$(document).ready(function () {
  $("#searchBtn").click(function () {
    $("#searchForm").slideToggle();
    $("#filterForm").slideUp();
    $("#controlMenuForm").slideUp();

  });
});

$(document).ready(function () {
  $("#filterBtn").click(function () {
      $("#searchForm").slideUp();
      $("#filterForm").slideToggle();
      $("#controlMenuForm").slideUp();
  });
});

$(document).ready(function () {
  $("#controlMenuBtn").click(function () {
      $("#searchForm").slideUp();
      $("#filterForm").slideUp();
      $("#controlMenuForm").slideToggle();
  });
});

let viewBtn = document.querySelector("#viewBtn"),
  viewBtnIcon = document.querySelector("#viewBtn i"),
  card = document.querySelectorAll("#itemCard"),
  viewItem = document.querySelectorAll("#viewItem");

$("#viewBtn").click(function () {
  for (var i = 0; i < viewItem.length; i++) {
    var inClass = viewItem[i].classList;
    var cardClass = viewItem[i].children[0].classList;
    if (inClass.contains("col-lg-4")) {
      inClass.remove("col-lg-4", "col-md-6");
      inClass.add("col-12");
      viewBtnIcon.classList.remove("fa-th");
      viewBtnIcon.classList.add("fa-th-list");
      cardClass.remove("gallery-card");
      cardClass.add("list-card");
    } else if (inClass.contains("col-12")) {
      inClass.remove("col-12");
      inClass.add("col-lg-4", "col-md-6");
      viewBtnIcon.classList.remove("fa-th-list");
      viewBtnIcon.classList.add("fa-th");
      cardClass.remove("list-card");
      cardClass.add("gallery-card");
    }
  }
});

$(function () {
  $("#minus").click(function () {
    var $input = $(this).parent().find("#bidInput");
    var count = parseInt($input.val()) - 100;
    count = count < 0 ? 0 : count;
    $input.val(count);
    $input.change();
    return false;
  });
  $("#plus").click(function () {
    var $input = $(this).parent().find("#bidInput");
    $input.val(parseInt($input.val()) + 100);
    $input.change();
    return false;
  });
});

$(function () {
  var imagesPreview = function (input, placeToInsertImagePreview) {
    if (input.files) {
      var filesAmount = input.files.length;
      for (i = 0; i < filesAmount; i++) {
        var reader = new FileReader();

        reader.onload = function (event) {
          $(".my-img").remove();
          $(
            $.parseHTML(
              `<img src= ${event.target.result} class="my-img"></img>`
            )
          ).appendTo(placeToInsertImagePreview);
        };

        reader.readAsDataURL(input.files[i]);
      }
    }
  };
  var input = document.querySelector("#myImgUploader");
  var div = document.querySelector("#myImg");
  $(input).on("change", function () {
    imagesPreview(this, div);
  });
});

$(function () {
  $("#datepicker").datepicker({});
});
