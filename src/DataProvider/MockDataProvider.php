<?php

declare(strict_types=1);

namespace Csaba\SalesApi\DataProvider;

use Csaba\SalesApi\DTO\ListDTO;
use Csaba\SalesApi\DTO\ListFormDTO;

final class MockDataProvider implements ListDataProviderInterface
{
    private const LISTS = [
        ['id' => '21849', 'name' => 'PiacepitoRendszerReg', 'size' => 428, 'created_at' => '2024-01-09'],
        ['id' => '10042', 'name' => 'Hirlevel-feliratkozok', 'size' => 1321, 'created_at' => '2023-11-15'],
        ['id' => '33571', 'name' => 'VIP-ugyfelek', 'size' => 97, 'created_at' => '2024-02-20'],
        ['id' => '47820', 'name' => 'Potencialis-ugyfelek', 'size' => 764, 'created_at' => '2024-03-02'],
        ['id' => '55193', 'name' => 'Demo-kerelmezok', 'size' => 153, 'created_at' => '2024-03-19'],
        ['id' => '62784', 'name' => 'Inaktiv-ugyfelek', 'size' => 2150, 'created_at' => '2023-07-11'],
        ['id' => '71356', 'name' => 'Partnerprogramm-tagok', 'size' => 311, 'created_at' => '2024-04-01'],
        ['id' => '83902', 'name' => 'Webinar-resztvevok', 'size' => 540, 'created_at' => '2024-01-27'],
        ['id' => '91274', 'name' => 'Hideg-leads', 'size' => 2890, 'created_at' => '2022-12-18'],
        ['id' => '10583', 'name' => 'Meleg-leads', 'size' => 601, 'created_at' => '2024-04-10'],
        ['id' => '11947', 'name' => 'Konverzio-alatt', 'size' => 244, 'created_at' => '2024-02-01'],
        ['id' => '12638', 'name' => 'Onboarding-folyamatban', 'size' => 178, 'created_at' => '2024-01-03'],
        ['id' => '13725', 'name' => 'Visszajelzes-varok', 'size' => 88, 'created_at' => '2024-03-25'],
        ['id' => '14816', 'name' => 'Megujito-ugyfelek', 'size' => 356, 'created_at' => '2023-10-06'],
        ['id' => '15903', 'name' => 'Lemondott-elofizetek', 'size' => 472, 'created_at' => '2023-09-14'],
        ['id' => '16074', 'name' => 'Esemeny-resztvevok', 'size' => 995, 'created_at' => '2024-02-28'],
        ['id' => '17261', 'name' => 'Ugyfel-ajanlasok', 'size' => 67, 'created_at' => '2024-04-16'],
        ['id' => '18539', 'name' => 'Teszt-szegmens', 'size' => 35, 'created_at' => '2022-08-30'],
        ['id' => '19847', 'name' => 'Archivalt-kontaktok', 'size' => 4120, 'created_at' => '2021-05-04'],
    ];

    private const FORMS = [
        ['id' => 'f1001', 'list_id' => '21849', 'name' => 'Alap kapcsolatfelvetel', 'link' => 'https://example.test/forms/f1001'],
        ['id' => 'f1002', 'list_id' => '21849', 'name' => 'Termek demo igenyles', 'link' => 'https://example.test/forms/f1002'],
        ['id' => 'f1003', 'list_id' => '10042', 'name' => 'Hirlevel popup', 'link' => 'https://example.test/forms/f1003'],
        ['id' => 'f1004', 'list_id' => '10042', 'name' => 'Blog feliratkozas', 'link' => 'https://example.test/forms/f1004'],
        ['id' => 'f1005', 'list_id' => '33571', 'name' => 'VIP onboarding', 'link' => 'https://example.test/forms/f1005'],
        ['id' => 'f1006', 'list_id' => '47820', 'name' => 'Erdeklodo kerdoiv', 'link' => 'https://example.test/forms/f1006'],
        ['id' => 'f1007', 'list_id' => '47820', 'name' => 'Ajanlatkeres B2B', 'link' => 'https://example.test/forms/f1007'],
        ['id' => 'f1008', 'list_id' => '55193', 'name' => 'Demo idopont foglalas', 'link' => 'https://example.test/forms/f1008'],
        ['id' => 'f1009', 'list_id' => '62784', 'name' => 'Ujraaktivacios urlap', 'link' => 'https://example.test/forms/f1009'],
        ['id' => 'f1010', 'list_id' => '71356', 'name' => 'Partner jelentkezes', 'link' => 'https://example.test/forms/f1010'],
        ['id' => 'f1011', 'list_id' => '83902', 'name' => 'Webinar regisztracio', 'link' => 'https://example.test/forms/f1011'],
        ['id' => 'f1012', 'list_id' => '91274', 'name' => 'Lead magnet letoltes', 'link' => 'https://example.test/forms/f1012'],
        ['id' => 'f1013', 'list_id' => '10583', 'name' => 'Ertekesitesi callback', 'link' => 'https://example.test/forms/f1013'],
        ['id' => 'f1014', 'list_id' => '11947', 'name' => 'Konverzios probaverzio', 'link' => 'https://example.test/forms/f1014'],
        ['id' => 'f1015', 'list_id' => '12638', 'name' => 'Onboarding checklist', 'link' => 'https://example.test/forms/f1015'],
        ['id' => 'f1016', 'list_id' => '13725', 'name' => 'Elegedettsegi kerdoiv', 'link' => 'https://example.test/forms/f1016'],
        ['id' => 'f1017', 'list_id' => '14816', 'name' => 'Megujitasi ajanlat', 'link' => 'https://example.test/forms/f1017'],
        ['id' => 'f1018', 'list_id' => '15903', 'name' => 'Lemondasi okok', 'link' => 'https://example.test/forms/f1018'],
        ['id' => 'f1019', 'list_id' => '16074', 'name' => 'Esemeny utani feedback', 'link' => 'https://example.test/forms/f1019'],
        ['id' => 'f1020', 'list_id' => '17261', 'name' => 'Ajanlo program', 'link' => 'https://example.test/forms/f1020'],
        ['id' => 'f1021', 'list_id' => '18539', 'name' => 'Teszt A', 'link' => 'https://example.test/forms/f1021'],
        ['id' => 'f1022', 'list_id' => '19847', 'name' => 'Archiv export igeny', 'link' => 'https://example.test/forms/f1022'],
    ];

    public function getLists(): array
    {
        $listDTOs = [];

        foreach (self::LISTS as $list) {
            $listDTOs[] = new ListDTO(
                $list['id'],
                $list['name'],
                $list['size'],
                new \DateTimeImmutable($list['created_at'])
            );
        }

        return $listDTOs;
    }

    public function getListForms(string $listId): array
    {
        $listFormDTOs = [];

        foreach (self::FORMS as $form) {
            if ($form['list_id'] !== $listId) {
                continue;
            }

            $listFormDTOs[] = new ListFormDTO(
                $form['id'],
                $form['name'],
                $form['link']
            );
        }

        return $listFormDTOs;
    }
}
