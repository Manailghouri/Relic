// Roha to laiba manail : ONLY INCLUDE GET, POST FUNCTIONS FOR NOW


// sendquery is a function that will be called when the html form button is clicked
// (the main html form button will be handled by a separate js, lets just figure that out later)

// SendQuery is responsible for accepting the form data (a search query)
// and then calling get-data.php. Waiting for a response and then showing the search results back
// get-data.php will talk to the db and fetch the data then return it back to this js function here
// example-flow: form button pressed -> sendquery called -> sendquery calls get-data.php -> and then send some validation back to the user

// test whether the js script is properly loaded


function sendQuery(query) {
    // testing if sendquery was called
    console.log('sendQuery() called')

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