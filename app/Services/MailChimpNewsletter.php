<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailChimpNewsletter implements Newsletter
{

    public function __construct(protected ApiClient $client)
    {
        //
    }

    public function subscribe(string $email, string $list = null)
    {
        $list = $list ?? config('services.mailchimp.lists.subscribers');

        return $this->client->lists->getListMembersInfo($list, [
            "email" => $email,
            "status" => 'subscribed',
        ]);
    }

}
