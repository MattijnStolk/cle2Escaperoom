let bbq = document.getElementById('bbq');
let bbqPersonsDiv = document.getElementById('bbqPersons');
bbq.addEventListener('change', function (){
    console.log(bbq.value)
    if (bbq.value == 1){
        bbqPersonsDiv.style.display = 'block';
    } else {
        bbqPersonsDiv.style.display = 'none';
    }
});
