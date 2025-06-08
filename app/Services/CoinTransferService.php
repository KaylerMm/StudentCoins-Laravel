<?php

namespace App\Services;

use App\Enums\UserRoles;
use App\Models\Partner;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class CoinTransferService
{
    public function processTransaction(UserRoles $senderType, int $senderId, UserRoles $receiverType, int $receiverId, float $amount): bool
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException('A quantidade de moedas deve ser maior que zero.');
        }

        if (!$this->isTransferAllowedForTypes($senderType, $receiverType)) {
            throw new \InvalidArgumentException('Transferência não permitida entre os tipos de usuário especificados.');
        }

        [$sender, $receiver] = $this->getUsersInTransaction($senderType, $senderId, $receiverType, $receiverId);

        if (!$sender || !$receiver) {
            throw new \InvalidArgumentException('Usuário remetente ou destinatário não encontrado.');
        }

        [$senderWallet, $receiverWallet] = $this->getTransactionWallets($sender, $receiver);
        $this->checkSenderBalance($senderWallet, $amount);
        $this->makeTransaction($senderWallet, $receiverWallet, $amount);
        return true;
    }

    protected function isTransferAllowedForTypes(UserRoles $senderType, UserRoles $receiverType): bool
    {
        $allowedTransfers = [
            UserRoles::PARTNER->value => [UserRoles::TEACHER->value],
            UserRoles::TEACHER->value => [UserRoles::STUDENT->value, UserRoles::TEACHER->value],
        ];

        return isset($allowedTransfers[$senderType->value]) && in_array($receiverType->value, $allowedTransfers[$senderType->value]);
    }

    protected function getUsersInTransaction(UserRoles $senderType, int $senderId, UserRoles $receiverType, int $receiverId): array
    {
        $sender = $this->getUserByTypeAndId($senderType, $senderId);
        $receiver = $this->getUserByTypeAndId($receiverType, $receiverId);
        return [$sender, $receiver];
    }

    protected function getUserByTypeAndId(UserRoles $type, int $id)
    {
        switch ($type) {
            case UserRoles::PARTNER:
                return Partner::with('user')->where('id', '=', $id)->first();
            case UserRoles::TEACHER:
                return Teacher::with('user')->where('id', '=', $id)->first();
            case UserRoles::STUDENT:
                return Student::with('user')->where('id', '=', $id)->first();
            default:
                return null;
        }
    }

    protected function checkSenderBalance(Wallet $senderWallet, float $amount): void
    {
        if ($senderWallet->balance < $amount) {
            throw new \InvalidArgumentException('Saldo insuficiente para a transferência.');
        }
    }

    protected function makeTransaction($senderWallet, $receiverWallet, float $amount): void
    {
        DB::transaction(function () use ($senderWallet, $receiverWallet, $amount) {
            $senderWallet->balance -= $amount;
            $receiverWallet->balance += $amount;

            $senderWallet->save();
            $receiverWallet->save();
        });
    }

    protected function getTransactionWallets($sender, $receiver): array
    {
        return [$sender->user->wallet, $receiver->user->wallet];
    }
}