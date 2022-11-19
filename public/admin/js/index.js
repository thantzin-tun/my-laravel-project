

//if add Category Button Click Modal Box
let addCategory = document.getElementsByClassName("addCategory")[0];
let createBox = document.querySelector(".createBox");
let createAlert = document.querySelector(".createAlert");

let box = document.querySelector(".box");

function toggleClassOne(){
  createBox.classList.toggle("opa");
  createAlert.classList.toggle("boxx");
}

addCategory.addEventListener("click",(e)=> {
  e.preventDefault();
  toggleClassOne();
})

createBox.addEventListener("click",()=> {
  toggleClassOne();
})
//


//if edit button click Modal Box
let editBox = document.querySelector(".editBox");
let editAlert = document.querySelector(".editAlert");


function toggleClassTwo(){
    editBox.classList.toggle("opa");
    editAlert.classList.toggle("boxx");
}

editBox.addEventListener("click",()=> {
  toggleClassTwo();
})


//Category Delete Modal
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


//Delet and Edit Maal Looping
let tBody = document.querySelector(".tBody");
for(let i=0;i<tBody.childElementCount;i++){
  

   //Edit Button
   tBody.children[i].children[5].children[0].addEventListener("click",(event)=> {
      event.preventDefault();
       toggleClassTwo();
       document.querySelector(".editVal").value = tBody.children[i].children[5].children[0].childNodes[1].value;
       document.querySelector(".editID").value = tBody.children[i].children[5].children[0].childNodes[1].id;
  }); 


  //Delet Button
  tBody.children[i].children[5].children[1].addEventListener("click",(event)=> {
    event.preventDefault();
    toggleClassThree();
    document.querySelector(".val").value = tBody.children[i].children[5].children[1].childNodes[1].id; 
  });
  
};



