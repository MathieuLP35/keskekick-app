<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 grid grid-cols-1 gap-4">

                    <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex justify-end px-4 pt-4">
                            <button id="dropdownButton" data-dropdown-toggle="dropdown" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                                <span class="sr-only">Open dropdown</span>
                                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdown" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2" aria-labelledby="dropdownButton">
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-red-200 dark:hover:text-red">Wipe</a>
                                </li>
                                </ul>
                            </div>
                        </div>
                        <div class="flex flex-col items-center pb-10">
                            <h4 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $user->firstname }} {{ $user->lastname }}</h4>
                            <span class="text-sm text-gray-500 dark:text-gray-400">ID Unique: {{ $user->id }}</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                @php $discord = explode(":", $user->discord); @endphp
                                Tag Discord: <@!{{ $discord[1] }}>
                            </span>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 place-content-around mt-4">
                                <div id="activity" class="border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700 rounded-lg p-4 ...">
                                    <h5 class="text-lg text-white-600 dark:text-white-400 mb-2">Activités</h5>
                                    
                                    <span class="text-gray-600 dark:text-gray-400 block">Job: {{ $user->getJob() }} | Grade: {{ $user->getJobGrade() }}</span>
                                    <span class="text-gray-600 dark:text-gray-400 block">Groupe: {{ $user->getGroup() }} | Grade: {{ $user->getGroupGrade() }}</span>
                                </div>
                                <div id="accounts" class="border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700 rounded-lg p-4 ...">
                                    <h5 class="text-lg text-white-600 dark:text-white-400 mb-2">Comptes</h5>
                                    @php
                                        $accounts = json_decode($user->accounts);
                                    @endphp
                                    <span class="text-gray-600 dark:text-gray-400 block">Cash: {{ $accounts->money }} $</span>
                                    <span class="text-gray-600 dark:text-gray-400 block">Banque: {{ $accounts->bank }} $</span>
                                </div>
                                <div id="other" class="border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700 rounded-lg p-4 ...">
                                    <h5 class="text-lg text-white-600 dark:text-white-400 mb-2">Autres informations</h5>

                                    <span class="text-gray-600 dark:text-gray-400 block">Sexe: {{ $user->getSexe() }}</span>
                                    <span class="text-gray-600 dark:text-gray-400 block">Date de naissance: {{ $user->dateofbirth }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div id="accordion-collapse" data-accordion="collapse" class="mx-4 mb-2">
                            <h2 id="accordion-collapse-heading-1">
                                <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-collapse-body-1" aria-expanded="false" aria-controls="accordion-collapse-body-1">
                                    <span>Liste des bans en cours</span>
                                    <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>
                            </h2>
                            <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
                                <div class="p-1 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                    
                                    <div class="relative overflow-x-auto">
                                        @if (count($user->getPlayerBanList()) > 0)
                                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3">
                                                            License
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Auteur
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            DiscordTag
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Raison du ban
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Joueur Bannis
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($user->getPlayerBanList() as $userBanList)
                                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                {{ $userBanList->license }}
                                                            </th>
                                                            <td class="px-6 py-4">
                                                                {{ $userBanList->author }}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                @php
                                                                    $discord = explode(":", $userBanList->discord);
                                                                @endphp
                                                                <@!{{ $discord[1] }}>
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                {{ $userBanList->reason }}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                {{ $userBanList->player }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <div class="flex p-4 mx-8 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
                                                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Info</span>
                                                <div>
                                                    <span class="font-medium">Informations!</span> Aucun ban trouvé pour ce joueur.
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <h2 id="accordion-collapse-heading-2">
                                <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-collapse-body-2" aria-expanded="false" aria-controls="accordion-collapse-body-2">
                                    <span>Historique des bans</span>
                                    <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>
                            </h2>
                            <div id="accordion-collapse-body-2" class="hidden" aria-labelledby="accordion-collapse-heading-2">
                                <div class="p-1 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                    
                                    <div class="relative overflow-x-auto">
                                        @if (count($user->getPlayerBanListHistory()) > 0)
                                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3">
                                                            License
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Auteur du bans
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            DiscordTag
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Raison du ban
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Joueur Bannis
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($user->getPlayerBanListHistory() as $userBanListHistory)
                                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                {{ $userBanListHistory->license }}
                                                            </th>
                                                            <td class="px-6 py-4">
                                                                {{ $userBanListHistory->author }}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                @php
                                                                    $discord = explode(":", $userBanListHistory->discord);
                                                                @endphp
                                                                <@!{{ $discord[1] }}>
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                {{ $userBanListHistory->reason }}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                {{ $userBanListHistory->player }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <div class="flex p-4 mx-8 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
                                                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Info</span>
                                                <div>
                                                    <span class="font-medium">Informations!</span> Aucun historique de ban trouvé pour ce joueur.
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
