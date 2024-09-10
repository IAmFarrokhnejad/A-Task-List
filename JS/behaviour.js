// Author: Morteza Farrokhnejad
document.addEventListener('DOMContentLoaded', () => {

	document.getElementById('modification').addEventListener("click",e=>{
		if(e.target.name=='edit')
		{
			e.target.style.display='none';
			e.target.parentElement.parentElement.previousElementSibling.style.display = 'none';
			e.target.previousElementSibling.style.display='initial';

			e.target.parentElement.previousElementSibling.childNodes.forEach(element => {
				if (element.name == "priorityText" || element.name == "statusText") 
				{
					element.style.display = "none";
				}
				else if (element.name.includes("priority") || element.name.includes("status")) 
				{
					element.style.display = "block";
				}
				element.removeAttribute("disabled");
				e.target.parentElement.previousElementSibling.style.display = 'block';
				e.target.classList.add('active');
				e.target.previousElementSibling.previousElementSibling.textContent = 'Hide';
			});
		}
	})
	document.body.addEventListener('click', (e) => {
		if (e.target.classList.contains("show")) {
			if (e.target.classList.contains("active")) {
				e.target.parentElement.previousElementSibling.style.display = 'none';
				e.target.parentElement.parentElement.previousElementSibling.style.display = 'block';
				e.target.classList.remove('active');
				e.target.textContent = 'Show';
			} 
			else 
			{
				e.target.parentElement.previousElementSibling.style.display = 'block';
				e.target.parentElement.parentElement.previousElementSibling.style.display = 'none';
				e.target.classList.add('active');
				e.target.textContent = 'Hide';
			}
		}
	})

	document.getElementById("sort").addEventListener("input", (e) => {
		e.target.form.submit();
	})
});
