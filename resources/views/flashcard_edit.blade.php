<x-app-layout>

    <div class="pt-24">
    <div class=" mx-auto md:w-1/2 bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-lg font-bold mb-4">{{ $fc->deck->title }}: {{ __('Edit flashcard')}}</h1>

    <form method="POST" action={{ route('flashcards.update', $fc) }}>
        @csrf
        @method('put')

        <input type="hidden" name="times_viewed" value="{{ $fc->times_viewed }}"/>
        <input type="hidden" name="last_answer" value="{{ $fc->last_answer }}"/>
        <input type="hidden" name="last_viewed" value="{{ $fc->last_viewed }}"/>

        <div class="mt-4">
            <x-input-label for="fc_question">{{ __('Question')}}</x-input-label>
            <textarea id="fc_question" name="question" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write question here..." required autofocus>{{ old('question', $fc->question) }}</textarea>
            <x-input-error :messages="$errors->get('question')" class="mt-2" />
        </div>

        <div class="mt-4 mb-8">
            <x-input-label for="fc_answer">{{ __('Answer')}}</x-input-label>
            <textarea id="fc_answer" name="answer" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write answer here..." required>{{ old('answer', $fc->answer) }}</textarea>
            <x-input-error :messages="$errors->get('answer')" class="mt-2" />
        </div>

        <x-primary-button>{{__('Save')}}</x-primary-button>
    </form>

    </div>
    </div>


</x-app-layout>
