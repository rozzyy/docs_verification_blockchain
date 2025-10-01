<?php

namespace App\Livewire;

class BlockchainService
{
    public $web3;
    public $contract;

    public function __construct()
    {
        $abiPath = base_path(config('app.blockchain.abi_json_path'));
        $contents = file_get_contents($abiPath);
        $abi = json_decode($contents, true)['abi'];
        $this->web3 = new \Web3\Web3(config('app.blockchain.ganache_host'));
        $this->contract = new \Web3\Contract($this->web3->provider, $abi);
        $this->contract->at(config('app.blockchain.contract_address'));
    }

    public function getWeb3()
    {
        return $this->web3;
    }

    public function getContract()
    {
        return $this->contract;
    }
}
