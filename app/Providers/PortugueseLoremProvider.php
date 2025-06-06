<?php

namespace App\Providers;

use Faker\Provider\Base;

class PortugueseLoremProvider extends Base
{
    static $wordList = [
        'a', 'vida', 'é', 'bela', 'com', 'o', 'coração', 'cheio', 'de', 'esperança', 'e', 'sonhos', 'brilhantes',
        'o', 'mar', 'bate', 'nas', 'rochas', 'como', 'as', 'emoções', 'nos', 'dias', 'difíceis',
        'portugal', 'tem', 'história', 'cultura', 'tradição', 'e', 'um', 'futuro', 'promissor',
        'amizade', 'beleza', 'brilho', 'caminho', 'cultura', 'destino', 'espera', 'esperança', 'estrela', 'festa',
        'força', 'formiga', 'futuro', 'gente', 'gratidão', 'história', 'honesto', 'ideia', 'imaginar', 'importar',
        'inspira', 'justiça', 'luz', 'magia', 'maravilha', 'memória', 'mudança', 'natureza', 'objetivo', 'orgulho',
        'otimismo', 'palavra', 'paixão', 'paz', 'pensar', 'perdão', 'planeta', 'plano', 'poder', 'poesia',
        'presente', 'progresso', 'respeito', 'sabedoria', 'saudade', 'segredo', 'sentido', 'serenidade', 'silêncio',
        'sociedade', 'sorriso', 'tempo', 'tradição', 'tranquilo', 'união', 'valor', 'verdade', 'vibração', 'vida',
        'vitória', 'vontade', 'acontecer', 'aventura', 'benção', 'bondade', 'coração', 'crescer', 'descobrir',
        'detalhes', 'direção', 'educação', 'equilíbrio', 'esperto', 'felicidade', 'fidelidade', 'fluidez', 'foco',
        'generoso', 'gentileza', 'gratuito', 'harmonia', 'honestidade', 'humano', 'imaginação', 'importância',
        'incrível', 'início', 'inspiração', 'intuição', 'juventude', 'lealdade', 'lembrança', 'liberdade', 'lógica',
        'memórias', 'mensagem', 'momentos', 'motivação', 'mudanças', 'natural', 'nobreza', 'objetivos', 'oportunidade',
        'otimismo', 'paciência', 'parceria', 'perfeição', 'persistência', 'plenitude', 'preceito', 'propósito',
        'qualidade', 'razão', 'recomeço', 'reflexão', 'relacionar', 'resiliência', 'responsável', 'sabedoria',
        'satisfação', 'sensação', 'sentimento', 'simplicidade', 'solidariedade', 'sonhador', 'superar', 'talento',
        'totalitarismo', 'transformar', 'transparente', 'vibrante', 'vigilante', 'virtude', 'voluntário', 'zelo',
        'realidade', 'entusiasmo', 'visão', 'conhecimento', 'coragem', 'resgate', 'justo', 'honra', 'ética',
        'clareza', 'preciso', 'beleza', 'carinho', 'melhorar', 'princípio', 'momento', 'amizades', 'relação',
        'orientação', 'recompensa', 'colaboração', 'acolhimento', 'respeitado', 'merecimento', 'progresso',
        'compromisso', 'prosperidade', 'espiritual', 'constante', 'conquista', 'organizado', 'curiosidade',
        'transição', 'estrutura', 'realizar', 'participar', 'bravura', 'dedicação', 'iniciativa', 'determinação',
        'realização', 'objetividade', 'preparo', 'nobre', 'sabedor', 'vislumbre', 'equidade', 'disposição',
        'eficaz', 'justiça', 'seriedade', 'amizades', 'gentil', 'comunhão', 'trabalho', 'dedicado', 'diálogo',
        'desejo', 'disciplina', 'inspirações', 'construção', 'desempenho', 'sabedoria', 'atitude', 'visibilidade',
        'respeitável', 'acolhedor', 'colaborador', 'aprendizagem', 'responsabilidade', 'consciência', 'harmonioso',
        'integridade', 'libertação', 'significado', 'desenvolver', 'planeamento', 'acolhedora', 'transparência',
        'compreensão', 'respeitador', 'objetividade', 'solidário', 'honestamente', 'transformação', 'motivacional',
        'aperfeiçoar', 'colaboração', 'eficiência', 'gentilezas', 'persistente', 'interligação',
        'expressão', 'resolução', 'relevante', 'estabilidade', 'progresso', 'persistir', 'liderança', 'influência',
        'maturidade', 'consistência', 'planeador', 'potencial', 'criatividade', 'dinamismo', 'estímulo',
        'autenticidade', 'vislumbrar', 'relacionamento', 'despertar', 'consagração', 'estratégia', 'aperfeiçoamento',
        'preparação', 'experimentar', 'orientador', 'valorizar', 'crescimento', 'participativo', 'gestão',
        'transmissão', 'colaboração', 'espontâneo', 'enriquecedor', 'construir', 'realizador', 'ajudante',
        'profundidade', 'machista', 'compaixão', 'valentia', 'devotado', 'benevolência', 'proteger',
        'comprometido', 'avaliador', 'acolhedor', 'inclusivo', 'merecedor', 'refinado', 'responsivo', 'resoluto',
        'ponderado', 'grandeza', 'confiança', 'dinamizar', 'diligente', 'empenhado', 'reflexivo', 'efetivo',
        'protagonista', 'orientado', 'sensível', 'constanteza', 'valorização', 'aprofundar', 'respeitoso',
        'resplandecer', 'saboreado', 'organização', 'capacidade', 'acolhedora', 'recetividade', 'confiante',
        'preservar', 'iluminar', 'planear', 'renascer', 'fortaleza', 'resiliência', 'verticalidade', 'recompensar',
        'dá', 'foi', 'vai', 'vem', 'nos', 'lhe', 'lhe', 'lhe', 'pra', 'põe', 'sem', 'num', 'numa', 'dos',
        'das', 'uns', 'nas', 'sob', 'por', 'mas', 'nem', 'sim', 'até', 'ora', 'lhe', 'tua', 'sou', 'ser',
        'tem', 'faz', 'lhe', 'já', 'vou', 'lhe', 'lhe', 'lhe', 'era', 'era', 'era', 'lhe', 'lhe', 'lhe',
        'num', 'numa', 'dum', 'duma', 'aos', 'das', 'com', 'sem', 'lhe', 'pelo', 'pela', 'tão', 'bem',
        'mal', 'só', 'tua', 'meu', 'minha', 'nosso', 'dele', 'dela', 'seu', 'seus', 'esta', 'isto', 'isso',
        'aí', 'ali', 'cá', 'lá', 'vai', 'vou', 'vem', 'tem', 'há', 'diz', 'faz', 'era', 'ser', 'sou', 'lhe',
        'lá', 'já', 'ou', 'eis', 'nem', 'mas', 'por', 'sem', 'sob', 'com', 'nos', 'lhe', 'vai', 'vou', 'vim',
        'viu', 'via', 'ver', 'lhe', 'lhe', 'lhe', 'têm', 'tem', 'era', 'sou', 'está', 'está', 'estás', 'fui',
        // ... adicione mais palavras reais
    ];

