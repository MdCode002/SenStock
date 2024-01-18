let count = document.querySelector('.countnub');
let hidecount = document.querySelector('.hidecountnub').innerHTML;

let countP = document.querySelector('.countnubP');
let hidecountP = document.querySelector('.hidecountnubP').innerHTML;
hidecount = parseInt(hidecount);
hidecountP = parseInt(hidecountP);
let i = 0;
let y = 0;
function updateCount() {
    if (i <= hidecount) {
        count.textContent = i;
        i++;
        setTimeout(updateCount, 100);
    }
}
function updateCountP() {
    if (y <= hidecountP) {
        countP.textContent = y;
        y++;
        setTimeout(updateCountP, 100);
    }
}

updateCount();
updateCountP();
