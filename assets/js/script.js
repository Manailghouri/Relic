
// Roha to laiba manail : ONLY INCLUDE GET, POST FUNCTIONS FOR NOW


// searchHistoricalNews is a function that will be called when the html form button is clicked
// (the main html form button will be handled by a separate js, lets just figure that out later)

// searchHistoricalNews is responsible for accepting the form data (a search query)
// and then calling get-data.php. Waiting for a response and then showing the search results back
// get-data.php will talk to the db and fetch the data then return it back to this js function here
// example-flow: form button pressed -> searchHistoricalNews called -> searchHistoricalNews calls get-data.php -> and then send some validation back to the user

// test whether the js script is properly loaded

// the first thing to run after the page is loaded;
// would be to connect to the db
// this function below will directly run the db.php function to connect to the database
// optionally i think that php should return the $conn object, so that it may be used by
// other funcitons in the file (to reduce the number of times db.php is called)

document.addEventListener('DOMContentLoaded', () => {
    fetch('db.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'connected') {
                console.log("✅ DB connection successful!");
                // You can now call other functions that assume DB is connected
            } else {
                console.error("DB connection failed:", data.message);
            }
        })
        .catch(err => {
            console.error("Could not reach db.php:", err);
        });
});


function searchHistoricalNews(query) {
    // testing if searchHistoricalNews was called
    console.log('searchHistoricalNews() called')

    query = 'gahhoaiwhdoa'
    fetch('../api/get-data.php', {
        method: 'POST',
        headers: {
            'Content-Type' : 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            query: query
        })
    })
    .then(response => response.text())
    .then(data=> {
        console.log('PHP Response', data)
    })
}