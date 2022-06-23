

const apiBtn = document.querySelector('.api__btn');

const quoteTextRandom = document.querySelector('.random__quote--text');
const quoteAuthorRandom = document.querySelector('.random__quote--author');


apiBtn.addEventListener('click', getQuote);


function getQuote() {
    console.log("Działam");
    const url = "https://quote-garden.herokuapp.com/api/v3/quotes/random"


fetch(url)
	.then(response => response.json())
	.then(data => {

        const [ myQuote ] = data.data;
        return myQuote;
    })
    .then(myQuote => {
        const { quoteText, quoteAuthor } = myQuote;
        quoteTextRandom.textContent =quoteText;
        quoteAuthorRandom.textContent = quoteAuthor;

    }
    )
}




// getQuote();

