<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Activity Log') }}
        </h2>
    </x-slot>

    <div class="my-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex itemsc-center justify-end">
                <form action="{{ route('logs.destroy') }}" method="POST" accept-charset="utf-8">
                    @csrf
                    @method('DELETE')
                    <x-button>Delete all logs</x-button>
                </form>
            </div>
        </div>
    </div>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                @foreach ($logs as $log)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between items-start">
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

                                            @if ($log->students === [])
                                                <div class="text-gray-700">
                                                    No one.
                                                </div>
                                            @else
                                                <ul class="mt-2">
                                                    @foreach ($log->students as $student)
                                                        <li class="text-sm">
                                                            <span class="text-blue-500">{{ $student }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @else
                                            <p class="text-gray-600">
                                                {{ $log->context }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <span class="text-xs text-gray-600">
                                        {{ 'Started ' . $log->init_time->format('F j, Y - h:i a') }}
                                    </span>
                                </div>
                            </div>

                            <div>
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                            <svg class="h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                            </svg>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link href="{{ route('log.destroy', $log) }}">{{ __('Delete') }}</x-dropdown-link>
                                    </x-slot>
                                </x-dropdown>
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
