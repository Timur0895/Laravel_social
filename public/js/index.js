const alternateStyle = document.querySelectorAll(".alternate-style");
function setActiveStyle(color) {
  alternateStyle.forEach((style) => {
    if(color === style.getAttribute("title"))
    {
      style.removeAttribute("disabled");
    }
    else {
      style.setAttribute("disabled", "true");
    }
  })
};

const searchInput = document.querySelector(".messenger-search");

searchInput.addEventListener("click", function () {
  const searchItem = document.querySelector(".search-tab");
  const usersTab = document.querySelector(".users-tab");

  //console.log(searchItem.classList.contains("flex"));
  if (searchItem.classList.contains("flex")) {
    searchItem.classList.remove("flex");
    //console.log(searchItem.classList);
    searchItem.classList.add("hidden");
    usersTab.classList.remove("hidden");
    usersTab.classList.add("block");
  }
  else  
  {
    searchItem.classList.add("flex");
    searchItem.classList.remove("hidden");
    usersTab.classList.remove("block");
    usersTab.classList.add("hidden");
  };
})