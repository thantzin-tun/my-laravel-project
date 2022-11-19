let userOne = document.querySelector(".userOne");
let userTwo = document.querySelector(".userTwo");
let editBox = document.querySelector(".editBox");
let editAlert = document.querySelectorAll(".editAlert");
let topass = document.querySelector(".toPass");
let toinfo = document.querySelector(".toInfo");


function toggleClassTwo(){
    editBox.classList.toggle("opa");
    editAlert[0].classList.toggle("boxx");
    editAlert[1].classList.remove("boxx");
}

function toggleClassOne(){
  editBox.classList.remove("opa");
  editAlert[0].classList.remove("boxx");
  editAlert[1].classList.remove("boxx");
}

userOne.addEventListener("click",()=> {
  toggleClassTwo();
})

userTwo.addEventListener("click",()=> {
  toggleClassTwo();
})

//Change Password Box and Info Box for user page Modal box
//Buttons
toinfo.addEventListener("click",()=> {
  editAlert[1].classList.remove("boxx");
  editAlert[0].classList.add("boxx");
})

topass.addEventListener("click",()=> {
  editAlert[0].classList.remove("boxx");
  editAlert[1].classList.add("boxx");
})


editBox.addEventListener("click",()=> {
  toggleClassOne();
});


