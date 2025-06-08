<?php

namespace App\Services;

use App\Enums\UserRoles;
use App\Models\Partner;
use App\Models\Teacher;
use App\Models\Student;
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

        $this->checkSenderBalance($sender, $amount);
        $this->makeTransfer($sender, $receiver, $amount);
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

    protected function checkSenderBalance($sender, float $amount): void
    {
        if ($sender->user->wallet->balance < $amount) {
            throw new \InvalidArgumentException('Saldo insuficiente para a transferência.');
        }
    }

    protected function makeTransfer($sender, $receiver, float $amount): void
    {
        DB::transaction(function () use ($sender, $receiver, $amount) {
            $senderUser = $sender->user;
            $receiverUser = $receiver->user;

            $senderUser->adjustWalletBalance(-$amount);
            $receiverUser->adjustWalletBalance($amount);
        });
    }
}