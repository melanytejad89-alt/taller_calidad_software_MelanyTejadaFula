function E(selector, parent) {
	if (selector instanceof HTMLElement) {
		return selector;
	}
	return (parent || document).querySelectorAll(selector);
  }
  
  function hasClass(element, className) {
	return element.classList.contains(className);
  }
  
  function radioClass(element, className) { // Corrected parameter name to 'className'
	E("." + className).forEach((elem) =>
		elem.classList.remove(className)
	);
	element.classList.toggle(className);
  }
  
  function tabs(navSelector) { // Changed 'nav' to 'navSelector' for clarity
	let navElem = E(navSelector)[0];
  
	if (navElem) { // Added check to ensure navElem exists
		navElem.addEventListener("click", (e) => {
			let target = e.target;
			if (hasClass(target, "tab")) {
				radioClass(target, "active");
			}
  
			let linkedTab = E("." + target.id)[0];
			if (linkedTab) { // Added check to ensure linkedTab exists
				radioClass(linkedTab, "visible");
			}
		});
  
		let active = E(".tab.active")[0];
		if (active) {
			let linkedActiveTab = E("." + active.id)[0]; // Added a more descriptive variable name
			if (linkedActiveTab) { // Added check to ensure linkedActiveTab exists
				radioClass(linkedActiveTab, "visible");
			}
		}
	}
  }
  
  tabs(".menu-nav");
  
  // Funcionalidad para el primer "Cargar más"
  let loadMoreBtn1 = document.querySelector('.load-more-1');
  let currentItem1 = 4;
  
  if (loadMoreBtn1) {
	loadMoreBtn1.onclick = () => {
		let boxes1 = [...document.querySelectorAll('.box-container-1 .box')];
		for (let i = currentItem1; i < Math.min(currentItem1 + 4, boxes1.length); i++) {
			boxes1[i].style.display = 'inline-block';
		}
		currentItem1 += 4;
		if (currentItem1 >= boxes1.length) {
			loadMoreBtn1.style.display = 'none';
		}
	};
  }
  
  // Funcionalidad para el segundo "Cargar más"
  let loadMoreBtn2 = document.querySelector('.load-more-2'); // Selector para el segundo botón
  let currentItem2 = 4;
  
  if (loadMoreBtn2) { // Usar el selector correcto para el segundo botón
	loadMoreBtn2.onclick = () => {
		let boxes2 = [...document.querySelectorAll('.box-container-2 .item')]; // Selectores para el segundo conjunto de contenido
		for (let i = currentItem2; i < Math.min(currentItem2 + 4, boxes2.length); i++) {
			boxes2[i].style.display = 'inline-block';
		}
		currentItem2 += 4;
		if (currentItem2 >= boxes2.length) {
			loadMoreBtn2.style.display = 'none';
		}
	};
  }
