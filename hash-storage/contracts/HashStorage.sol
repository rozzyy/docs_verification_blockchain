// File: HashStorage.sol
// SPDX-License-Identifier: MIT
pragma solidity ^0.8.13;

contract HashStorage {
    mapping(string => bool) private storedHashes;

    event HashStored(string hash);

    function storeHash(string memory hash) public {
        require(!storedHashes[hash], "Hash already exists");
        storedHashes[hash] = true;
        emit HashStored(hash);
    }

    function checkHash(string memory hash) public view returns (bool) {
        return storedHashes[hash];
    }
}
