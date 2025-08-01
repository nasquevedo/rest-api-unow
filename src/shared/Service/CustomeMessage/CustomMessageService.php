<?php

namespace App\shared\Service\CustomeMessage;

use App\shared\Service\CustomeMessage\CustomMessageServiceInterface;

class CustomMessageService implements CustomMessageServiceInterface
{
    public function customWelcomeMessage(string $name, string $password): string
    {
        return "<div style='background-color: black; color: white; padding: 5px; margin: 0'>" .
                    "<a style='color: white; text-decoration: none;' href='http://localhost:3000'><h3>Unow Test!</h3></a>" .
                "</div>" .
                "<div>" .
                    "<p>Hello, $name</p>" .
                    "<p>We're really exited you've just joined us and wanted to say <b>Congrats</b>.<p>" .
                    "<p>Here's you new password:</p>" .
                    "<p>password: $password</p>" .
                    "<p>Please, change it as soon as possible, and we invite you to manage your profile in the link below:</p>" .
                    "<div style='width: 100%;'>" .
                        "<a style='text-decoration: none; background-color: black; color: white; padding: 5px;' href='http://localhost:3000/'>Profile</a>" .
                    "</div>" .
                    "<br><br>" .
                    "<p>Kind Regards</p>" .
                    "<p>Admin</p>" .
                "</div>" .
                "<footer>Unow Test!</footer>"
            ;
    }

    public function customRegisterMessage(string $name): string
    {
        return "<div style='background-color: black; color: white; padding: 5px; margin: 0'>" .
                    "<a style='color: white; text-decoration: none;' href='http://localhost:3000'><h3>Unow Test!</h3></a>" .
                "</div>" .
                "<div>" .
                    "<p>Hello, $name</p>" .
                    "<p>We noticed that you just joined us throught our channel, so we wanted to express our admiration and say <b>Congrats</b>.<p>" .
                    "<p>We invite you to continue managing your profile in the link below:</p>" .
                    "<div style='width: 100%;'>" .
                        "<a style='text-decoration: none; background-color: black; color: white; padding: 5px;' href='http://localhost:3000/'>Profile</a>" .
                    "</div><br>" .
                    "<p>Hope to hear from you soon :)</p>" .
                "</div>" .
                "<p>Kind Regards</p>" .
                "<p>Admin</p>" .
                "<footer>Unow Test!</footer>"
        ;
    }
}