    public function word()
    {
        return static::randomElement(static::$wordList);
    }

    public function words($nb = 3, $asText = false)
    {
        $words = [];

        for ($i = 0; $i < $nb; $i++) {
            $words[] = static::randomElement(static::$wordList);
        }

        return $asText ? implode(' ', $words) : $words;
    }

    public function sentence($nbWords = 6, $variableNbWords = true)
    {
        if ($variableNbWords) {
            $nbWords = $nbWords + static::numberBetween(-2, 2);
            $nbWords = max(1, $nbWords);
        }

        return ucfirst(implode(' ', $this->words($nbWords))) . '.';
    }

    public function paragraph($nbSentences = 3, $variableNbSentences = true)
    {
        if ($variableNbSentences) {
            $nbSentences = $nbSentences + static::numberBetween(-1, 1);
            $nbSentences = max(1, $nbSentences);
        }

        $sentences = [];

        for ($i = 0; $i < $nbSentences; $i++) {
            $sentences[] = $this->sentence();
        }

        return implode(' ', $sentences);
    }

    public function text($maxNbChars = 200)
    {
        $text = '';

        while (mb_strlen($text, 'UTF-8') < $maxNbChars) {
            $text .= ' ' . $this->paragraph(2);
        }

        $text = trim($text);

        // Trim last word if it exceeds limit
        if (mb_strlen($text, 'UTF-8') > $maxNbChars) {
            $text = mb_substr($text, 0, $maxNbChars, 'UTF-8');
            // Ensure no cut in the middle of a word
            $lastSpace = mb_strrpos($text, ' ', 0, 'UTF-8');
            if ($lastSpace !== false) {
                $text = mb_substr($text, 0, $lastSpace, 'UTF-8');
            }
        }

        return $text;
    }

    public function realText($targetLength = 300)
    {
        $output = '';

        while (mb_strlen($output, 'UTF-8') < $targetLength) {
            $output .= ' ' . $this->paragraph(static::numberBetween(2, 4));
        }

        $output = trim($output);

        if (mb_strlen($output, 'UTF-8') > $targetLength) {
            $output = mb_substr($output, 0, $targetLength, 'UTF-8');
            $lastPunctuation = max(
                mb_strrpos($output, '.', 0, 'UTF-8'),
                mb_strrpos($output, '!', 0, 'UTF-8'),
                mb_strrpos($output, '?', 0, 'UTF-8')
            );

            if ($lastPunctuation !== false) {
                $output = mb_substr($output, 0, $lastPunctuation + 1, 'UTF-8');
            }
        }

        return $output;
    }
}
