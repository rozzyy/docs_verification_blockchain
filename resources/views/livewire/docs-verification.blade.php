<div x-data="{ progress: @entangle('progress') }" x-on:livewire-upload-progress="progress = $event.detail.progress">
    <header class="p-20 flex justify-center items-center flex-col gap-4 bg-blue-50">
        <div class="text-6xl font-bold">
            Verifikasi Dokumen
        </div>
        <div class="text-6xl font-bold text-blue-600">
            Terpercaya
        </div>
        <div class="text-center text-gray-600 text-xl">
            <div>
                Pastikan keaslian dokumen PDF anda dengan teknologi verifikasi digital terdepan.
            </div>
            <div>
                Cepat, akurat, dan terpercaya.
            </div>
        </div>
    </header>
    <main class="p-20 flex justify-center items-center flex-col gap-4">
        <div class="text-3xl font-bold">Verifikasi Dokumen Blockchain</div>
        <div class="text-gray-600">Upload dokumen ke blockchain dan verifikasi keaslian dengan teknologi terdesentralisasi</div>
        <div class="grid grid-cols-12 gap-4 w-full">
            <div class="col-span-10 col-start-2">
                <div class="flex bg-gray-100 p-1 rounded">
                    <button class="w-full p-1 rounded flex gap-2 justify-center items-center font-bold cursor-pointer {{ $selectedTab === 'upload' ? 'bg-blue-100' : '' }}" wire:click="setTab('upload')">
                        <x-lucide-link-2 class="size-4 my-auto" />
                        <span>Upload ke Blockchain</span>
                    </button>
                    <button class="w-full p-1 rounded flex gap-2 justify-center items-center font-bold cursor-pointer {{ $selectedTab === 'verify' ? 'bg-blue-100' : '' }}" wire:click="setTab('verify')">
                        <x-lucide-upload class="size-4 my-auto" />
                        <span>Verifikasi Dokumen</span>
                    </button>
                </div>
                <div class="mt-4 rounded-lg border border-gray-200 p-5 flex flex-col gap-4">
                    @if ($selectedTab === 'upload')
                    <div>
                        <div class="text-xl font-bold">
                            Upload Dokumen ke Blockchain
                        </div>
                        <div class="text-gray-600">
                            Simpan hash dokumen Anda ke blockchain untuk memastikan integritas dan keaslian dokumen
                        </div>
                    </div>
                        @if($file)
                        @if($errorMessage)
                        <div class="w-full bg-red-400 border border-red-800 rounded p-4 text-white text-center">
                            <div>
                                Dokumen Gagal Disimpan ke Blockchain. Silakan Coba Lagi!
                            </div>
                            <div>
                                Error: {{ $errorMessage }}
                            </div>
                        </div>
                        @endif
                        @if($txHash)
                        <div>
                            <div class="w-full bg-green-200 border border-green-500 rounded text-center flex flex-col gap-2 items-center p-6">
                                <x-lucide-check-circle class="size-10 text-green-500" />
                                <div class="text-lg font-bold">
                                    Dokumen Berhasil Disimpan ke Blockchain
                                </div>
                                <div class="text-gray-400">
                                    Hash dokumen Anda telah tersimpan dengan aman dan dapat diverifikasi kapan saja
                                </div>
                                <div class="text-sm bg-green-500 rounded-full px-2 py-1 text-white">
                                    Transaksi Berhasil
                                </div>
                            </div>
                        </div>
                        <div class="p-4 bg-slate-100 border border-slate-400 rounded-lg flex justify-between">
                            <div class="flex gap-4 items-center">
                                <span>
                                    <x-lucide-file class="size-6 text-blue-400" />
                                </span>
                                <span>
                                    <div>
                                        {{ $filename }}
                                    </div>
                                    <div>
                                        <span>{{ $filesize }}MB</span>
                                    </div>
                                </span>
                            </div>
                            <div class="flex items-center p-4">
                                <button class="cursor-pointer" wire:click="deleteFile">
                                    <x-lucide-x class="size-4" />
                                </button>
                            </div>
                        </div>
                        <div class="flex gap-2 items-center font-bold">
                            <span>
                                <x-lucide-blocks class="size-4" />
                            </span>
                            <span>Detail Transaksi Blockchain</span>
                        </div>
                        <div class="grid grid-cols-12 gap-2 w-full">
                            <div class="col-span-6 text-gray-600">
                                # Transaksi Hash:
                                <div class="bg-slate-200 border border-slate-400 rounded p-2 break-all mt-2 font-bold text-sm">
                                    {{ $txHash }}
                                </div>
                            </div>
                            <div class="col-span-6 text-gray-600">
                               # Hash Dokumen:
                                <div class="bg-slate-200 border border-slate-400 rounded p-2 break-all mt-2 font-bold text-sm">
                                    {{ $hash }}
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="p-4 bg-blue-100 border border-blue-400 rounded-lg flex justify-between" wire:loading.remove wire:target="saveToBlockchain">
                            <div class="flex gap-4 items-center">
                                <span>
                                    <x-lucide-file class="size-6 text-blue-400" />
                                </span>
                                <span>
                                    <div>
                                        {{ $filename }}
                                    </div>
                                    <div>
                                        <span>{{ $filesize }}MB</span>
                                        <span class="font-bold my-auto">.</span>
                                        <span>
                                            Siap Diproses
                                        </span>
                                    </div>
                                </span>
                            </div>
                            <div class="flex items-center p-4">
                                <button class="cursor-pointer" wire:click="deleteFile">
                                    <x-lucide-x class="size-4" />
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-center my-1" wire:loading.remove wire:target="saveToBlockchain">
                            <button class="flex gap-4 items-center px-4 py-2 bg-blue-400 hover:bg-blue-500 text-white font-bold cursor-pointer rounded-lg" wire:click="saveToBlockchain">
                                <x-lucide-link-2 class="size-4" />
                                <span>
                                    Simpan ke Blockchain
                                </span>
                            </button>
                        </div>
                        <div class="text-gray-600 text-center" wire:loading.remove wire:target="saveToBlockchain">
                            Hash dokumen akan disimpan ke blockchain untuk verifikasi di masa depan
                        </div>
                        @endif
                        <div wire:loading wire:target="saveToBlockchain">
                            <div class="flex flex-col gap-2 justify-center items-center my-6">
                                <div class="rounded-full bg-blue-100 p-4 w-16 h-16 flex justify-center items-center">
                                    <x-lucide-blocks class="size-10" />
                                </div>
                                <div class="text-2xl font-bold">
                                    Memproses ke Blockchain...
                                </div>
                                <div class="text-lg text-gray-600">
                                    Mohon tunggu, dokumen Anda sedang diproses dan disimpan ke blockchain...
                                </div>
                                <div class="w-full">
                                    <div class="w-full">
                                        <div class="w-full bg-blue-100 rounded-full h-4 overflow-hidden" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="`${ progress ?? 0}`">
                                            <div class="bg-blue-600 h-full transition-all duration-500" :style="`width: ${ progress ?? 0 }%`"></div>
                                        </div>
                                        <div class="flex justify-between items-center mt-2 text-sm text-blue-700 font-medium">
                                            <span>Proses ke Blockchain</span>
                                            <span x-text="`${progress}%`"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="flex flex-col gap-4">
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-10 flex flex-col gap-6 justify-center items-center hover:border-blue-300 cursor-pointer" x-on:click="$refs.fileInput.click()">
                                <div class="p-2 bg-blue-200 rounded-full">
                                    <x-lucide-upload class="size-6 text-blue-600" />
                                </div>
                                <div class="text-center" wire:loading.remove wire:target="file">
                                    <div class="font-bold">
                                        Klik untuk memilih file PDF
                                    </div>
                                    <div class="text-gray-400 text-center">
                                        File akan diproses dan hash-nya disimpan ke blockchain
                                    </div>
                                </div>
                                <div class="animate-pulse text-center" wire:loading wire:target="file">
                                    <div class="text-lg font-bold">
                                        Uploading File
                                    </div>
                                    <div>
                                        Mohon tunggu, file Anda sedang diunggah...
                                    </div>
                                </div>
                            </div>
                            <input type="file" class="hidden" x-ref="fileInput" wire:model="file" accept=".pdf" />
                            <div class="grid grid-cols-12 gap-2 w-full">
                                <div class="col-span-4 bg-gray-100 p-4 rounded flex flex-col gap-2 justify-center items-center">
                                    <x-lucide-hash class="size-8 text-blue-400" />
                                    <div class="text-center">
                                        <div class="font-bold">
                                            Hash Generation
                                        </div>
                                        <div class="text-gray-600 text-sm">
                                            SHA-256 untuk dokumen
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-4 bg-gray-100 p-4 rounded flex flex-col gap-2 justify-center items-center">
                                    <x-lucide-link-2 class="size-8 text-blue-400" />
                                    <div class="text-center">
                                        <div class="font-bold">
                                            Blockchain Storage
                                        </div>
                                        <div class="text-gray-600 text-sm">
                                            Hash tersimpan permanen
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-4 bg-gray-100 p-4 rounded flex flex-col gap-2 justify-center items-center">
                                    <x-lucide-check-circle class="size-8 text-blue-400" />
                                    <div class="text-center">
                                        <div class="font-bold">
                                            Verification Ready
                                        </div>
                                        <div class="text-gray-600 text-sm">
                                            Siap untuk diverifikasi
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-2 justify-center items-center text-sm text-gray-400">
                                <x-lucide-file class="size-4" />
                                Format yang didukung: PDF (Maksimal 10MB)
                            </div>
                        </div>
                        @endif
                    @elseif ($selectedTab === 'verify')
                    <div>
                        <div class="text-xl font-bold">
                            Verifikasi File Copy
                        </div>
                        <div class="text-gray-600">
                            Upload file copy untuk memverifikasi keasliannya dengan data yang tersimpan di blockchain
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        @if($verifyFile)
                        <div class="p-4 bg-blue-100 border border-blue-400 rounded-lg flex justify-between">
                            <div class="flex gap-4 items-center">
                                <span>
                                    <x-lucide-file class="size-6 text-blue-400" />
                                </span>
                                <span>
                                    <div>
                                        {{ $verifyFilename }}
                                    </div>
                                    <div>
                                        <span>{{ $verifyFilesize }}MB</span>
                                        <span class="font-bold my-auto">.</span>
                                        <span>
                                            Siap Diproses
                                        </span>
                                    </div>
                                </span>
                            </div>
                            <div class="flex items-center p-4">
                                <button class="cursor-pointer" wire:click="deleteFile">
                                    <x-lucide-x class="size-4" />
                                </button>
                            </div>
                        </div>
                        @if($isVerify)
                        <div>
                            @if($isMatch && $isFound)
                            <div class="w-full bg-green-200 border border-green-500 rounded text-center flex flex-col gap-2 items-center p-6">
                                <x-lucide-check-circle class="size-10 text-green-500" />
                                <div class="text-lg font-bold">
                                    Hash Cocok dengan Blockchain
                                </div>
                                <div class="text-gray-400">
                                    Hash dokumen ini cocok dengan data yang tersimpan di blockchain
                                </div>
                                <div class="text-sm bg-blue-500 rounded-full px-2 py-1 text-white">
                                    Transaksi Berhasil
                                </div>
                            </div>
                            @else
                            <div class="w-full bg-yellow-100 border border-yellow-400 rounded text-center flex flex-col gap-2 items-center p-6">
                                <x-lucide-triangle-alert class="size-10 text-yellow-500" />
                                <div class="text-lg font-bold">
                                    Hash Tidak Cocok
                                </div>
                                <div class="text-gray-400">
                                    Hash dokumen ini tidak cocok dengan record blockchain
                                </div>
                            </div>
                            @endif
                            <div class="grid grid-cols-12 gap-4 my-4">
                                <div class="col-span-6">
                                    <div class="flex gap-2 items-center">
                                        <x-lucide-shield class="size-4" />
                                        <span class="font-bold">
                                            Status Transaksi
                                        </span>
                                    </div>
                                    <div class="my-2 flex flex-col gap-2">
                                        <div class="flex justify-between w-full">
                                            <div>
                                                Hash Match
                                            </div>
                                            <div class="font-bold">
                                                @if($isMatch)
                                                <div class="bg-blue-400 rounded-full px-2 text-sm text-white">
                                                    Match
                                                </div>
                                                @else
                                                <div class="bg-slate-400 rounded-full px-2 text-sm">
                                                   Not Match
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex justify-between">
                                            <div>
                                                Blockchain Record
                                            </div>
                                            <div class="font-bold">
                                                @if($isFound)
                                                <div class="bg-blue-400 rounded-full px-2 text-sm text-white">
                                                    Found
                                                </div>
                                                @else
                                                <div class="bg-slate-400 rounded-full px-2 text-sm">
                                                   Not Found
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <div class="font-bold">
                                        Detil Dokumen
                                    </div>
                                    <div class="text-sm my-2 text-gray-400 flex gap-2">
                                        <div class="w-3/12">
                                            # Hash:
                                        </div>
                                        <div class="text-[12px] break-all">
                                            SHA256:{{ $verifyHash }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div wire:loading wire:target="checkHash">
                            <div class="flex flex-col gap-2 justify-center items-center my-6">
                                <div>
                                    <x-lucide-refresh-ccw class="size-6 text-blue-400 animate-spin" />
                                </div>
                                <div class="font-bold">
                                    Memverifikasi dengan Blockchain...
                                </div>
                                <div class="text-lg text-gray-600">
                                    Mohon tunggu, dokumen Anda sedang diproses ke blockchain...
                                </div>
                                <div class="w-full">
                                    <div class="w-full">
                                        <div class="w-full bg-blue-100 rounded-full h-4 overflow-hidden" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="`${ progress ?? 0}`">
                                            <div class="bg-blue-600 h-full transition-all duration-500" :style="`width: ${ progress ?? 0 }%`"></div>
                                        </div>
                                        <div class="flex justify-between items-center mt-2 text-sm text-blue-700 font-medium">
                                            <span>Proses ke Blockchain</span>
                                            <span x-text="`${progress}%`"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center my-1" wire:loading.remove wire:target="checkHash">
                            <button class="flex gap-4 items-center px-4 py-2 bg-blue-400 hover:bg-blue-500 text-white font-bold cursor-pointer rounded-lg" wire:click="checkHash">
                                <x-lucide-shield class="size-4" />
                                @if(!$isVerify)
                                <span>
                                    Verifikasi dengan Blockchain
                                </span>
                                @else
                                <span>
                                    Verifikasi Ulang
                                </span>
                                @endif
                            </button>
                        </div>
                        @else
                        <div class="flex flex-col gap-3 justify-center items-center text-sm text-gray-400 my-6">
                            <x-lucide-shield class="size-15" />
                            <div class="font-bold text-xl">
                                Upload File Copy untuk Verifikasi
                            </div>
                            <div class="text-lg">
                                Upload file copy yang ingin Anda verifikasi dengan data blockchain
                            </div>
                        </div>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-10 flex flex-col gap-6 justify-center items-center hover:border-blue-300 cursor-pointer" x-on:click="$refs.fileInputVerify.click()">
                            <div class="p-2 bg-blue-200 rounded-full">
                                <x-lucide-upload class="size-6 text-blue-600" />
                            </div>
                            <div class="text-center" wire:loading.remove wire:target="verifyFile">
                                <div class="font-bold">
                                    Klik untuk memilih file PDF
                                </div>
                                <div class="text-gray-400 text-center">
                                    Maks. ukuran file 10MB
                                </div>
                            </div>
                            <div class="animate-pulse text-center" wire:loading wire:target="verifyFile">
                                <div class="text-lg font-bold">
                                    Uploading File
                                </div>
                                <div>
                                    Mohon tunggu, file Anda sedang diunggah...
                                </div>
                            </div>
                        </div>
                        <input type="file" class="hidden" x-ref="fileInputVerify" wire:model="verifyFile" accept=".pdf" />
                        @endif
                    </div>
                    <div class="flex gap-2 justify-center items-center text-sm text-gray-400">
                        <x-lucide-file class="size-4" />
                        Format yang didukung: PDF (Maksimal 10MB)
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</div>
