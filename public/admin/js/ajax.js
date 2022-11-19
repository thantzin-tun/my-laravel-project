
$(document).ready(function () {

    let totalAmount = document.querySelector("#totalPrice");
    let fee = document.querySelector(".fee");
    //This is accending and descedning fucntion
    $count = 0;

    function innovoice(){
        $(".styled-table tr").each(function (index, row) {
            totalAmount += Number(
                $(row).find(".cartTotal").text()
            );
            console.log($(row).find(".cardTotal").text());
        });


        $("#totalPrice").html(`${totalAmount}`);
        
        $("#totalCost").html(
            `${parseInt(totalAmount) + parseInt(fee.innerHTML)} kyats`
        );
    }

    //Sorting Asc or Desc
    $("#selectOperations").change(function () {
        $.ajax({
            type: "get",
            data: {
                status: $(this).val(),
            },
            url: "/user/pizzaList",
            dataType: "json",
            success: function (response) {
                $list = "";
                for ($i = 0; $i < response.length; $i++) {
                    $list += `
                    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card neo p-2">
          <div class="all">
            <div class="image-part">
              <img src="http://localhost:8000/storage/${response[$i].image}" class="img-fluid productPhoto" alt="pizza photo" />
              <div class="infopart">
                <h1 class="text-light fw-bold mx-2">${response[$i].name}</h1>
                <p class="text-light fw-bold mx-2 my-2">${response[$i].description}</p>
                <h3 class="text-light fw-bold mx-2">${response[$i].price}</h3>
                <div class="d-flex">
                  <div class="time bg-danger">
                    <box-icon name='timer' color="white" size="md" class="bx-tada"></box-icon>
                    <h5 class="ml-2 text-white">${response[$i].waiting}mins</h5>
                  </div>
                </div>
              </div>
            </div>

            <div class="position-relative addToCart">
              <button class="btn btn-dark mt-2 w-100">Add To Cart</button>
              <button class="btn btn-danger mt-2 w-100 bu">
                <box-icon name='cart' size="48" color="white"></box-icon>
              </button>
            </div>

          </div>
        </div>
                    </div>`;
                }
                $("#pizzaList").html($list);
            },
        });
    });

    //Add to Card and Check
    $(".bu").each(function () {
        $(this)
            .unbind()
            .click(function () {
                $cartDetail = {
                    userID: $("#userID").val(),
                    pizzaID: $(this).attr("pizzaID"),
                    quantity: 1,
                };
                // console.log($cartDetail);
                $.ajax({
                    type: "get",
                    data: $cartDetail,
                    url: "/user/addToCart",
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                    },
                });
            });
    });


    //Increase or Decrease Quantity
    $(".operation").each(function () {
        $(this)
            .unbind()
            .click(function () {
                
                // let totalAmount = document.querySelector(".totalPrice");
                // let fee = document.querySelector(".fee");

                $parentNode = $(this).parents("tr");

                // Quantity
                $qty = parseInt($parentNode.find(".quantity").html());

                $count = $qty;

                // Price
                $price = Number($parentNode.find(".p").html());

                $total = $parentNode.find(".cartTotal");

                if ($(this).attr("status") == "increase") {
                    $count++;

                    $parentNode.find(".quantity").html($count);

                    $total.html($count * $price);

                    totalAmount = 0;

                    innovoice();
                    
                } else {
                    if ($qty == 0) {
                        return;
                    } else {
                        $count--;
                        $parentNode.find(".quantity").html($count);
                    }

                    $total.html($count * $price);

                    totalAmount = 0;

                    innovoice();
                }

            });
    });




});

