<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\RecipientService;
use App\Services\TransactionService;
use App\Services\UserService;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\Recipient;
use chillerlan\QRCode\QRCode;

class SendController extends BaseController
{
    private $transactionService;
    private $recipientService;

    public function __construct()
    {
        $this->transactionService = new TransactionService();
        $this->recipientService = new RecipientService();
    }

    public function index()
    {
        $userBalance = $this->transactionService->getUserBalance(session('id'));
        $recipients = $this->recipientService->getRecipientsByUserId();

        return view('send/index', compact('userBalance', 'recipients'));
    }

    public function addRecipient()
    {
        $phone = (string) $this->request->getPost('phone-num');

        $userService = new UserService();
        $user = $userService->findUserByPhone($phone);

        if (empty($user)) {
            return redirect()->back()->with('message', 'User not found');
        }

        $this->recipientService->addRecipient($phone);

        return redirect()->back();
    }

    public function sendMoney()
    {
        $recipient = $this->request->getPost('recipient-tf');
        $amount = $this->request->getPost('amount-tf');
        $note = $this->request->getPost('note-tf');

        $send = $this->transactionService->sendMoney($recipient, str_replace(',', '', $amount), $note);
        if ($send == false) {
            return redirect()->back()->with('message', 'Balance not enough');
        }

        return redirect()->back();
    }

    public function sendMoneyQr()
    {
        $qrFile = $this->request->getFile('qr-file');
        $amount = $this->request->getPost('amount-qr');
        $note = $this->request->getPost('note-qr');

        if (!$qrFile->isValid()) {
            return redirect()->back()->with('message', 'Invalid QR file');
        }

        $qrFileName = $qrFile->getRandomName();
        $qrFilePath = FCPATH . 'uploads/qr/' . $qrFileName;
        $qrFile->move(FCPATH . 'uploads/qr', $qrFileName);

        $qrValue = (new QRCode())->readFromFile($qrFilePath);

        if ($qrValue === null) {
            unlink($qrFilePath);
            return redirect()->back()->with('message', 'Failed to read QR code');
        }

        $recipient = (new UserService())->findUserByPhone((string) $qrValue->data);

        if (empty($recipient)) {
            unlink($qrFilePath);
            return redirect()->back()->with('message', 'Recipient not found');
        }

        $sendSuccessful = $this->transactionService->sendMoney($recipient['phone'], str_replace(',', '', $amount), $note);

        if (!$sendSuccessful) {
            unlink($qrFilePath);
            return redirect()->back()->with('message', 'Balance not enough');
        }

        unlink($qrFilePath);
        return redirect()->back()->with('message', 'Money sent successfully');
    }

    public function deleteRecipient($id)
    {
        $recipientModel = new Recipient();

        $recipient = $recipientModel->find($id);

        if ($recipient) {
            $recipientModel->delete($id);

            return redirect()->back()->with('message', 'Recipient deleted successfully.');
        } else {
            throw new PageNotFoundException("User dengan ID $id tidak ditemukan");
        }
    }
}
