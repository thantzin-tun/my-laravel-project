//User Home Page Menu Side for Js Code

let hambuger_menu = document.querySelector("#menu");

let close = document.querySelector('.cross');

let mobileSideBar = document.querySelector(".mobileSideBar");

hambuger_menu.addEventListener("click",()=> {
    mobileSideBar.classList.add("sideShow");
});

close.addEventListener("click",()=> {
  mobileSideBar.classList.remove("sideShow");
});


//Orderlist.blade.php page js for orderview show box

// let orderCode = document.querySelectorAll(".orderCode");


// for(let i=0;i<orderCode.length;i++){
//   orderCode[i].addEventListener("click",()=> {
//     console.log("Hi");
//   })
// }

$(".orderCode").each(function () {
  $(this)
      .unbind()
      .click(function () {
          alert("HI");
      });
});