var images = [
  "https://wallpaperaccess.com/full/123346.jpg",
  "https://wallpaperaccess.com/full/1249519.jpg",
  "https://cdn.wallpapersafari.com/51/86/0VLdp8.jpg"
]


var imageHead = document.getElementById("image-head");
var i = 0;

setInterval(function() {
      imageHead.style.backgroundImage = "url(" + images[i] + ")";
      if(i == 1){

      }
      i = i + 1;
      if (i == images.length) {
      	i =  0;
      }
}, 3000);