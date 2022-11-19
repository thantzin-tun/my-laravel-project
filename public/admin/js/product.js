//if add Category Button Click Modal Box
let addcategory = document.querySelector(".addCategory");
let createBox = document.querySelector(".createBox");
let createAlert = document.querySelector(".createAlert");

let box = document.querySelector(".box");

function toggleClassOne(){
  createBox.classList.toggle("opa");
  createAlert.classList.toggle("boxx");
}

addcategory.addEventListener("click",(e)=> {
  e.preventDefault();
  toggleClassOne();
})

createBox.addEventListener("click",()=> {
  toggleClassOne();
})
//


//Prodcut View Box anbd Model
let productBox = document.querySelector('.productBox');
let productAlert = document.querySelector('.productAlert');


let tBody = document.querySelector(".tBody");
let inputField = document.querySelectorAll('.input');

const fileInput = document.querySelector('.file');


for(let i=0;i<tBody.childElementCount;i++){

  //Edit Button
  tBody.children[i].children[5].children[0].children[0].addEventListener("click",(event)=> {
    event.preventDefault();
    toggleClassTwo();
    let inputBox = tBody.children[i].children[5].children[0].childNodes[1];
    inputField[0].value = inputBox.id; 
    inputField[1].value = inputBox.getAttribute("name"); 
    inputField[2].value = inputBox.getAttribute("category_id"); 
    inputField[3].value = inputBox.getAttribute("description"); 
    inputField[4].value = inputBox.getAttribute("waiting");
    inputField[5].value = inputBox.getAttribute("price");
  })

  //Delelte button
  tBody.children[i].children[5].children[1].children[0].addEventListener("click",(event)=> {
    event.preventDefault();
    toggleClassThree();
    document.querySelector(".val").value = tBody.children[i].children[5].children[1].childNodes[1].id;
  })

  //Product View Modal Box and Alert

  tBody.children[i].children[4].children[0].addEventListener('click',()=> {
      productBox.classList.toggle("opa");
      productAlert.classList.toggle("pshow");
  })


}; 



productBox.addEventListener("click",()=> {
  productBox.classList.toggle('opa');
  productAlert.classList.toggle('pshow');
})


// Edit Modal Alert Box
let editBox = document.querySelector(".editBox");
let editAlert = document.querySelector(".editAlert");
function toggleClassTwo(){
    editBox.classList.toggle("opa");
    editAlert.classList.toggle("boxx");
}

editBox.addEventListener("click",()=> {
    toggleClassTwo();
})


//Product Delete Modal
let deleteBox = document.querySelector(".deleteBox");
let cookiesContent = document.querySelector(".cookiesContent");
let hide = document.querySelector(".close");

function toggleClassThree(){
  deleteBox.classList.toggle("opa");
  cookiesContent.classList.toggle("delBox");
}

deleteBox.addEventListener("click",()=> {
  toggleClassThree();
})

hide.addEventListener("click",()=>{
  toggleClassThree();
})









