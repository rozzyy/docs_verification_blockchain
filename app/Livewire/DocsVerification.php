<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use BlockChainSerivice;

class DocsVerification extends Component
{
    use \Livewire\WithFileUploads;

    public $selectedTab = 'verify';

    public $file;
    public $filename;
    public $filesize;
    public $txHash;
    public $errorMessage;
    public $progress = 0;
    public $hash;

    public $verifyFile;
    public $verifyFilename;
    public $verifyFilesize;
    public $isVerify = false;
    public $isMatch = false;
    public $isFound = false;
    public $verifyHash;

    public function updatedFile() {
        $this->filename = $this->file->getClientOriginalName();
        $this->filesize = number_format($this->file->getSize() / 1048576, 2);
    }

    public function updatedVerifyFile() {
        $this->verifyFilename = $this->verifyFile->getClientOriginalName();
        $this->verifyFilesize = number_format($this->verifyFile->getSize() / 1048576, 2);
    }

    public function hashFile($file) {
        return hash_file('sha256', $file);
    }

    public function checkHash() {
        try {
            $blockchain = app(BlockchainService::class);
            $contract = $blockchain->getContract();
            $web3 = $blockchain->getWeb3();
            $hashFile = $this->hashFile($this->verifyFile->getRealPath());
            $hash = '0x' . $hashFile;
            $this->verifyHash = $hashFile;

             $contract->call('checkHash', $hash, function ($error, $result) use ($contract, $hash) {
                if ($error !== null) {
                    $this->errorMessage = $error->getMessage();
                    return;
                }

                if ($result[0]) {
                    $this->isVerify = true;
                    $this->isMatch = true;
                    $this->isFound = true;
                } else {
                    $this->isVerify = true;
                    $this->isMatch = false;
                    $this->isFound = false;
                }
            });

        } catch (\Exception $th) {
            $this->errorMessage = $th->getMessage();
            return;
        }
    }

    public function saveToBlockchain() {
        try {
            $blockchain = app(BlockchainService::class);
            $contract = $blockchain->getContract();
            $web3 = $blockchain->getWeb3();
            $hashFile = $this->hashFile($this->file->getRealPath());
            $hash = '0x' . $hashFile;
            $this->hash = $hashFile;

            $contract->call('checkHash', $this->hash, function ($error, $result) use ($contract, $hash) {
                if ($error !== null) {
                    $this->errorMessage = $error->getMessage();
                    return;
                }

                if ($result[0]) {
                    $this->errorMessage = 'Dokumen sudah pernah disimpan di blockchain.';
                } else {
                    $contract->send('storeHash', $hash, [
                        'from' => '0xEFe46E48464776813BF0297737DC4f793C542bC6',
                        'gas' => '0x200b20',
                    ], function ($err, $transaction) {
                        if ($err !== null) {
                            $this->errorMessage = $err->getMessage();
                            return;
                        }
                        $this->txHash = $transaction;
                    });
                }
            });
        } catch(\Exception $error) {
            $this->errorMessage = $error->getMessage();
        }
    }

    public function setTab($tab)
    {
        $this->selectedTab = $tab;
    }

    public function deleteFile() {
        $this->reset(['file', 'filename', 'filesize', 'txHash', 'errorMessage', 'hash', 'progress', 'verifyFile', 'verifyFilename', 'verifyFilesize', 'isVerify', 'isMatch', 'isFound']);
    }

    public function render()
    {
        return view('livewire.docs-verification');
    }
}
