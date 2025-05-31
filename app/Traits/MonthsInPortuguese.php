<?php

namespace App\Traits;

trait MonthsInPortuguese
{
    /**
     * Retorna array com abreviações dos meses em português
     *
     * @return array
     */
    protected function getPortugueseMonths(): array
    {
        return [
            1 => 'Jan', 2 => 'Fev', 3 => 'Mar',
            4 => 'Abr', 5 => 'Mai', 6 => 'Jun',
            7 => 'Jul', 8 => 'Ago', 9 => 'Set',
            10 => 'Out', 11 => 'Nov', 12 => 'Dez'
        ];
    }

    /**
     * Gera rótulos de meses em português para os últimos N meses
     *
     * @param int $numberOfMonths
     * @return array
     */
    protected function generateMonthLabels(int $numberOfMonths = 6): array
    {
        $ptMonths = $this->getPortugueseMonths();
        $monthLabels = [];

        $startDate = now()->startOfMonth();

        for ($i = $numberOfMonths - 1; $i >= 0; $i--) {
            $date = clone $startDate;
            $date = $date->subMonths($i);
            $monthLabels[] = $ptMonths[$date->month];
        }

        return $monthLabels;
    }
}
