<?php

declare(strict_types=1);

namespace App\Models\Dice;

use App\Models\Users;

/**
 * Class Bets.
 */
class Bets
{
    public $amount;

    public function update($result): void
    {
        $user = new Users();
        $userData = $user->getUserData(session('account'));
        $pre = $userData[0];

        if ($result === "won") {
            if ($this->amount === 0) {
                $this->amount = 1;
            }
            $new = (int)$pre['coins'] + $this->amount;
            $user->updateCoins($new);
        } elseif ($result === "lost") {
            $new = (int)$pre['coins'] - $this->amount;
            $user->updateCoins($new);
        }
    }
}
