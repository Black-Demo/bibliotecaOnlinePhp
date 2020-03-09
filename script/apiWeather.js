let apiKey = "2jEGFyZkRss7W6zZRaYIHBh6tzsY6Jhj";
let language = "en-us";
let cityKey;

function searchCity() {
  let city = $(".cityWeather").val();
  fetch(
    "http://dataservice.accuweather.com/locations/v1/cities/search?apikey=" +
      apiKey +
      "&q=" +
      city +
      "&language=" +
      language +
      "HTTP/1.1",
    {
      method: "GET"
    }
  )
    .then(res => res.json())
    .then(city => {
      cityKey = city[0].Key;
      fetch(
        "http://dataservice.accuweather.com/currentconditions/v1/" +
          cityKey +
          "?apikey=" +
          apiKey +
          "&language=" +
          language
      )
        .then(res => res.json())
        .then(condition => {
          createTablaClima(
            condition[0].WeatherText,
            condition[0].WeatherIcon,
            condition[0].HasPrecipitation,
            condition[0].PrecipitationType,
            condition[0].Temperature.Metric.Value
          );
        });
    });
}

function createTablaClima(text, icon, precipitation, typePrecip, temperature) {
  $(".weather").empty();
  if (icon < 10) icon = "0" + icon;
  let iconoLogo =
    "https://developer.accuweather.com/sites/default/files/" + icon + "-s.png";
  let div = document.createElement("div");
  $(div)
    .addClass("today")
    .append([
      $(document.createElement("img")).attr({
        src: iconoLogo,
        heigth: "150px",
        width: "150px"
      }),
      $(document.createElement("h2"))
        .attr({
          class: "wheather-res"
        })
        .text(text),
      $(document.createElement("h4"))
        .attr({
          class: "temperature"
        })
        .text(temperature + "ºC")
    ]);

  $(".res").append(div);
  console.log(
    text +
      " " +
      icon +
      " " +
      precipitation +
      " " +
      typePrecip +
      " " +
      temperature
  );
}
