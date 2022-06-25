window.addEventListener("scroll", function function_name(argument) {
	var nav = document.querySelector("nav");
	nav.classList.toggle("color-nav",window.scrollY > 0);
	
})