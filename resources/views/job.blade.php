<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Job') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="py-4">
                        <input type="text" id="jobSearch" class="w-full border rounded text-gray-900 dark:text-gray-900 focus:outline-none focus:ring focus:border-blue-300" placeholder="Recherche par nom de job">
                    </div>
                    <table class="w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Nom du job</th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Label</th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Grade</th>
                            </tr>
                        </thead>
                        <tbody id="jobTable" class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-800">
                            @foreach($jobs as $job)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $job->name }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $job->label }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="flex flex-wrap flex-col">
                                        @foreach($job->grades as $grade)
                                            <span class="mr-2 mb-2 px-2 py-1 bg-gray-700 text-gray-300 rounded-full">{{ $grade->grade }} - {{ $grade->label }}</span>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<script>
    var jobs = <?php echo json_encode($jobs->toArray()); ?>;

    document.addEventListener('DOMContentLoaded', function() {
        const jobSearchInput = document.getElementById('jobSearch');
        const jobTable = document.getElementById('jobTable');
        const originalTableContent = jobTable.innerHTML;

        jobSearchInput.addEventListener('input', function() {
            const searchTerm = jobSearchInput.value.toLowerCase();
            const filteredJobs = jobs.filter(job => job.name.toLowerCase().includes(searchTerm));

            if (filteredJobs.length > 0) {
                const updatedTableContent = filteredJobs.map(job => `
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap">${job.name}</td>
                            <td class="px-6 py-4 whitespace-no-wrap">${job.label}</td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="flex flex-wrap flex-col">
                                    ${job.grades.map(grade => `<span class="mr-2 mb-2 px-2 py-1 bg-gray-700 text-gray-300 rounded-full">${grade.grade} - ${grade.label}</span>`).join('')}
                                </div>
                            </td>
                        </tr>
                    `).join('');

                jobTable.innerHTML = updatedTableContent;
            } else {
                jobTable.innerHTML = originalTableContent;
            }
        });
    });
</script>