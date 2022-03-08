function addZero (num){
	return (num<=9) ? "0"+num : num;
}

function getCurrentDate(){
	let date = new Date();
	let day = addZero(date.getDate());
	let month = addZero(date.getMonth()+1);
	let year = date.getFullYear();
	return (day+"/"+month+"/"+year);
}

console.log(getCurrentDate());