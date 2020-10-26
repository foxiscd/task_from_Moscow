<?php

namespace Services;

use models\users\User;

class EmailSender
{
    public static function send(
        User $receiver2,
        string $subject,
        string $temlateName,
        $temlateVars = []
    )
    {
        extract($temlateVars);

        ob_start();
        require __DIR__ . '/../../tamplates/mail/' . $temlateName;
        $body = ob_get_contents();
        ob_end_clean();
        mail($receiver2->getEmail(), $subject, $body, 'Content-type: text/html; charset=UTF-8');
    }
}