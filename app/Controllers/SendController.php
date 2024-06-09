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
        $qr = $this->request->getFile('qr-file');
        $amount = $this->request->getPost('amount-qr');
        $note = $this->request->getPost('note-qr');

        if ($qr->isValid() && !$qr->hasMoved()) {
            // Generate a random name for the file and move it
            $newName = $qr->getRandomName();
            $qr->move(FCPATH . 'uploads/qr', $newName);
            $qrNewPath = FCPATH . 'uploads/qr/' . $newName;

            // Read QR from new path
            $qrCodeLib = new QRCode();
            $readQrValue = $qrCodeLib->readFromFile($qrNewPath);
            if ($readQrValue === null) {
                unlink($qrNewPath);
                return redirect()->back()->with('message', 'Failed to read QR code');
            }
            $contentQr = (string) $readQrValue->data;
            
            // Find recipient user by the content of the QR code
            $userService = new UserService();
            $recipient = $userService->findUserByPhone($contentQr);            
            
            $send = $this->transactionService->sendMoney($recipient['phone'], str_replace(',', '', $amount), $note);
            if ($send == false) {
                unlink($qrNewPath);
                return redirect()->back()->with('message', 'Balance not enough');
            }

            // Delete QR from new path after successful processing
            unlink($qrNewPath);
            return redirect()->back()->with('message', 'Money sent successfully');
        }

        // Handle invalid or missing QR fil
        return redirect()->back()->with('message', 'Invalid QR file');
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
