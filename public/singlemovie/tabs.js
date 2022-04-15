document.addEventListener("DOMContentLoaded", () => {
  let crewCastTab = document.querySelector(".tabs");
  let instance = M.Tabs.init(crewCastTab, {});

  movieTitleBox = document.querySelector("#movietitleBox");
  movieTitleBox.addEventListener("click", (e) => {
    if (
      e.target.className == "far fa-heart fav-icon" ||
      e.target.className == "far fa-heart fav-icon toggle-fav"
    ) {
      e.target.classList.toggle("toggle-fav");
      e.target.classList.contains("toggle-fav") ? window.location.href = `../favourtiespage/addfavourite.php?id=${e.target.dataset.id}&ref=sin` : window.location.href = `../favourtiespage/removefavourite.php?id=${e.target.dataset.id}&ref=sin`;
    }
  });
})
