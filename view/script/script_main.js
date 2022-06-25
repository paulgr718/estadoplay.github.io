window.addEventListener("scroll", function function_name(argument) {
	var nav = document.querySelector("nav");
	nav.classList.toggle("nav-color",window.scrollY > 0);
	
})