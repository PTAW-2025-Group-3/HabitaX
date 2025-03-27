const fakeData = {
  comprar: {
    moradias: [
      'Lisboa - 23', 'Porto - 12', 'Faro - 8', 'Braga - 6', 'Setúbal - 4',
      'Coimbra - 7', 'Leiria - 10', 'Santarém - 5', 'Beja - 9', 'Évora - 11',
      'Castelo Branco - 6', 'Viseu - 7', 'Guarda - 3', 'Almada - 8', 'Barreiro - 4'
    ],
    apartamentos: [
      'Lisboa - 78', 'Porto - 60', 'Aveiro - 32', 'Évora - 14', 'Bragança - 9',
      'Viana do Castelo - 11', 'Cascais - 15', 'Almada - 13', 'Seixal - 10', 'Sintra - 17',
      'Leiria - 12', 'Funchal - 7', 'Lagos - 6', 'Oeiras - 14'
    ],
    escritorios: [
      'Lisboa - 9', 'Porto - 7', 'Coimbra - 5', 'Funchal - 3', 'Aveiro - 4',
      'Braga - 6', 'Almada - 2', 'Sintra - 1', 'Setúbal - 3', 'Guarda - 2'
    ],
    lojas: [
      'Braga - 6', 'Setúbal - 4', 'Cascais - 3', 'Madeira - 2', 'Almada - 5',
      'Lisboa - 7', 'Porto - 6', 'Viseu - 3', 'Faro - 4', 'Beja - 2'
    ],
    predios: [
      'Lisboa - 5', 'Viseu - 3', 'Guarda - 2', 'Castelo Branco - 4', 'Braga - 3',
      'Setúbal - 2', 'Aveiro - 2', 'Porto - 1'
    ],
    quartos: [
      'Lisboa - 40', 'Porto - 25', 'Funchal - 12', 'Nazaré - 7', 'Évora - 6',
      'Aveiro - 10', 'Coimbra - 9', 'Cascais - 8', 'Guarda - 5', 'Beja - 6'
    ]
  },
  arrendar: {
    moradias: [
      'Algarve - 33', 'Madeira - 17', 'Beja - 6', 'Setúbal - 9', 'Castelo Branco - 4',
      'Portalegre - 7', 'Lisboa - 15', 'Porto - 11', 'Braga - 5', 'Évora - 6'
    ],
    apartamentos: [
      'Lisboa - 90', 'Porto - 77', 'Guarda - 15', 'Coimbra - 20', 'Leiria - 13',
      'Faro - 22', 'Almada - 14', 'Setúbal - 18', 'Odivelas - 12', 'Cascais - 19',
      'Barreiro - 10', 'Aveiro - 16'
    ],
    escritorios: [
      'Porto - 4', 'Lisboa - 8', 'Aveiro - 5', 'Braga - 2', 'Coimbra - 3',
      'Setúbal - 4', 'Beja - 1', 'Funchal - 2', 'Leiria - 3'
    ],
    lojas: [
      'Aveiro - 10', 'Braga - 7', 'Lisboa - 5', 'Faro - 4', 'Évora - 3',
      'Beja - 2', 'Guarda - 3', 'Cascais - 5', 'Oeiras - 4', 'Setúbal - 3'
    ],
    predios: [
      'Lisboa - 1', 'Porto - 2', 'Cascais - 2', 'Viseu - 1', 'Setúbal - 1',
      'Coimbra - 1', 'Funchal - 1'
    ],
    quartos: [
      'Lisboa - 18', 'Coimbra - 9', 'Porto - 5', 'Santarém - 6', 'Guarda - 4',
      'Beja - 3', 'Funchal - 7', 'Setúbal - 4', 'Odivelas - 5', 'Faro - 6'
    ]
  }
};
  
  function renderDistricts(type = 'comprar', category = 'moradias') {
    const items = fakeData[type][category];
    const html = items.map(item => `
      <div class="bg-white rounded-lg shadow px-4 py-3 hover:bg-indigo-50 transition">
        ${item}
      </div>
    `).join('');
    $('#district-content').html(html);
  }
  
  $(document).ready(function () {
    // Initial Render
    renderDistricts();
  
    // Top Tab Switch
    $('.top-tab').click(function () {
      $('.top-tab').removeClass('active border-indigo-500 text-indigo-600').addClass('text-gray-700');
      $(this).addClass('border-indigo-500 text-indigo-600');
      const type = $(this).data('type');
      const category = $('.second-tab.active').data('category') || 'moradias';
      renderDistricts(type, category);
    });
  
    // Second Tab Switch
    $('.second-tab').click(function () {
      $('.second-tab').removeClass('bg-indigo-100 text-indigo-700 active').addClass('bg-white');
      $(this).addClass('bg-indigo-100 text-indigo-700 active');
      const category = $(this).data('category');
      const type = $('.top-tab.text-indigo-600').data('type') || 'comprar';
      renderDistricts(type, category);
    });
  
    // Default Select
    $('.second-tab[data-category="moradias"]').addClass('active bg-indigo-100 text-indigo-700');
  });
  