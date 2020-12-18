// To Top
mybutton = document.getElementById("to-top");

window.onscroll = function() {
	scrollFunction();
	// menulogin();
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
} 

// fungsi menu - daftar
// btndaftar = document.getElementById('tombolDaftar');
// function menulogin(){
// 	if (document.body.scrollTop > 20 || document.documentElement.scrollTop >20 ) {
// 		btndaftar.style.display = 'block';
// 	}else{
// 		btndaftar.style.display = 'none';
// 	}
// }