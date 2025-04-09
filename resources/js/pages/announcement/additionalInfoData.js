import $ from 'jquery';

const dadosInformacaoAdicional = {
    areas: {
        util: [30, 40, 50, 60, 70, 80, 100, 120, 150, 200],
        bruta: [50, 60, 80, 100, 130, 160, 200, 250],
        terreno: [100, 200, 500, 1000, 2000, 5000]
    },
    anosConstrucao: Array.from({ length: 70 }, (_, i) => 2024 - i), // de 2024 até 1955
    numeroQuartos: [1, 2, 3, 4, 5, 6],
    numeroCasasBanho: [1, 2, 3, 4],
    lugaresGaragem: [0, 1, 2, 3, 4, 5],
    caracteristicas: [
        "Ar Condicionado",
        "Varanda",
        "Jardim",
        "Piscina",
        "Painéis Solares",
        "Elevador",
        "Acesso para Mobilidade Reduzida",
        "Garagem / Estacionamento"
    ]
};

$(document).ready(function () {
    const {
        areas,
        anosConstrucao,
        numeroQuartos,
        numeroCasasBanho,
        lugaresGaragem
    } = dadosInformacaoAdicional;

    // Limpar todos os dropdowns (seguro para recarregamento)
    $('#usable-area').empty().append(`<option disabled selected>Selecionar</option>`);
    $('#gross-area').empty().append(`<option disabled selected>Selecionar</option>`);
    $('#land-area').empty().append(`<option disabled selected>Selecionar</option>`);
    $('#construction-year').empty().append(`<option disabled selected>Selecionar</option>`);
    $('#rooms').empty().append(`<option disabled selected>Selecionar</option>`);
    $('#bathrooms').empty().append(`<option disabled selected>Selecionar</option>`);
    $('#garage').empty().append(`<option disabled selected>Selecionar</option>`);

    // Preencher com valores
    areas.util.forEach(v => $('#usable-area').append(`<option value="${v}">${v} m²</option>`));
    areas.bruta.forEach(v => $('#gross-area').append(`<option value="${v}">${v} m²</option>`));
    areas.terreno.forEach(v => $('#land-area').append(`<option value="${v}">${v} m²</option>`));
    anosConstrucao.forEach(y => $('#construction-year').append(`<option value="${y}">${y}</option>`));
    numeroQuartos.forEach(r => $('#rooms').append(`<option value="${r}">${r}</option>`));
    numeroCasasBanho.forEach(b => $('#bathrooms').append(`<option value="${b}">${b}</option>`));
    lugaresGaragem.forEach(g => $('#garage').append(`<option value="${g}">${g}</option>`));

    console.log('✅ Informação adicional carregada com sucesso!');
});
