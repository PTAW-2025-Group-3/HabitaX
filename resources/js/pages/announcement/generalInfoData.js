import $ from 'jquery';

const dadosInformacaoGeral = {
    tipologias: [
        "T0", "T1", "T2", "T3", "T4", "T5", "T6 ou mais",
        "Estúdio", "Loft", "Open Space"
    ],
    estadosConservacao: [
        "Novo",
        "Renovado",
        "Usado",
        "Por Renovar",
        "Em Construção"
    ],
    certificacoesEnergeticas: [
        "A+", "A", "B", "C", "D", "E", "F", "G", "Isento"
    ]
};

$(document).ready(function () {
    const {
        tiposPropriedade,
        tipologias,
        estadosConservacao,
        certificacoesEnergeticas
    } = dadosInformacaoGeral;

    // Limpar e definir opções iniciais
    $('#typology').empty().append('<option disabled selected>Seleciona a tipologia</option>');
    $('#condition').empty().append('<option disabled selected>Seleciona o estado</option>');
    $('#energy-certification').empty().append('<option disabled selected>Seleciona a certificação</option>');


    tipologias.forEach(tipologia =>
        $('#typology').append(`<option value="${tipologia}">${tipologia}</option>`)
    );
    estadosConservacao.forEach(estado =>
        $('#condition').append(`<option value="${estado}">${estado}</option>`)
    );
    certificacoesEnergeticas.forEach(cert =>
        $('#energy-certification').append(`<option value="${cert}">${cert}</option>`)
    );

    console.log('✅ Informação geral carregada com sucesso!');
});
