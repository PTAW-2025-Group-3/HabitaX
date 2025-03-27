// const locationData = {
//     "Aveiro": {
//       "Águeda": ["Águeda Centro", "Barrô", "Fermentelos", "Valongo do Vouga", "Recardães"],
//       "Anadia": ["Sangalhos", "Moita", "Tamengos", "Arcos", "Avelãs de Caminho"]
//     },
//     "Lisboa": {
//       "Lisboa": ["Alvalade", "Belém", "Campolide", "Lumiar", "Olivais", "Marvila"],
//       "Sintra": ["Queluz", "Cacém", "Massamá", "Rio de Mouro", "Agualva"]
//     },
//     "Porto": {
//       "Porto": ["Boavista", "Bonfim", "Foz do Douro", "Paranhos", "Lordelo do Ouro"],
//       "Vila Nova de Gaia": ["Canidelo", "Oliveira do Douro", "Mafamude", "Avintes", "Canelas"]
//     },
//     "Braga": {
//       "Braga": ["Sé", "Maximinos", "Real", "Ferreiros", "São Vicente"],
//       "Guimarães": ["Azurém", "Creixomil", "Urgezes", "Costa", "Candoso"]
//     },
//     "Coimbra": {
//       "Coimbra": ["Santa Cruz", "Sé Nova", "Santo António dos Olivais", "Eiras", "Brasfemes"],
//       "Figueira da Foz": ["Buarcos", "São Pedro", "Tavarede", "Maiorca", "Ferreira-a-Nova"]
//     },
//     "Faro": {
//       "Faro": ["Sé", "Montenegro", "Conceição", "Santa Bárbara de Nexe", "Estoi"],
//       "Loulé": ["Quarteira", "Almancil", "Boliqueime", "Salir", "Tôr"]
//     },
//     "Setúbal": {
//       "Setúbal": ["São Sebastião", "Nossa Senhora da Anunciada", "São Julião", "Sado", "Gâmbia"],
//       "Almada": ["Cova da Piedade", "Feijó", "Costa da Caparica", "Pragal", "Charneca de Caparica"]
//     },
//     "Leiria": {
//       "Leiria": ["Marrazes", "Pousos", "Barreira", "Parceiros", "Monte Real"],
//       "Pombal": ["Carnide", "Almagreira", "Vermoil", "Meirinhas", "Redinha"]
//     },
//     "Madeira": {
//       "Funchal": ["São Pedro", "Santa Maria Maior", "Monte", "São Roque", "Imaculado Coração de Maria"],
//       "Câmara de Lobos": ["Estreito", "Curral das Freiras", "Jardim da Serra", "Quinta Grande"]
//     },
//     "Azores": {
//       "Ponta Delgada": ["São Pedro", "Fajã de Cima", "Fajã de Baixo", "Relva", "Rosto do Cão"],
//       "Angra do Heroísmo": ["São Bento", "Santa Luzia", "Posto Santo", "São Pedro"]
//     },
//     "Viseu": {
//       "Viseu": ["Coração de Jesus", "Ranhados", "Abraveses", "Repeses", "Lordosa"],
//       "Tondela": ["Campo de Besteiros", "Molelos", "Lajeosa do Dão", "Vilar de Besteiros"]
//     },
//     "Beja": {
//       "Beja": ["Santiago Maior", "Salvador", "Nossa Senhora das Neves"],
//       "Serpa": ["Brinches", "Vila Nova de São Bento", "Pias"]
//     },
//     "Évora": {
//       "Évora": ["Malagueira", "Horta das Figueiras", "Bacelo", "São Mamede"],
//       "Montemor-o-Novo": ["Cabrela", "São Cristóvão", "Foros de Vale Figueira"]
//     },
//     "Castelo Branco": {
//       "Castelo Branco": ["Salgueiro do Campo", "Benquerença", "Louriçal do Campo"],
//       "Covilhã": ["Tortosendo", "Teixoso", "Canhoso"]
//     },
//     "Algarve": {
//       "Lagos": ["Sagres", "Bensafrim", "Luz", "Odiáxere"],
//       "Albufeira": ["Olhos de Água", "Ferreiras", "Guia"]
//     }
//   };  
//   $(document).ready(function () {
//     const $district = $('#district');
//     const $municipality = $('#municipality');
//     const $parish = $('#parish');
  
//     $district.append(
//       Object.keys(locationData).map(d => `<option value="${d}">${d}</option>`)
//     );

//     $district.on('change', function () {
//       const selectedDistrict = $(this).val();
//       $municipality.empty().append(`<option value="">Select Municipality</option>`);
//       $parish.empty().append(`<option value="">Select Parish</option>`);
  
//       if (selectedDistrict && locationData[selectedDistrict]) {
//         const municipalities = Object.keys(locationData[selectedDistrict]);
//         municipalities.forEach(muni => {
//           $municipality.append(`<option value="${muni}">${muni}</option>`);
//         });
//       }
//     });

//     $municipality.on('change', function () {
//       const selectedDistrict = $district.val();
//       const selectedMunicipality = $(this).val();
//       $parish.empty().append(`<option value="">Select Parish</option>`);
  
//       if (
//         selectedDistrict &&
//         selectedMunicipality &&
//         locationData[selectedDistrict][selectedMunicipality]
//       ) {
//         const parishes = locationData[selectedDistrict][selectedMunicipality];
//         parishes.forEach(p => {
//           $parish.append(`<option value="${p}">${p}</option>`);
//         });
//       }
//     });
//   });
//============================================================================================================
import $ from 'jquery';

