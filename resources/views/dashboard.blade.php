<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Activity Log') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                @foreach ($logs as $log)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div>
                            <div>
                                <span class="text-sm">
                                    @if ($log->status)
                                        <span class="text-xs font-semibold rounded-full bg-green-200 text-green-800 px-4 py-1">Successful run</span>
                                    @else
                                        <span class="text-xs font-semibold rounded-full bg-red-200 text-red-800 px-4 py-1">Error run</span>
                                    @endif
                                </span>
                            </div>

                            <div class="mt-6">
                                <div>
                                    @if ($log->status)
                                        <span class="text-xs text-gray-600">Emails sent to</span>

                                        <ul class="mt-2">
                                            @foreach ($log->students as $student)
                                                <li>
                                                    <a class="text-blue-500 hover:text-blue-600" href="mailto:{{ $student }}">{{ $student }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-gray-600">
                                            {{ $log->context }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-4">
                                <span class="text-xs text-gray-600">
                                    {{ 'Last ran ' . $log->init_time->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="py-16 bg-white border-t border-gray-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{ $logs->links() }}
        </div>
    </div>
</x-app-layout>
