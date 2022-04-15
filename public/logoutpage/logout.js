document.addEventListener("click", (e) => {
  if(e.target && e.target.classList == "logout")
  {
    localStorage.clear();
    sessionStorage.clear();
  }
});
