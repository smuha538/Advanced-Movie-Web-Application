
let searchBox = document.querySelector("#searchbar");
let elems = document.querySelectorAll('.carousel');
let cardBody = document.querySelector("#card-body");
let instances = M.Carousel.init(elems);

let errorMsgContanier = document.createElement("div");
let errorMsg = document.createElement('p');
errorMsg.textContent = "Please enter a movie title";
errorMsg.style.color = "red";
errorMsg.style.fontSize = "1.5rem";
errorMsgContanier.appendChild(errorMsg);

document.querySelector("#searchButton").addEventListener('click', () => {
  findMatchingMovies();
});

document.addEventListener('keypress', function(e) {
  if (e.key === 'Enter')
   {
    findMatchingMovies(); 
   }
});

document.addEventListener('click', (e) => {
  
  if(e.target && e.target.classList == "movie")
  {
    window.location.href = `./singlemovie/single-movie.php?id=${e.target.dataset.id}`;
  }
});

function findMatchingMovies() {
  let getTitle = searchBox.value.trim();
  if (!getTitle)
  {
    searchBox.placeholder = "Enter a Movie Title";
    cardBody.appendChild(errorMsgContanier);
  }
  else
  {
      getMovies(getTitle);
  }  
}

function getMovies(title){
  let getTitle = title;
  let test = `https://comp-3512-w22-team-03.herokuapp.com/api/movies.php?title=${getTitle}`;
  fetch(test)
  .then((response) => response.json())
  .then((movie) =>{
  searchMovie(movie)});
}

function searchMovie(movies)
{
  sessionStorage.clear();
  localStorage.clear();
  let alpa = alphabeticalOrder(movies);
  sessionStorage.setItem("movies",JSON.stringify(alpa));
  localStorage.setItem("movies",JSON.stringify(alpa));
  window.location.href = './browsepage/browse-movies.php';
}

function alphabeticalOrder (movies) {
  return movies.sort((a,b) => a.title.localeCompare(b.title));
}




