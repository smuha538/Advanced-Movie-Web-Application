  let filtertoggle =  document.querySelector("#toggle");
  let movieDiv = document.querySelector("#movieListingMovies");
  let messageLocation = document.querySelector("#message");
  let searchFilterBox = document.querySelector("#searchBar");
  let beforeYear = document.querySelector("#beforeYear");
  let afterYear = document.querySelector("#afterYear");
  let betweenFrom = document.querySelector("#betweenFrom");
  let betweenTill = document.querySelector("#betweenTill");
  let belowRate = document.querySelector("#belowRate");
  let aboveRate = document.querySelector("#aboveRate");
  let betweenFromRate = document.querySelector("#betweenFromRate");
  let betweenTillRate = document.querySelector("#betweenTillRate");
  let belowOutput = document.querySelector("#belowOutput");
  let aboveOutput = document.querySelector("#aboveOutput");
  let betweenFromOutput = document.querySelector("#betweenFromOutput");
  let betweenTillOutput = document.querySelector("#betweenTillOutput");
  let favouriteButton = document.querySelector("#favouriteMovies");
  let filterButton = document.querySelector("#filterMovies");
  let sortButtons = document.querySelectorAll(".sortButtons");
  let filteredMovies;
  let movieFilteredArray;
  let suggestionBox = document.querySelector("#suggestionBox");
  let suggestionSection = document.querySelector("#suggestions");
  let noFavourites = "You Do Not Have Any Favourite Movies";
  let invalidMovies = "The Movie You are Searching For Cannot Be Found";
  let noResultMessage = "No Result";
  let redirectedMovies;

  filtertoggle.addEventListener('click', () => {

    let aside = document.querySelector("#aside");
    
    if(aside.classList.contains("visibility"))
    {
      aside.style.display = 'block';
      setTimeout(() => {
        aside.classList.toggle("visibility");
      }, 100);  
    }
    else
    {
      aside.classList.toggle("visibility");
      setTimeout(() => {
        aside.style.display = 'none';
      }, 555);
    }
  });
  
    function clearFilteredMovieArray () {
      movieFilteredArray = [];
      filteredMovies = [];
    }
  
  
    function containsSuggestion()
    {
      if(!suggestionSection.classList.contains("hideSuggestions"))
      {
        toggleSuggestionBox();
      }
    }
  
    function unCheckRadio()
    {
      document.getElementsByName("year").forEach((radio) => radio.checked = false);
      document.getElementsByName("rating").forEach((radio) => radio.checked = false);
    }
    
    function toggleIndexFromDetails (){
      toggleDisplayNone(detailsDiv);
      toggleDisplayNone(homeDiv);
      toggleIndexBody();
    }
  
    function removeAllChild (parentElement) {
        
      parentElement.replaceChildren();
    }
  
    function isFavourite (id) {
  
      let favouriteIds = getFavouriteIds();
      let isFavourite = false;
      for (let i = 0; i < favouriteIds.length; i++)
      {
        if(favouriteIds[i] == id)
        {
          isFavourite = true;
        }
      }
        
        return isFavourite;
    }
  
    function clearSearchBox() {
      searchBox.value = "";
    }
  
    function clearFilterSearchBar() {
      searchFilterBox.value = "";
    }
  
    function changeSearchButton() {
      searchButton.style.backgroundColor = "grey";
    }
  
    function restoreSearchButton() {
      searchButton.style.backgroundColor = "";
    }
  
    function changeFavouriteButton() {
      favouriteButton.style.backgroundColor = "grey";
    }
  
    function restoreFavouriteButton() {
      favouriteButton.style.backgroundColor = "";
    }
  
    function toggleSuggestionBox(){
      suggestionSection.classList.toggle("hideSuggestions");
    }
  
    function clearNumberInput (){
      let numTextBox = document.querySelectorAll(".textbox");
      numTextBox.forEach((textBox) => textBox.value = "");
    }
    function clearRadioCheck (){
      let radioInput = document.querySelectorAll('input[type="radio"]');
      radioInput.forEach((radio) => radio.checked = false);
    }
  
    function clearRatingInput (){
      let rangeBox = document.querySelectorAll('input[type="range"]');
      rangeBox.forEach((range) => range.value = "0");
  
      let rangeOutput = document.querySelectorAll('output');
      rangeOutput.forEach((range) => range.value = "0");
  
    }
  
    function alphabeticalOrder (movies) {
      return movies.sort((a,b) => a.title.localeCompare(b.title));
    }
  
    function revAlphabeticalOrder (movies) {
      return movies.sort((a,b) => b.title.localeCompare(a.title));
    }
  
    function yearOrderAsc (movies) {
      return movies.sort((a,b) => a.release_date.substring(0, 4) - b.release_date.substring(0, 4));
    }
  
    function yearOrderDsc (movies) {
      return movies.sort((a,b) => b.release_date.substring(0, 4) - a.release_date.substring(0, 4));
    }
  
    function rateOrderAsc (movies) {
      return movies.sort((a,b) => a.vote_average - b.vote_average);
    }
  
    function rateOrderDsc (movies) {
      return movies.sort((a,b) => b.vote_average - a.vote_average);
    }
  
    function noMovies(message) 
    {
      removeAllChild(messageLocation);
      let messageDiv = document.createElement("div");
      messageDiv.textContent = message;
      messageLocation.appendChild(messageDiv);
    }

    function getFavouriteIds()
    {
      let favourites = document.querySelector("#favourites").textContent;
      let ids = favourites.split(" ");
      return ids;
    }
  
    function listMovies (movies) {
       redirectedMovies = movies;
       updateMovies();
        movies.forEach((movie) => {
  
            let posterDiv = document.createElement("div");
            let poster = document.createElement("img");
            let movieTitle = document.createElement("div");
            let year = document.createElement("div");
            let rating = document.createElement("div");
            let rateStar = document.createElement("img");
            posterDiv.appendChild(poster);
  
            addDataToMovieElements(movie, poster, posterDiv, movieTitle, year, rating, rateStar);    
        });     
    }
  
    function addDataToMovieElements(movie, poster, posterDiv, movieTitle, year, rating, rateStar)
    {
      checkIfPosterSrcIsNull(poster, movie);     
      movieTitle.textContent = movie.title;
      year.textContent = new Date(movie.release_date).getFullYear();
      rating.textContent = movie.vote_average;
      rateStar.src = "../images/star.png";
      rateStar.width = "15";
      rateStar.height = "15";
      rateStar.alt = "star";
    
      movieTitle.style.cursor = "pointer";
      movieTitle.dataset.id = movie.id;
      poster.dataset.id = movie.id;
  
      setAttributeToMovieElements(movie, poster, posterDiv, movieTitle, year, rating, rateStar);
    }
  
    function checkIfPosterSrcIsNull(poster, movie)
    {
      if(movie.poster_path)
      {
        poster.src = `https://image.tmdb.org/t/p/w92/${movie.poster_path}`; 
      }
      else
      {
        poster.src = "noImages.jpg"; 
        poster.style.width = "92px";
      }   
    }
  
    function setAttributeToMovieElements(movie, poster, posterDiv, movieTitle, year, rating, rateStar)
    {
      poster.setAttribute("class", "clickPoster");
      movieTitle.setAttribute("class", "clickTitle");
      year.setAttribute("class", "yearDiv");
      rating.setAttribute("class", "rateDiv");
  
      appendMovieElementsToDefaultView(movie, posterDiv, movieTitle, year, rating, rateStar);
    }
  
    function appendMovieElementsToDefaultView(movie, posterDiv, movieTitle, year, rating, rateStar)
    {
      let logged = document.querySelector("#favourites");
      movieDiv.appendChild(posterDiv);
      movieDiv.appendChild(movieTitle);
      movieDiv.appendChild(year);
      movieDiv.appendChild(rating);
      rating.appendChild(rateStar);
      if(logged.dataset.status == 1)
      {
        createFavouriteButton(movie, logged.dataset.user);
      }
    }

    function createFavouriteButton(movie, user)
    {
      let favourite = document.createElement("div");
      if (isFavourite(movie.id))
      {
        favouritedHeart(favourite);
      }
      else
      {
        unfavouritedHeart(favourite);
      } 
  
      favourite.style.cursor = "pointer";
      favourite.dataset.id = movie.id;
      favourite.dataset.user = user;
      favourite.setAttribute("class", "favouriteButton");
      movieDiv.appendChild(favourite);
    }
  
    function noResult (filteredMovies){
      if(filteredMovies == "")
      {
        return noMovies(noResultMessage);
      }
    }
  
    function rangeOutput(){
      belowRate.addEventListener("input", function() {belowOutput.value = belowRate.value});
      aboveRate.addEventListener("input", function() {aboveOutput.value = aboveRate.value});
      betweenFromRate.addEventListener("input", function() {betweenFromOutput.value = betweenFromRate.value});
      betweenTillRate.addEventListener("input", function() {betweenTillOutput.value = betweenTillRate.value});
    }
  
    
  
    function changeFilterButton(){
      filterButton.style.backgroundColor = "grey";
    }
  
    function restoreFilterButton(){
      filterButton.style.backgroundColor = "#2da09c";
    }
  
  
  
    function searchMovie(movies)
    {
      removeAllChild(suggestionBox);
      removeAllChild(messageLocation);
      movieFilteredArray = movies;
      filteredMovies = movies;
      if (!movies.length == 0)
      {
          movies.forEach((movie) => sessionStorage.setItem(movie.id, JSON.stringify(movie)));
          listMovies(alphabeticalOrder(movies));  
      }
      else
      {
          noMovies(invalidMovies);
      }
    }
  
    function clearUnchecked(radioValue){
      let textboxes = document.querySelectorAll('.textbox');
      let rangeSliders = document.querySelectorAll('.slider');
  
      if(radioValue == "betweenFrom" || radioValue == "betweenTill")
      {
        clearYearBetweenFilter(textboxes);
     }
     else if (radioValue == "beforeYear" || radioValue == "afterYear")
     {
        clearBeforeAfterYearFilter(textboxes, radioValue);
     }
  
      else if (radioValue == "betweenFromRate" || radioValue == "BetweenTillRate")
      {
        clearBetweenRateFilter(rangeSliders);
      }
      else if (radioValue == "belowRate" || radioValue == "aboveRate")
      {
        clearBelowAboveRateFilter(rangeSliders, radioValue);
      }
    }
  
    function clearYearBetweenFilter(textboxes)
    {
      for (let i = 0; i < textboxes.length; i++) 
      {
        if(textboxes[i].id == "beforeYear" ||  textboxes[i].id == "afterYear")
        {
        textboxes[i].checked = false;
        textboxes[i].value = "";
       }
      }
    }
  
    function clearBeforeAfterYearFilter(textboxes, radioValue)
    {
      for (let i = 0; i < textboxes.length; i++) 
      {
        if(textboxes[i].id != radioValue)
        {
        textboxes[i].checked = false;
        textboxes[i].value = "";
        }
     }
    }
  
    function clearBetweenRateFilter(rangeSliders)
    {
      for (let i = 0; i < rangeSliders.length; i++) 
      {
          if(rangeSliders[i].id == "belowRate" ||  rangeSliders[i].id == "aboveRate")
          {
            rangeSliders[i].checked = false;
            rangeSliders[i].value = "0";
          }
          belowOutput.value = "0";
          aboveOutput.value = "0";
      }
    }
  
    function clearBelowAboveRateFilter(rangeSliders, radioValue)
    {
      for (let i = 0; i < rangeSliders.length; i++) 
      {
          if(rangeSliders[i].id != radioValue)
          {
            rangeSliders[i].checked = false;
            rangeSliders[i].value = "0";
          }
          if(radioValue == "belowRate")
          {
            aboveOutput.value = "0";
            betweenTillOutput.value = "0";
            betweenFromOutput.value = "0";
          }
          else if(radioValue == "aboveRate")
          {
            belowOutput.value = "0";
            betweenTillOutput.value = "0";
            betweenFromOutput.value = "0";
          }
        }
    }

    function updateMovies()
    {
      sessionStorage.clear();
      sessionStorage.setItem("movies", JSON.stringify(redirectedMovies));
    }
  
    function favouritedHeart(element)
    {
      element.textContent = "\uD83D\uDC96";
    }
  
    function unfavouritedHeart(element)
    {
      element.textContent = "\uD83E\uDD0D";
    }
  
    function clearSortButtons(){
      sortButtons.forEach((button) => button.classList = "sortButtons");
   }
  
    document.addEventListener('change', (e) => {
      if(e.target && e.target.classList == "slider")
          {
            rangeOutput();
          }
  
    });
  
    document.addEventListener('click', (e) => {    
        if(e.target && e.target.classList == "favouriteButton")
        {
          e.target.textContent == "\uD83E\uDD0D" ? window.location.href = `../favourtiespage/addfavourite.php?id=${e.target.dataset.id}&ref=brow` : window.location.href = `../favourtiespage/removefavourite.php?id=${e.target.dataset.id}&ref=brow`;
        }
        if(e.target && e.target.tagName == "LI")
        {
          searchBox.value = e.target.textContent;
          removeAllChild(suggestionBox);
          toggleSuggestionBox();
        }  
  
        if(e.target && e.target.classList == "sortButtons")
        {
          clearSortButtons();
          let typeSort = e.target.id;
          if(typeSort == "titleAsc"){
            removeAllChild(movieDiv);
            listMovies(alphabeticalOrder(filteredMovies));
          }
  
          else if(typeSort == "titleDsc"){
            removeAllChild(movieDiv);
            listMovies(revAlphabeticalOrder(filteredMovies));
          }
  
          else if(typeSort == "yearAsc"){
            removeAllChild(movieDiv);
            listMovies(yearOrderAsc(filteredMovies));
          }
  
          else if(typeSort == "yearDsc"){
            removeAllChild(movieDiv);
            listMovies(yearOrderDsc(filteredMovies));
          }
  
          else if(typeSort == "rateAsc"){
            removeAllChild(movieDiv);
            listMovies(rateOrderAsc(filteredMovies));
          }
  
          else if(typeSort == "rateDsc"){
            removeAllChild(movieDiv);
            listMovies(rateOrderDsc(filteredMovies));
          }
        
          e.target.classList.add("sortSelected");
        }
  
      });
  
      document.addEventListener("input", (e) => {
        restoreFilterButton();
          //Listens for changes in any slider and matchs id with the radio value inorder to clear
          //other sliders that are unchecked
          if(e.target && e.target.classList == "slider")
          {
             let radioValue = e.target.id;
             let radio = document.querySelector(`input[value=${radioValue}]`);
    
             if(radioValue == "betweenFromRate" || radioValue == "betweenTillRate"){
                let radioBetween = document.querySelector('input[value="betweenRate"]');
                radioBetween.checked = true;
                clearUnchecked(radioValue);
             }
             else{
                radio.checked = true;
                clearUnchecked(radioValue);
             }
          }
          //Listens for changes in any text box and matchs id with the radio value inorder to clear
          //other boxes that are unchecked
          if(e.target && e.target.classList == "textbox")
             {
                let radioValue = e.target.id;
                let radio = document.querySelector(`input[value=${radioValue}]`);
       
                if(radioValue == "betweenFrom" || radioValue == "betweenTill"){
                   let radioBetween = document.querySelector('input[value="betweenYear"]');
                   radioBetween.checked = true;
                   clearUnchecked(radioValue);
                }
                else{
                   radio.checked = true;
                   clearUnchecked(radioValue);
                }
            } 
      });
  
      filterButton.addEventListener('click', () => {
        
        filter();
  
      });
  
    // This function serves as a way for non mutual filtering of movies based on three feilds (title, year, rating)
    // If there is no input or changes in all feilds the display will show no changes, and filter button will grey out.
    // One list of movies (filteredMovies) is used in junction with mutliple "if" statemnet for condition checks of each field input.
    function filter() {
      restoreFilterButton();
      removeAllChild(messageLocation);
      let checkedYearRadio = document.querySelector('input[name="year"]:checked');
      let checkedRatingRadio = document.querySelector('input[name="rating"]:checked');
      filteredMovies = movieFilteredArray;
      if(searchFilterBox.value !== ""){
        let getTitle = searchFilterBox.value.trim();
        filteredMovies = filteredMovies.filter((movie) => movie.title.match(getTitle.charAt(0).toUpperCase() + getTitle.slice(1)));
        removeAllChild(movieDiv);
        noResult(filteredMovies);
        listMovies(alphabeticalOrder(filteredMovies));
      }
  
      if(checkedYearRadio != null){
        let id = checkedYearRadio.value;
  
        if(id == "betweenYear"){
          let yearNumFrom = document.querySelector("#betweenFrom").value;
          let yearNumTill = document.querySelector("#betweenTill").value;
          filteredMovies = filteredMovies.filter((movie) =>  movie.release_date.substring(0, 4) >= yearNumFrom
          && movie.release_date.substring(0, 4) <= yearNumTill);
          noResult(filteredMovies);
          
        }
        else if (id == "afterYear"){
          let yearNumAfter = document.querySelector("#afterYear").value;
          filteredMovies = filteredMovies.filter((movie) => movie.release_date.substring(0, 4) > yearNumAfter);
          noResult(filteredMovies);
        }
  
        else if (id == "beforeYear"){
          let yearNumBefore = document.querySelector("#beforeYear").value;
          filteredMovies = filteredMovies.filter((movie) => movie.release_date.substring(0, 4) < yearNumBefore);
          noResult(filteredMovies);
        }
        removeAllChild(movieDiv);
        listMovies(alphabeticalOrder(filteredMovies));
      }
  
      if(checkedRatingRadio != null){
        let id = checkedRatingRadio.value;
  
        if(id == "betweenRate"){
          let rateFrom = document.querySelector("#betweenFromRate").value;
          let rateTill = document.querySelector("#betweenTillRate").value;
          filteredMovies = filteredMovies.filter((movie) =>  movie.vote_average >= rateFrom
          && movie.vote_average <= rateTill);
          noResult(filteredMovies);
          
        }
        else if (id == "aboveRate"){
          let rateAbove = document.querySelector("#aboveRate").value;
          filteredMovies = filteredMovies.filter((movie) => movie.vote_average > rateAbove);
          noResult(filteredMovies);
        }
  
        else if (id == "belowRate"){
          let rateBelow = document.querySelector("#belowRate").value;
          filteredMovies = filteredMovies.filter((movie) => movie.vote_average < rateBelow);
          noResult(filteredMovies);
        }
  
        removeAllChild(movieDiv);
        listMovies(alphabeticalOrder(filteredMovies));
      }
  
      
      if(searchFilterBox.value == "" && checkedYearRadio == null && checkedRatingRadio == null){
        changeFilterButton();
      }
    }
  
    document.querySelector("#clearFilters").addEventListener('click', () => {
      clearFilterSearchBar();
      clearNumberInput();
      clearRatingInput();
      clearRadioCheck();
      setOriginalMovies();
    });

function setOriginalMovies()
{
  removeAllChild(movieDiv);
  removeAllChild(messageLocation);
  filteredMovies = originalStorage;
  movieFilteredArray = originalStorage;
  listMovies(originalStorage);
}    

function redirectToSinglePage(movieID)
{
  window.location.href = `../singlemovie/single-movie.php?id=${movieID}`;
}

document.querySelector("#movieListingMovies").addEventListener("click", (e) => {

  if(e.target && e.target.classList == "clickPoster" || e.target && e.target.classList == "clickTitle")
  {
    redirectToSinglePage(e.target.dataset.id);
  }
});


let storage = [];
let searchedMovies;
searchedMovies = JSON.parse(sessionStorage.getItem("movies"));
searchedMovies.forEach((movie) => storage.push(movie));
let originalStorage = [];
let originalMovies;
originalMovies = JSON.parse(localStorage.getItem("movies"));
originalMovies.forEach((movie) => originalStorage.push(movie));


if (storage.length == 0)
{
  noMovies(invalidMovies);
} 
else
{
  redirectedMovies = storage;
  movieFilteredArray = storage;
  filteredMovies = storage;
  listMovies(storage);
}
