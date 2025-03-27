import $ from 'jquery';

const generalInfoData = {
  propertyTypes: [
    "Apartment",
    "House",
    "Land",
    "Warehouse",
    "Commercial Space",
    "Garage",
    "Farm",
    "Office",
    "Rural Property"
  ],
  typologies: [
    "T0", "T1", "T2", "T3", "T4", "T5", "T6 or more",
    "Studio", "Loft", "Open Space"
  ],
  conditions: [
    "New",
    "Renovated",
    "Used",
    "To Renovate",
    "Under Construction"
  ],
  energyCertifications: [
    "A+", "A", "B", "C", "D", "E", "F", "G", "Exempt"
  ]
};

$(document).ready(function () {
  const {
    propertyTypes,
    typologies,
    conditions,
    energyCertifications
  } = generalInfoData;

  $('#property-type').empty().append('<option disabled selected>Select Property Type</option>');
  $('#typology').empty().append('<option disabled selected>Select Typology</option>');
  $('#condition').empty().append('<option disabled selected>Select Condition</option>');
  $('#energy-certification').empty().append('<option disabled selected>Select Certification</option>');

  propertyTypes.forEach(type =>
    $('#property-type').append(`<option value="${type}">${type}</option>`)
  );
  typologies.forEach(typology =>
    $('#typology').append(`<option value="${typology}">${typology}</option>`)
  );
  conditions.forEach(cond =>
    $('#condition').append(`<option value="${cond}">${cond}</option>`)
  );
  energyCertifications.forEach(cert =>
    $('#energy-certification').append(`<option value="${cert}">${cert}</option>`)
  );

  console.log('✅ General info populated successfully');
});
