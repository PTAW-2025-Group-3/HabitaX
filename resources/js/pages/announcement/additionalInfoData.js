import $ from 'jquery';

const additionalInfoData = {
  areas: {
    usable: [30, 40, 50, 60, 70, 80, 100, 120, 150, 200],
    gross: [50, 60, 80, 100, 130, 160, 200, 250],
    land: [100, 200, 500, 1000, 2000, 5000]
  },
  constructionYears: Array.from({ length: 70 }, (_, i) => 2024 - i), // from 2024 to 1955
  roomCounts: [1, 2, 3, 4, 5, 6],
  bathroomCounts: [1, 2, 3, 4],
  garageSpots: [0, 1, 2, 3, 4, 5],
  features: [
    "Air Conditioning",
    "Balcony",
    "Garden",
    "Pool",
    "Solar Panels",
    "Elevator",
    "Reduced Mobility Access",
    "Garage / Parking"
  ]
};

$(document).ready(function () {
  const {
    areas,
    constructionYears,
    roomCounts,
    bathroomCounts,
    garageSpots
  } = additionalInfoData;

  // Clear all dropdowns (safe reload)
  $('#usable-area').empty().append(`<option disabled selected>Select</option>`);
  $('#gross-area').empty().append(`<option disabled selected>Select</option>`);
  $('#land-area').empty().append(`<option disabled selected>Select</option>`);
  $('#construction-year').empty().append(`<option disabled selected>Select</option>`);
  $('#rooms').empty().append(`<option disabled selected>Select</option>`);
  $('#bathrooms').empty().append(`<option disabled selected>Select</option>`);
  $('#garage').empty().append(`<option disabled selected>Select</option>`);

  // Fill with values
  areas.usable.forEach(v => $('#usable-area').append(`<option value="${v}">${v} m²</option>`));
  areas.gross.forEach(v => $('#gross-area').append(`<option value="${v}">${v} m²</option>`));
  areas.land.forEach(v => $('#land-area').append(`<option value="${v}">${v} m²</option>`));
  constructionYears.forEach(y => $('#construction-year').append(`<option value="${y}">${y}</option>`));
  roomCounts.forEach(r => $('#rooms').append(`<option value="${r}">${r}</option>`));
  bathroomCounts.forEach(b => $('#bathrooms').append(`<option value="${b}">${b}</option>`));
  garageSpots.forEach(g => $('#garage').append(`<option value="${g}">${g}</option>`));

  console.log('Additional info populated successfully!');
});
