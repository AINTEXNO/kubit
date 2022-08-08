<?php

namespace App\Controllers;

use App\Services\Request;

class FormController extends Controller
{
    public function handle()
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ZDhhMzdmOGMyOTNmYmY0NThmYWNlZTFlM2ZiY2QzODczMzEyZDU3YWNiOGY2NDQzNTlkMjk3N2JlNDM0ZmI2Nw'
        ];

        $email = ['contentType'=>'ContactInfo','type'=>'email','value'=> $_POST['contractorEmail']];
        $phone = ['contentType'=>'ContactInfo','type'=>'phone','value'=> $_POST['contractorPhone']];

        $createContractorHuman = $this->request->only(['firstName', 'lastName', 'middleName'])
            ->append(['contentType' => 'ContractorHuman', 'description' => $_POST['description'], 'contactInfo' => [$email, $phone]])
            ->to_json()
            ->post('https://demo23.megaplan.ru/api/v3/contractorHuman', $headers);

        $createContractorHuman = json_decode($createContractorHuman);
        $contractorHumanId = $createContractorHuman->data->id;

        $contractor = ['id' => $contractorHumanId];
        $program = ['id' => 44];

        $createDeal = $this->request->only(array())
            ->append(['contentType' => 'Deal', 'contractor' => $contractor, 'program' => $program])
            ->to_json()
            ->post('https://demo23.megaplan.ru/api/v3/deal', $headers);

        $createDeal = json_decode($createDeal);

        return isset($createDeal->meta->status) && $createDeal->meta->status == 200
            ? header("Location: {$_SERVER['PHP_SELF']}?success=true&contractor={$contractorHumanId}&deal={$createDeal->data->id}")
            : header("Location: {$_SERVER['PHP_SELF']}?error=true");
    }
}