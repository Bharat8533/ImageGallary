
const key = 'fK3L1sPRt_h0KraDzWz1lYlKpqmQqN9EhmzoOHY1HwI';
let inputSearch = document.querySelector('#input');
let searchBtn = document.querySelector('#searchBtn');

searchBtn.addEventListener('click',searchImage);

async function searchImage(e){
    e.preventDefault();

    let inputData = inputSearch.value;

      const url = `https://api.unsplash.com/search/photos/?query=${inputData}&client_id=${key}&per_page=50`;
      let response = await fetch(url);
      let data = await response.json();
      // console.log(data);

      let result = data.results;
      let k = 0, l = k + 10;
      document.querySelector("#image-show").innerHTML = "";
      for(let i = 0 ; i < result.length  ; i++){
        console.log(result.length[i]);
        const col = document.createElement("div");
        col.className = "column";
        for(let j = k ; j < l ; j++){
          const img = document.createElement("img");
          img.src = result[i].urls.small;
          img.onclick=(e)=>{
            window.open(result[i].urls.full);
          };
          col.appendChild(img);
          i++;
        }
        i--;
       document.querySelector("#image-show").append(col);
      }
      
}
