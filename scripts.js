

const apiBtn = document.querySelector('.api__btn');



window.addEventListener('DOMContentLoaded', getQuote());


const quoteTextRandom = document.querySelector('.random__quote--text');
const quoteAuthorRandom = document.querySelector('.random__quote--author');


function getQuote() {
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
    .catch(error => {
        quoteTextRandom.textContent = "Przepraszamy, brak połączenia z zewnętrznym API";
        console.log(error);
    })
}




// getQuote();

