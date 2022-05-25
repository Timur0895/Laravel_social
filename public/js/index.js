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
