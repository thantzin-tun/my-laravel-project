$(document).ready(function(){

  $(".orderBtn").click(function(){
    let userRow = document.querySelectorAll(".styled-table tbody tr");

    $orderList = [];

    $random = Math.floor(Math.random() * 10000001);

    for(let i=0;i<userRow.length;i++){
        $orderList.push({
            productID: $(userRow[i]).find(".productID").val(),
            quantity: $(userRow[i]).find(".quantity").html() * 1,
            total: $(userRow[i]).find(".cartTotal").text() * 1,
            order_code: "OrderCode" + $random
        });
    }

    $.ajax({
        type: "get",
        url: "/user/userOrder",
        data: Object.assign({},$orderList),
        dataType: "json",
        success: function (response) {
            // console.log(response);
        },
    });

})



})
