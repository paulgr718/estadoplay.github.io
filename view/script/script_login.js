const inputs = document.querySelectorAll('.input');

function icFunc(){
	let parent = this.parentNode.parentNode;
	parent.classList.add('ic');
}

inputs.forEach(input =>{
	input.addEventListener('ic',icFunc)
})