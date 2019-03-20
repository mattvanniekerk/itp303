// Configure API
const CONFIG = {
    API_BASEURL: "http://api.weatherbit.io/v2.0/current",
    API_KEY: "355e1f12ad3a4472bce1bf400573e4e5"
}

// Get weather for Los Angeles on page load
getWeather("1705545");

// Get weather for specified city_id
function getWeather(city_id, key=CONFIG.API_KEY) {
    let endpoint = CONFIG.API_BASEURL;
    let data = {
        lang: "en",
        key: key,
        units: "I",
        city_id: city_id
    };
    
    $.ajax({
        url: endpoint,
        data: data
    }).done(function(data) {
        displayResults(data);
    }).fail(function() {
        alert("Error: Failed to load weather.");
    });
}

// Display results from API call
function displayResults(results) {
    let data = results.data[0];
    $("div#weather span.temp").text(data.temp);
    $("div#weather span.weather-description").text(data.weather.description);
    $("div#weather span.app_temp").text(data.app_temp);
}

// Update weather on change of city selection 
$("select#city").change(function() {
    let city_id = $(this).children("option:selected").val();
    getWeather(city_id);
});
