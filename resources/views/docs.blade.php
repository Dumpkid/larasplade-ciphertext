<x-layout>
    <x-slot name="header">
        {{ __('Ciphertext Transposition Vertikal') }}
    </x-slot>

    <x-panel class="container">
        <div class="flex flex-row">
            <div class="relative border basis-1/4 mx-1">
                <p class="text-center text-lg">Plainteks</p>
                <x-splade-flash>
                    <p v-if="flash.has('plainteks')" v-text="flash.plainteks"
                        class="absolute inset-x-0 bottom-1 break-all text-base text-center font-bold" />
                </x-splade-flash>

            </div>
            <div class="relative border basis-1/4 mx-1">
                <p class="text-center text-lg">Cipherteks</p>
                <x-splade-flash class="">
                    <p v-if="flash.has('ciphertext')" v-text="flash.ciphertext"
                        class="absolute inset-x-0 bottom-1 break-all text-base text-center font-bold" />
                </x-splade-flash>
            </div>
            <div class="border basis-1/2 mx-1">
                <div class="border text-center text-lg">Hasil Enkripsi</div>
                <div class="flex flex-row text-center">
                    <div class="basis-1/2 py-4">
                        <p>Cipherteks</p>
                        <x-splade-flash class="text-base font-bold">
                            <p v-if="flash.has('result')" v-text="flash.result"
                                class="text-base text-center font-bold" />
                        </x-splade-flash>
                    </div>
                    <div class="basis-1/2 py-4">
                        <p>Dekripsi Key</p>
                        <x-splade-flash class="text-base font-bold">
                            <p v-if="flash.has('key')" v-text="flash.key" class="text-base text-center font-bold" />
                        </x-splade-flash>
                    </div>
                </div>

            </div>
        </div>
        <div class="flex flex-row">
            <div class="basis-1/4 mx-1">
                <x-splade-form class="py-2" action="enkrip">
                    <x-splade-file name="plainteks" placeholder="Upload File TXT" required class="py-1" />
                    <x-splade-input name="enkripsi_key" type="number" placeholder="Enkripsi Key" min="1"
                        required class="py-1" />
                    <x-splade-submit label="Enkripsi" :spinner="false"
                        class="py-1 bg-purple-400 hover:bg-purple-500 font-medium" />
                </x-splade-form>
            </div>
            <div class="basis-1/4 mx-1">
                <x-splade-form class="py-2" action="dekrip">
                    <x-splade-file name="cipherteks" placeholder="Upload File TXT" required class="py-1" />
                    <x-splade-input name="dekripsi_key" type="number" placeholder="Dekripsi Key" min="1"
                        required class="py-1" />
                    <x-splade-submit label="Dekripsi" :spinner="false"
                        class="py-1 bg-blue-400 hover:bg-blue-500 font-medium" />
                </x-splade-form>
            </div>
            <div class="relative basis-1/2 mx-1 py-5 border">
                <p class="text-center text-lg">Hasil Dekripsi</p>
                <x-splade-flash>
                    <p v-if="flash.has('hasil_dekripsi')" v-text="flash.hasil_dekripsi"
                        class="py-10 text-base text-center font-bold" />
                </x-splade-flash>
            </div>
        </div>

    </x-panel>
</x-layout>
