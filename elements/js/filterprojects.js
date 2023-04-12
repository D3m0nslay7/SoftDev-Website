Intl.DateTimeFormat().resolvedOptions().timeZone = 'Europe/London';

const textFilter = document.querySelector('#search-text');
textFilter.addEventListener('input', function () {
    searchCards(textFilter, '.card');
});

const dateFilter = document.querySelector('#search-date');
dateFilter.addEventListener('input', function () {
    searchByDate(dateFilter, '.card');
});

function searchCards(input, cardSelector) {
    // Convert input to lowercase for case-insensitive search
    const searchText = validatefilterData(input.value.toLowerCase());

    // Get all cards matching the specified selector
    const cards = document.querySelectorAll(cardSelector);

    // Loop through cards and hide/show based on search text
    cards.forEach(function (card) {
        var title = card.querySelector(".card-title").textContent.toLowerCase();
        if (title.includes(searchText)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}

function searchByDate(input, cardSelector) {

    const searchDate = new Date(Date.parse(validatefilterData(input.value)));

    searchDate.setHours(0, 0, 0, 0); // set time to 00:00:00
    // Get all the cards
    const cards = document.querySelectorAll(cardSelector);

    cards.forEach(function (card) {
        // Get the card date
        var cardStr = card.querySelector(".end-date").textContent;
        var cardDate = new Date(Date.parse(cardStr));
        cardDate.setHours(0, 0, 0, 0); // set time to 00:00:00
        //console.log(searchDate);
        if (cardDate.getTime() === searchDate.getTime()) {
            card.style.display = "";
        } else if (searchDate == null || searchDate == "" || isNaN(searchDate)) {
            card.style.display = "";
        } else {
            card.style.display = "none";
        }
    });
}


//we arent using this as there arent security issues that could arise
function validatefilterData(input) {
    input = sanitizeInput(input);
    return input;
}