const locationData = {
    "Aveiro": {
      "Águeda": ["Águeda Centro", "Barrô", "Fermentelos", "Valongo do Vouga", "Recardães"],
      "Anadia": ["Sangalhos", "Moita", "Tamengos", "Arcos", "Avelãs de Caminho"]
    },
    "Lisboa": {
      "Lisboa": ["Alvalade", "Belém", "Campolide", "Lumiar", "Olivais", "Marvila"],
      "Sintra": ["Queluz", "Cacém", "Massamá", "Rio de Mouro", "Agualva"]
    },
    "Porto": {
      "Porto": ["Boavista", "Bonfim", "Foz do Douro", "Paranhos", "Lordelo do Ouro"],
      "Vila Nova de Gaia": ["Canidelo", "Oliveira do Douro", "Mafamude", "Avintes", "Canelas"]
    },
    "Braga": {
      "Braga": ["Sé", "Maximinos", "Real", "Ferreiros", "São Vicente"],
      "Guimarães": ["Azurém", "Creixomil", "Urgezes", "Costa", "Candoso"]
    },
    "Coimbra": {
      "Coimbra": ["Santa Cruz", "Sé Nova", "Santo António dos Olivais", "Eiras", "Brasfemes"],
      "Figueira da Foz": ["Buarcos", "São Pedro", "Tavarede", "Maiorca", "Ferreira-a-Nova"]
    },
    "Faro": {
      "Faro": ["Sé", "Montenegro", "Conceição", "Santa Bárbara de Nexe", "Estoi"],
      "Loulé": ["Quarteira", "Almancil", "Boliqueime", "Salir", "Tôr"]
    },
    "Setúbal": {
      "Setúbal": ["São Sebastião", "Nossa Senhora da Anunciada", "São Julião", "Sado", "Gâmbia"],
      "Almada": ["Cova da Piedade", "Feijó", "Costa da Caparica", "Pragal", "Charneca de Caparica"]
    },
    "Leiria": {
      "Leiria": ["Marrazes", "Pousos", "Barreira", "Parceiros", "Monte Real"],
      "Pombal": ["Carnide", "Almagreira", "Vermoil", "Meirinhas", "Redinha"]
    },
    "Madeira": {
      "Funchal": ["São Pedro", "Santa Maria Maior", "Monte", "São Roque", "Imaculado Coração de Maria"],
      "Câmara de Lobos": ["Estreito", "Curral das Freiras", "Jardim da Serra", "Quinta Grande"]
    },
    "Azores": {
      "Ponta Delgada": ["São Pedro", "Fajã de Cima", "Fajã de Baixo", "Relva", "Rosto do Cão"],
      "Angra do Heroísmo": ["São Bento", "Santa Luzia", "Posto Santo", "São Pedro"]
    },
    "Viseu": {
      "Viseu": ["Coração de Jesus", "Ranhados", "Abraveses", "Repeses", "Lordosa"],
      "Tondela": ["Campo de Besteiros", "Molelos", "Lajeosa do Dão", "Vilar de Besteiros"]
    },
    "Beja": {
      "Beja": ["Santiago Maior", "Salvador", "Nossa Senhora das Neves"],
      "Serpa": ["Brinches", "Vila Nova de São Bento", "Pias"]
    },
    "Évora": {
      "Évora": ["Malagueira", "Horta das Figueiras", "Bacelo", "São Mamede"],
      "Montemor-o-Novo": ["Cabrela", "São Cristóvão", "Foros de Vale Figueira"]
    },
    "Castelo Branco": {
      "Castelo Branco": ["Salgueiro do Campo", "Benquerença", "Louriçal do Campo"],
      "Covilhã": ["Tortosendo", "Teixoso", "Canhoso"]
    },
    "Algarve": {
      "Lagos": ["Sagres", "Bensafrim", "Luz", "Odiáxere"],
      "Albufeira": ["Olhos de Água", "Ferreiras", "Guia"]
    }
  };  
$(document).ready(function () {
  const $district = $('#district');
  const $municipality = $('#municipality');
  const $parish = $('#parish');

  // Populate districts
  Object.keys(locationData).forEach(d => {
    $district.append(`<option value="${d}">${d}</option>`);
  });

  // District changed
  $district.on('change', function () {
    const selectedDistrict = $(this).val();
    $municipality.empty().append('<option value="">Select Municipality</option>');
    $parish.empty().append('<option value="">Select Parish</option>');

    if (selectedDistrict && locationData[selectedDistrict]) {
      Object.keys(locationData[selectedDistrict]).forEach(muni => {
        $municipality.append(`<option value="${muni}">${muni}</option>`);
      });
    }
  });

  // Municipality changed
  $municipality.on('change', function () {
    const selectedDistrict = $district.val();
    const selectedMunicipality = $(this).val();
    $parish.empty().append('<option value="">Select Parish</option>');

    if (
      selectedDistrict &&
      selectedMunicipality &&
      locationData[selectedDistrict][selectedMunicipality]
    ) {
      locationData[selectedDistrict][selectedMunicipality].forEach(parish => {
        $parish.append(`<option value="${parish}">${parish}</option>`);
      });
    }
  });
});
